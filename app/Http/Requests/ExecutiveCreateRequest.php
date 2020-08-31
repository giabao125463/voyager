<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExecutiveCreateRequest extends ExecutiveRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule             = parent::rules();
        $rule['username'] = 'required|unique:users|max:30|min:4';

        return $rule;
    }
}
