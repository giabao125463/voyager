<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
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
            'doctorName' => 'required',
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
            'doctorName.required' => '担当医名が入力されていません。',
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
            'doctorName' => $this->input('doctorName', ''),
        ];
    }
}
