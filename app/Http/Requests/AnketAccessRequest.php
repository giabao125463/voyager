<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnketAccessRequest extends FormRequest
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
            //
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
            'hospital_id' => $this->input('hospital_id', ''),
            'doctor_id'   => $this->input('doctor_id', ''),
        ];
    }
}
