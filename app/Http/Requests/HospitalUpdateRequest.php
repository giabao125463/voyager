<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalUpdateRequest extends HospitalRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $hospitalId = $this->hospital->id;

        $rule         = parent::rules();
        $rule['name'] = 'required|max:150|unique:hospitals,name,' . $hospitalId;
        $rule['code'] = 'required|max:10|unique:hospitals,code,' . $hospitalId;

        return $rule;
    }

    /**
     * Add status edit to errors list
     *
     * @param $validator
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (count($validator->errors()) > 0) {
                $validator->errors()->add('update-failed', 'Failed');
            }
        });
    }
}
