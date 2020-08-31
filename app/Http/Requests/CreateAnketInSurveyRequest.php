<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnketInSurveyRequest extends FormRequest
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
            'anket_id' => 'required'
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
            'anket_id.required' => 'アンケットIDが入力されていません。',
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
            'anket_id'     => $this->input('anket_id', ''),
            'hospital_id'  => $this->input('hospital_id', ''),
            'sel_anket_id' => $this->input('sel_anket_id', ''),
        ];
    }
}
