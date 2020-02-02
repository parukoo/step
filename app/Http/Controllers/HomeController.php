<?php

namespace STEP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use STEP\Category;
use STEP\Join;
use STEP\Step;

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
      $join = Join::where('user_id', Auth::user()->id)->pluck('step_id');
      $joinsteps = Step::find($join);
      $registersteps = Auth::user()->steps()->get();
      return view('users.mypage', ['user' => $user ,'categories' => $categories, 'joinsteps' => $joinsteps, 'registersteps' => $registersteps]);
      }
}
