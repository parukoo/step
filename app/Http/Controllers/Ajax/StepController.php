<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Step;
use App\Kostep;
use App\Http\Controllers\Controller;

class StepController extends Controller
{
  public function index() {
    return Step::with('user')->orderBy(Step::CREATED_AT, 'desc')->get()->toJson();
  }
  public function show($id) {
    return Kostep::where('step_id', $id)->get()->toJson();
  }
  public function detail($step_id) {
    return Kostep::where('step_id', $step_id)->get()->toJson();
  }

  public function ajaxcomplete(Request $request) {

    $kostep = Kostep::where('id', $request->id)->first();
    $kostep->completed = $request->completed;
    $kostep->save();
    return $kostep->toJson();
  }

}
