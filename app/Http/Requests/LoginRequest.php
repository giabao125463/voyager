<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|max:30|min:4',
            'password' => 'required|max:10|min:4',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'ログインIDが入力されていません。',
            'username.max'      => 'ログインIDは半角英字4文字以上30文字以内で入力してください。',
            'username.min'      => 'ログインIDは半角英字4文字以上30文字以内で入力してください。',
            'password.required' => 'パスワードが入力されていません。',
            'password.max'      => 'パスワードは半角英字6文字以上10文字以内で入力してください。',
            'password.min'      => 'パスワードは半角英字6文字以上10文字以内で入力してください。',
        ];
    }
}
