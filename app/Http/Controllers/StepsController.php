<?php

namespace STEP\Http\Controllers;

use Illuminate\Http\Request;
use STEP\Category;
use STEP\Step;
use STEP\Kostep;
use STEP\User;
use STEP\Join;
use STEP\Complete;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class StepsController extends Controller
{
  // TOPページ
  // =======================================
  public function index() {
    if (Auth::check()) {
      return redirect('/all');
    }
    $steps = Step::take(6)->with('category')->get();
    $categories = Category::all();
    return view('steps.index', ['steps' => $steps, 'categories' => $categories]);
  }


  // Allページ
  // =======================================
  public function all() {
    $categories = Category::all();
    return view('steps.all', ['categories' => $categories]);
  }


  // STEP一覧ページ
  // =======================================
  public function arichive() {
    $categories = Category::all();
    return view('steps.archive', ['categories' => $categories]);
  }


  // STEP一覧ページ（カテゴリー別）
  // =======================================
  public function category($category_id) {
    $categories = Category::all();
    return view('steps.category', ['categoryid' => $category_id, 'categories' => $categories]);
  }


  // STEP流れページ
  // =======================================
  public function flow($stepid) {
    $categories = Category::all();
    // ログインユーザーの該当STEPの達成率を計算
    $kostepcount = Kostep::where('step_id', $stepid)->count();
    if (Auth::check()) {
      $finishcount = Complete::where('user_id', Auth::user()->id)->where('step_id', $stepid)->count();
    }else{
      $finishcount = 0;
    }
    if($finishcount === 0){
      $complete = 0;
    }else{
      $complete = ($finishcount / $kostepcount) * 100;
    }
    //STEPが存在しなければ404ページに遷移させる
    if($kostepcount === 0) {
      abort(404);
    }
    return view('steps.flow', ['stepid' => $stepid, 'categories' => $categories, 'complete' => $complete]);
  }


  // STEP詳細ページ
  // =======================================
  public function detail($stepid, $flowid) {
    if($flowid > 1){
      $prevflowid = $flowid - 1;
      $prevkostepid = Kostep::where('step_id', $stepid)->where('flow_id', $prevflowid)->value('id');
      $doneflag = Complete::where('user_id', Auth::user()->id)->where('step_id', $stepid)->where('kostep_id', $prevkostepid)->count();
      if($doneflag === 0){
        return redirect()->back()->with('flash_message', '順番沿ってSTEPを進めましょう');
      }
    }
    $kostep = Kostep::where('step_id', $stepid)->where('flow_id', $flowid)->count();
    //urlに存在しないkostep_idを入れられた場合404ページに遷移させる
    if($kostep === 0) {
      abort(404);
    }
    $joined = Join::where('step_id', $stepid)->where('user_id', Auth::user()->id)->count();
    
    //初めて該当のSTEPに参加する場合のみjoin登録する
    if(!$joined){
      $join = new Join;
      $join->step_id = $stepid;
      $join->user_id = Auth::user()->id;
      $join->save();
    }
    $step = Step::find($stepid);
    $categories = Category::all();
    return view('steps.detail', ['stepid' => $stepid, 'flowid' => $flowid, 'step' => $step, 'categories' => $categories]);
  }

  // STEP編集ページ
  // =======================================
  public function edit($stepid){
    $step = Step::find($stepid);
    //自分が作成したstepのみ編集できる様にする
    $this->authorize('edit', $step);
    $categories = Category::all();
    return view('steps.edit',  ['stepid' => $stepid, 'categories' => $categories]);
  
  }

  // STEP新規登録ページ
  // =======================================
  public function new(){
    $categories = Category::all();
    return view('steps.new',  ['categories' => $categories]);
  }
}
