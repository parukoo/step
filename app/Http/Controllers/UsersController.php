<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Join;
use App\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
  // マイページ
  public function mypage() {
    $user = Auth::user();
    $categories = Category::all();
    $join = Join::where('user_id', Auth::user()->id)->pluck('step_id');
    $joinsteps = Step::find($join);
    $registersteps = Step::where('user_id', Auth::user()->id)->latest()->take(3)->get();
    return view('users.mypage', ['user' => $user ,'categories' => $categories, 'joinsteps' => $joinsteps, 'registersteps' => $registersteps]);
  }

  // ユーザー編集画面
  public function edit(){
    $user = Auth::user();
    $categories = Category::all();
    return view('users.edit', ['user' => $user,'categories' => $categories]);
  }

  // ユーザー更新画面
  public function update(Request $request){
    $validator = Validator::make($request->all() , [
      'name' => 'required|string|max:255',
      'user_profile_photo' => 'nullable|file|image',
      'profile' => 'nullable|string|max:150'
    ]);
    // バリデーションが失敗した場合
    if($validator->fails()){
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    $user = User::find($request->id);
    $user->name = $request->name;

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
    $user->profile = $request->profile;
    $user->save();
    return redirect('mypage');
  }
}
