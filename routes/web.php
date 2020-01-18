<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});
//STEP新規登録ページ
Route::get('/steps/new', 'StepsController@new')->name('steps.new');
Route::post('/steps', 'StepsController@store')->name('steps.store');

//STEP一覧ページ
Route::get('/steps', 'StepsController@index')->name('steps');
Route::get('/ajax/steps', 'Ajax\StepController@index')->name('ajaxsteps');

//STEP詳細ページ
Route::get('/steps/{step_id}', 'StepsController@show')->name('steps.show');
Route::get('/ajax/stepsingle/{step_id}', 'Ajax\StepController@show');

//子STEP詳細ページ
Route::get('/steps/{step_id}/{flow_id}', 'StepsController@detail')->name('steps.detail');
Route::get('/ajax/kosteps/{step_id}', 'Ajax\StepController@detail');
Route::post('/ajax/complete', 'Ajax\StepController@ajaxcomplete');

//マイページ
Route::get('/mypage', 'StepsController@mypage')->name('mypage');


// ログイン認証あり
// Route::group(['middleware' => 'auth'], function() {

// }

// ログイン認証なし

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
