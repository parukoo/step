<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Step;
use App\Kostep;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class StepsController extends Controller
{
    // TOPページ
    public function index() {
      return view('steps.index');
    }

    // 新規作成ページ
    public function new(){
      $categories = Category::all();
      return view('steps.new',  ['categories' => $categories]);
    }
    
    // STEP一覧ページ
    public function arichive() {
      return view('steps.arichive');
    }

    // STEP流れページ
    public function flow($stepid) {
      return view('steps.flow', ['stepid' => $stepid]);
    }

    // STEP詳細ページ
    public function detail($stepid, $flowid) {
      return view('steps.detail', ['stepid' => $stepid, 'flowid' => $flowid]);
    }

    // 新規登録ページ（登録処理）
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
