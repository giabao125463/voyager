<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExecutiveUpdateRequest extends ExecutiveRequest
{
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
