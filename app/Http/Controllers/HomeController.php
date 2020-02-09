<?php

namespace STEP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use STEP\Category;
use STEP\Join;
use STEP\Step;
use Illuminate\Support\Facades\DB;
use STEP\Complete;
use STEP\Kostep;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $user = Auth::user();
      $categories = Category::all();

      $joinsid = Join::where('user_id', Auth::user()->id)->pluck('step_id');

      //参加中のSTEP
      $joinsteps = [];
      //完了済みのSTEP
      $completesteps = [];

      foreach ($joinsid as $key => $joinstepid){
        $step = Step::find($joinstepid);
        $kostepcount = Kostep::where('step_id', $joinstepid)->count();
        $finishcount = Complete::where('user_id', Auth::user()->id)->where('step_id', $joinstepid)->count();
        if($finishcount === 0){
          $complete = 0;
        }else{
          $complete = ($finishcount / $kostepcount) * 100;
        }

        // もし完了率が100だったら「completestep」に、それ以外は「joinstep」
        if($complete === 100){
          $completesteps[$key]['step'] = $step;
          $completesteps[$key]['complete'] = floor($complete);
        }else{
          $joinsteps[$key]['step'] = $step;
          $joinsteps[$key]['complete'] = floor($complete);
        }
      }


      $registersteps = Step::where('user_id', Auth::user()->id)->get();
      return view('users.mypage', ['user' => $user ,'categories' => $categories, 'joinsteps' => $joinsteps, 'completesteps' => $completesteps, 'registersteps' => $registersteps]);
    }
}
