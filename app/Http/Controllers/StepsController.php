<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Step;
use App\Kostep;
use App\User;
use App\Join;
use App\Complete;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class StepsController extends Controller
{


  // TOPページ
  // =======================================
  public function index() {
    $categories = Category::all();
    return view('steps.index', ['categories' => $categories]);
  }

  // STEP一覧ページ
  // =======================================
  public function arichive() {
    // $steps = Step::with('user')->with('category')->orderBy(Step::CREATED_AT, 'desc')->get();
    // return view('steps.archive', ['steps' => $steps]);
    $categories = Category::all();
    return view('steps.archive', ['categories' => $categories]);
  }


  // STEP一覧ページ（カテゴリー別）
  // =======================================
  public function category($category_id) {
    // $steps = Step::where('category_id', $category_id)->with('user')->with('category')->orderBy(Step::CREATED_AT, 'desc')->get();
    // return view('steps.archive', ['steps' => $steps]);
    $categories = Category::all();
    return view('steps.category', ['categoryid' => $category_id, 'categories' => $categories]);
  }


  // STEP流れページ
  // =======================================
  public function flow($stepid) {
    $categories = Category::all();
    $kostepcount = Kostep::where('step_id', $stepid)->count();
    if (Auth::check()) {
      $finishcount = Complete::where('user_id', Auth::user()->id)->where('step_id', $stepid)->count();
    }else{
      $finishcount = 0;
    }
    $complete = ($finishcount / $kostepcount) * 100;
    return view('steps.flow', ['stepid' => $stepid, 'categories' => $categories, 'complete' => $complete]);
  }


  // STEP詳細ページ
  // =======================================
  public function detail($stepid, $flowid) {
    $joined = Join::where('step_id', $stepid)->where('user_id', Auth::user()->id)->count();
    
    //初めて該当のSTEPに参加する場合のみjoin登録する
    if(!$joined){
      $join = new Join;
      $join->step_id = $stepid;
      $join->user_id = Auth::user()->id;
      $join->save();
    }
    $categories = Category::all();
    return view('steps.detail', ['stepid' => $stepid, 'flowid' => $flowid, 'categories' => $categories]);
  }

  // STEP編集ページ
  // =======================================
  public function edit($stepid){
    $categories = Category::all();
    return view('steps.edit',  ['stepid' => $stepid, 'categories' => $categories]);
  }

  // STEP新規登録ページ
  // =======================================
  public function new(){
    $categories = Category::all();
    return view('steps.new',  ['categories' => $categories]);
  }

  // STEP新規登録ページ（登録処理）
  // =======================================
  public function store(Request $request)
  {
    // $request->validate([
    //   'title' => 'required|string|max:255',
    //   'category_id' => 'required|integer|max:255',
    //   'info' => 'required|string|max:300',
    //   'time' => 'required|integer|max:255',
    // ]);

    //親STEPに登録
    $step = new Step;
    $step->title = $request->title;
    $step->category_id = $request->category_id;
    $step->info = $request->info;
    $step->user_id = Auth::user()->id;
    $step->time = $request->time;
    debug($step->title);
    $step->save();

    //STEPのidを取得
    $last_insert_id = $step->id;

    //子STEPに登録
    $kosteps = $request->input('kosteps');
    foreach ($kosteps as $kostep){
      $kostepdata = new Kostep;
      $kostepdata->title = $kostep['title'];
      logger('title'.$kostepdata->title);
      $kostepdata->info = $kostep['info'];
      logger('info'.$kostepdata->info);
      $kostepdata->step_id = $last_insert_id;
      logger('step_id'.$kostepdata->step_id );
      $step->completed = false;
      logger('completed'.$step->completed);
      $kostepdata->flow_id = $kostep['id'];
      logger('flow_id'.$kostepdata->flow_id);
      $kostepdata->save();
    }
    return response()->json($step);
    // return redirect('/')->with('success', '投稿しました');
  }
}
