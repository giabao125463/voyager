<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HospitalRequest extends FormRequest
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
            'anket_types' => 'required',
            'name'        => 'required',
            'code'        => 'required',
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
           'name.required'        => '施設名が入力されていません。',
           'name.max'             => '施設名は150文字以内で入力してください。',
           'name.unique'          => '施設名は既に存在しています。',
           'code.required'        => '略号が入力されていません。',
           'code.max'             => '略号は10文字以内で入力してください。',
           'code.unique'          => '略号は既に存在しています。',
           'anket_types.required' => 'アンケート種類を選んでください。',
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
            'id'     => $this->input('id', ''),
            'name'   => $this->input('name', ''),
            'code'   => $this->input('code', ''),
            'ankets' => json_encode($this->input('anket_types', '')),
        ];
    }
}
