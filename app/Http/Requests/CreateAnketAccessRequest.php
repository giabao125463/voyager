<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAnketAccessRequest extends FormRequest
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
            'patient_code'   => 'required|max:10|min:4',
            'anket_password' => 'required|max:10|min:6',
            'hospital_id'    => 'required',
            'anket_id'       => 'required',
            'doctor_id'      => 'required'
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
            'patient_code.required'   => 'ログインIDが入力されていません。',
            'patient_code.max'        => 'ログインIDは10文字以内で入力してください。',
            'patient_code.min'        => 'ログインIDは4文字以上で入力してください。',
            'anket_password.required' => 'パスワードが入力されていません。',
            'anket_password.max'      => 'パスワードは10文字以内で入力してください。',
            'anket_password.min'      => 'パスワードは6文字以上で入力してください。',
            'hospital_id.required'    => '病院を選んでください。',
            'anket_id.required'       => 'アンケート種類を選んでください。',
            'doctor_id.required'      => '担当医を選んでください。',
        ];
    }

    /**
     * 成形したパラメータ
     *
     * @return array
     */
    public function parameters()
    {
        return [
            'patient_code' => $this->input('patient_code', ''),
            'password'     => $this->input('anket_password', ''),
            'anket_id'     => $this->input('anket_id', ''),
            'hospital_id'  => $this->input('hospital_id', ''),
            'doctor_id'    => $this->input('doctor_id', ''),
        ];
    }
}
