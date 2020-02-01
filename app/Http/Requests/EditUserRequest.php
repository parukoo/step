<?php

namespace STEP\Http\Requests;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * 新規ユーザ登録のバリデーションを行うクラス
 */
class EditUserRequest extends FormRequest
{
    /**
     * 認証関係の判定を行う場合はここに処理を記述する。
     * 特にない場合は常にtrueを返しておく。
     */ 
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションルールを記述
     */
    public function rules()
    {
      return [
        'name' => 'required|string|max:50',
        'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->email.',email',
        'user_profile_photo' => 'nullable|file|image',
        'profile' => 'nullable|string|max:150'
      ];
    }
}
