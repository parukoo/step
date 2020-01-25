<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//TOPページ
Route::get('/', 'StepsController@index')->name('steps.index');

//TOPページ（Ajax　データ取得）
Route::get('/ajax/index', 'Ajax\StepController@index');

//STEP新規登録ページ
Route::get('/steps/new', 'StepsController@new')->name('steps.new');
Route::post('/steps', 'StepsController@store');

//STEP一覧ページ
Route::get('/steps', 'StepsController@arichive')->name('steps');
Route::get('/ajax/steps', 'Ajax\StepController@arichive')->name('ajaxsteps');

//STEP流れページ
Route::get('/steps/{step_id}', 'StepsController@flow')->name('steps.flow');

//STEP流れページ（Ajax　データ取得）
Route::get('/ajax/stepFlow', 'Ajax\StepController@flow');

//STEP詳細ページ
Route::get('/steps/{step_id}/{flow_id}', 'StepsController@detail')->name('steps.detail');

//STEP詳細ページ（Ajax　データ取得）
Route::get('/ajax/kostepDetail', 'Ajax\StepController@detail');

//子STEP完了
Route::post('/ajax/completed', 'Ajax\StepController@completed');

//マイページ
Route::get('/mypage', 'StepsController@mypage')->name('mypage');


// ログイン認証あり
// Route::group(['middleware' => 'auth'], function() {

// }

// ログイン認証なし

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
