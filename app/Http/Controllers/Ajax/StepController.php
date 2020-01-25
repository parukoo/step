<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Step;
use App\Kostep;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class StepController extends Controller
{

  // STEP TOPページ データ取得
  // =======================================
  public function index() {

    // カテゴリー毎のSTEP数を取得
    $categories = Category::pluck('id');
    foreach ($categories as $category) {
      $category_id = $category;
      $count = Step::where('category_id', $category)->count();
      $a = array('category_id'=> $category_id);
      $a = array_merge($a, array('count'=>$count));
      $array[] = $a;
    }

    // 投稿数が多い順に並び替える
    foreach($array as $key => $value){
      $sort_keys[$key] = $value['count'];
    }
    array_multisort($sort_keys, SORT_DESC, $array);

    //カテゴリーを3つに絞り、STEPデータを各3つずつ取得する
    foreach($array as $key => $value){
      if($key < 3){
        $steps[] = Step::take(3)->where('category_id', $value['category_id'])->orderBy('id', 'desc')->with('category')->get();
      }      
    }
    return $steps;
  }


  // STEP 一覧ページ
  // =======================================
  public function arichive() {
    return Step::with('user')->orderBy(Step::CREATED_AT, 'desc')->get()->toJson();
  }


  public function show($id) {
    return Kostep::where('step_id', $id)->get()->toJson();
  }


  // STEP流れページ データ取得
  // =======================================
  public function flow(Request $request){
    $stepid = $request->input('stepid');
    $step = Step::where('id', $stepid)->with('user')->with('category')->first();
    $kosteps = Kostep::where('step_id', $stepid)->get();
    return [$step, $kosteps];
  }


  // STEP詳細ページ データ取得
  // =======================================
  public function detail(Request $request){
    $stepid = $request->input('stepid');
    $flowid = $request->input('flowid');
    $kostep = Kostep::where('step_id', $stepid)->where('flow_id', $flowid)->first();
    $flowmenu = Kostep::where('step_id', $stepid)->orderBy('flow_id','asc')->get();
    return [$kostep, $flowmenu];
  }


  // 子STEP完了
  // =======================================
  public function completed(Request $request) {
    $kostep_id = $request->id;
    $kostep = Kostep::find($kostep_id);
    $kostep->completed = $request->completed;
    $kostep->save();
    return $kostep;
  }
}
