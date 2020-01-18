<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Step;
use App\Kostep;
use Illuminate\Support\Facades\Auth;
class StepsController extends Controller
{
    public function new(){
      $categories = Category::all();
      return view('steps.new',  ['categories' => $categories]);
    }
    
    public function index() {
      return view('steps.index');
    }

    public function show($id) {
      $step = Step::where('id', $id)->with('user')->with('category')->first()->toJson();
      return view('steps.show',  ['step' => $step]);
    }

    public function detail($stepid, $flowid) {

      return view('steps.detail', ['stepid' => $stepid], ['flowid' => $flowid]);
    }

    public function store(Request $request)
    {
      $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|integer|max:255',
        'info' => 'required|string|max:300',
        'time' => 'required|integer|max:255',
      ]);

      $step = new Step;
      $step->title = $request->title;
      $step->category_id = $request->category_id;
      $step->info = $request->info;
      $step->user_id = Auth::user()->id;
      $step->time = $request->time;
      $step->save();
      return redirect('/')->with('success', '投稿しました');
    }
}
