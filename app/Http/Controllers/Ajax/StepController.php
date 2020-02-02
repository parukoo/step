<?php

namespace STEP\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use STEP\Step;
use STEP\Kostep;
use STEP\Category;
use STEP\Complete;
use Illuminate\Support\Facades\Auth;
use STEP\Http\Controllers\Controller;
use STEP\Http\Requests\CreateStepRequest;
use STEP\Http\Requests\EditStepRequest;
class StepController extends Controller
{

  // STEP Allページ データ取得
  // =======================================
  public function all() {

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
    // $step = Auth::user()->steps()->find($stepid)->with('kosteps')->get();
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


  // STEP新規登録ページ（登録処理）
  // =======================================
  public function new(CreateStepRequest $request)
  {    
    //親STEPに登録
    $step = new Step;
    $step->title = $request->title;
    $step->category_id = $request->category_id;
    $step->info = $request->info;
    $step->user_id = Auth::user()->id;
    $step->time = $request->time;
    $step->save();

    //STEPのidを取得
    $last_insert_id = $step->id;

    //子STEPに登録
    $kosteps = $request->input('kosteps');
    foreach ($kosteps as $kostep){
      $kostepdata = new Kostep;
      $kostepdata->title = $kostep['title'];
      $kostepdata->info = $kostep['info'];
      $kostepdata->step_id = $last_insert_id;
      $kostepdata->flow_id = $kostep['flow_id'];
      $kostepdata->save();
    }
    return response()->json($step);
    // return redirect('/')->with('success', '投稿しました');
  }


  
  // STEP編集ページ データ更新（ログイン済み）
  // =======================================
  public function update(EditStepRequest $request){
    $stepid = $request->id;
    $step = Step::find($stepid);
    $step->title = $request->title;
    $step->category_id = $request->category_id;
    $step->info = $request->info;
    $step->time = $request->time;
    $step->save();

    //子STEPを更新
    $kosteps = $request->input('kosteps');
    foreach ($kosteps as $kostep){
      $kostep_id = Kostep::where('step_id', $stepid)->where('flow_id', $kostep['flow_id'])->count();
      if($kostep_id > 0){
        $kostepdata = Kostep::find($kostep['id']);
        $kostepdata->title = $kostep['title'];
        $kostepdata->info = $kostep['info'];
        $kostepdata->flow_id = $kostep['flow_id'];
        $kostepdata->save();
      }else{
        $kostepnewdata = new Kostep;
        $kostepnewdata->title = $kostep['title'];
        $kostepnewdata->info = $kostep['info'];
        $kostepnewdata->flow_id = $kostep['flow_id'];
        $kostepnewdata->step_id = $stepid;
        $kostepnewdata->save();
      }
    }
    return response()->json($kostepdata);
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
