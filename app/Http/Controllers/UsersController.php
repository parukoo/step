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
  // ユーザー編集画面（GET）
  // =======================================
  public function edit(){
    $user = Auth::user();
    $categories = Category::all();
    return view('users.edit', ['user' => $user, 'categories' => $categories]);
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

        // 画像をリサイズ
        $width = 300;
        $img->resize($width, null, function($constraint){
          $constraint->aspectRatio();
        });
        // ランダムな画像名を命名
        $profilepath = str_random(30);
        $file_name = $profilepath;

        $save_path = public_path('img/update/user/'.$file_name.'.jpg');   
        $img->save($save_path);
        $user->photo = $file_name;
    }
    $user->save();

    // リダイレクトする(マイページへ遷移) 
    // その時にsessionフラッシュにメッセージを入れる
    return redirect('mypage')->with('flash_message', '登録しました');
  }
}
