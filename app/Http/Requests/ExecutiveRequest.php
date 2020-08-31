<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExecutiveRequest extends FormRequest
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
            'username'        => 'required|max:30|min:4',
            'doctor_password' => 'required|max:30|min:6',
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
            'username.required'        => 'ログインIDが入力されていません。',
            'username.max'             => 'ログインIDは10文字以内で入力してください。',
            'username.min'             => 'ログインIDは4文字以上で入力してください。',
            'doctor_password.required' => 'パスワードが入力されていません。',
            'doctor_password.max'      => 'パスワードは30文字以内で入力してください。',
            'doctor_password.min'      => 'パスワードは6文字以上で入力してください。',
        ];
    }
}
