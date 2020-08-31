<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdatePatientRequest extends FormRequest
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
            'patient_code' => 'required',
            'patient_id'   => 'required',
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
            'patient_code.required' => '患者コードが入力されていません。',
            'patient_id.required'   => '患者IDが入力されていません。',
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
            'anket_id'     => Str::replaceFirst(config('consts.anketo.suffix_temporary'), '', $this->input('anket_id', '')) ,
            'id'           => $this->input('patient_id', ''),
        ];
    }
}
