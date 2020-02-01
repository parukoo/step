<?php

namespace STEP\Http\Controllers;

use STEP\User;
use STEP\Category;
use STEP\Join;
use STEP\Step;
use Illuminate\Support\Facades\Auth;
use STEP\Http\Requests\EditUserRequest;

class UsersController extends Controller
{
  // マイページ（GET）
  // =======================================
  public function mypage() {
    $user = Auth::user();
    $categories = Category::all();
    $join = Join::where('user_id', Auth::user()->id)->pluck('step_id');
    $joinsteps = Step::find($join);
    $registersteps = Auth::user()->steps()->get();
    return view('users.mypage', ['user' => $user ,'categories' => $categories, 'joinsteps' => $joinsteps, 'registersteps' => $registersteps]);
  }

  // ユーザー編集画面（GET）
  // =======================================
  public function edit(){
    $user = Auth::user();
    $categories = Category::all();
    return view('users.edit', ['user' => $user,'categories' => $categories]);
  }

  // ユーザー更新画面（POST）
  // =======================================
  public function update(EditUserRequest $request){

    // EditUserRequestでバリデーションチェック

    $user = User::find($request->id);
    $user->name = $request->name;
    $user->profile = $request->profile;

    // プロフィール画像登録処理
    if($request->user_profile_photo != null){
        $photo = $request->file('user_profile_photo');
        $img = \Image::make($photo);
        $width = 300;
        $img->resize($width, null, function($constraint){
          $constraint->aspectRatio();
        });
        $profilepath = str_random(30);
        $file_name = $profilepath;
        $save_path = storage_path('app/public/img/'.$file_name.'.jpg');        
        $img->save($save_path);
        // $img->storeAs('public/user_images', $user->id . '.jpg');
        $user->photo = $file_name;
    }
    $user->save();

    // マイページへ遷移
    return redirect('mypage');
  }
}
