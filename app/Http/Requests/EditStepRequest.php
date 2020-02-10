<?php

namespace STEP\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditStepRequest extends FormRequest
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
        'title' => 'required|string|max:50',
        'category_id' => 'required|integer',
        'info' => 'required|string|max:200',
        'time' => 'required|integer',
        'kosteps.*.title' => 'required|string|max:50',
        'kosteps.*.info' => 'required|string|max:1000',
        'kosteps.*.flow_id' => 'required|integer'   
      ];
    }
}
