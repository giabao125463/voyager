<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchAnketResultRequest extends FormRequest
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
        return [];
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
            'doctor_name'  => $this->input('doctor_name', ''),
            'anket_id'     => $this->input('anket_id', ''),
            'hospitals'    => $this->input('hospitals', ''),
        ];
    }
}
