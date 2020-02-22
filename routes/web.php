<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ログイン認証なし
  //TOPページ
  Route::get('/', 'StepsController@index');

  //ALLページ
  Route::get('/all', 'StepsController@all')->name('all');
  //ALLページ（Ajax　データ取得）
  Route::get('/ajax/all', 'Ajax\StepController@all');

  //STEP一覧ページ
  Route::get('/steps', 'StepsController@arichive')->name('steps');
  //STEP一覧ページ（Ajax　データ取得）
  Route::get('/ajax/steps', 'Ajax\StepController@arichive')->name('ajaxsteps');

  //STEP一覧ページ（カテゴリー別）
  Route::get('/category/{category_id}', 'StepsController@category');
  //STEP一覧ページ（カテゴリー別）（Ajax　データ取得）
  Route::get('/ajax/category', 'Ajax\StepController@category');

  //STEP流れページ
  Route::get('/steps/{step_id}', 'StepsController@flow')->where('step_id', '[0-9]+');
  //STEP流れページ（Ajax　データ取得）
  Route::get('/ajax/stepFlow', 'Ajax\StepController@flow');


// ログイン認証あり
Route::group(['middleware' => 'auth'], function() {

  //STEP新規登録ページ
  Route::get('/steps/new', 'StepsController@new')->name('steps.new');
  //STEP新規登録ページ（Ajax　データ登録）
  Route::post('/ajax/stepNew', 'Ajax\StepController@new');

  //STEP編集画面
  Route::get('/steps/{step_id}/edit', 'StepsController@edit');
  //STEP編集画面（Ajax　データ取得）
  Route::get('/ajax/stepEditflow', 'Ajax\StepController@edit');

  //STEP編集処理（Ajax　データ更新）
  Route::post('/ajax/stepUpdate', 'Ajax\StepController@update');

  //STEP詳細ページ
  Route::get('/steps/{step_id}/{flow_id}', 'StepsController@detail');
  //STEP詳細ページ（Ajax　データ取得）
  Route::get('/ajax/kostepDetail', 'Ajax\StepController@detail');

  //子STEP完了
  Route::post('/ajax/completed', 'Ajax\StepController@completed');

  // ユーザー編集画面
  Route::get('/users/edit', 'UsersController@edit');

  // ユーザー更新画面
  Route::post('/users/update', 'UsersController@update');
});


Auth::routes();
//マイページ
Route::get('/mypage', 'HomeController@index')->name('mypage');
