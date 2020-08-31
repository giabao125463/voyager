<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
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
            'doctor_password' => 'nullable|max:10|min:6',
            'hospitals'       => 'required',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (count($validator->errors()) > 0) {
                $validator->errors()->add('update-failed', 'Failed');
            }
        });
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'doctor_password.required' => 'パスワードが入力されていません。',
            'doctor_password.max'      => 'パスワードは10文字以内で入力してください。',
            'doctor_password.min'      => 'パスワードは6文字以上で入力してください。',
            'hospitals.required'       => '病院を選んでください。',
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
            'username'        => $this->input('username', ''),
            'doctor_password' => $this->input('doctor_password', ''),
            'id'              => $this->input('id', ''),
            'hospitals'       => $this->input('hospitals', ''),
        ];
    }
}
