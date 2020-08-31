<?php

namespace App\Http\Requests;

class HospitalCreateRequest extends HospitalRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule         = parent::rules();
        $rule['name'] = 'required|max:150|unique:hospitals,name';
        $rule['code'] = 'required|max:10|unique:hospitals,code';

        return $rule;
    }
}
