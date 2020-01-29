<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Step;
use App\Kostep;
use App\Category;
use App\Complete;
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
    return Step::with('user')->with('category')->orderBy(Step::CREATED_AT, 'desc')->get();
  }

  // STEP 一覧ページ（カテゴリー別）
  // =======================================
  public function category(Request $request) {
    $category_id = $request->input('category_id');
    return Step::where('category_id', $category_id)->with('user')->with('category')->orderBy(Step::CREATED_AT, 'desc')->get();
  }


  public function show($id) {
    return Kostep::where('step_id', $id)->get()->toJson();
  }

  // STEP編集ページ データ取得
  // =======================================
  public function edit(Request $request){
    $stepid = $request->input('stepid');
    $step = Step::where('id', $stepid)->with('kosteps')->get();
    return $step;
  }

  // STEP流れページ データ取得
  // =======================================
  public function flow(Request $request){
    $stepid = $request->input('stepid');
    $step = Step::where('id', $stepid)->with('user')->with('category')->first();
    $kosteps = Kostep::where('step_id', $stepid)->get();
    return [$step, $kosteps];
  }


  // STEP詳細ページ データ取得（ログイン済み）
  // =======================================
  public function detail(Request $request){
    $stepid = $request->input('stepid');
    $flowid = $request->input('flowid');

    // 詳細ページの子STEPを1つ取得
    $kostep = Kostep::where('step_id', $stepid)->where('flow_id', $flowid)->first();

    // 指定のSTEPの完了している子STEPIDを取得
    $kostepid = $kostep->id;
    $complete = Complete::where('user_id', Auth::user()->id)->where('kostep_id', $kostepid)->count();
  
    // 指定STEPの情報を全て取得
    $flowmenu = Kostep::where('step_id', $stepid)->orderBy('flow_id','asc')->get();
    
    return [$kostep, $complete, $flowmenu];
  }


  // 子STEP完了（ログイン済み）
  // =======================================
  public function completed(Request $request) {
    $kostep_id = $request->id;
    $complete_id = Complete::where('kostep_id', $kostep_id)->where('user_id', Auth::user()->id)->count();

    //既に完了済みだったら
    if($complete_id > 0){
        $complete = Complete::where('kostep_id', $kostep_id)->where('user_id', Auth::user()->id)->delete();
        return response()->json($complete);
    }else{
        $complete = new Complete;
        $complete->kostep_id = $kostep_id;
        $complete->user_id = Auth::user()->id;
        $complete->step_id = $request->step_id;
        $complete->save();
        return response()->json($complete);
    }
  }
}
