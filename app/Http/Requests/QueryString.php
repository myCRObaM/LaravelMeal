<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class QueryString extends FormRequest
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
            'lang' => 'required|alpha|between:2,3',
            'diff_time' => 'integer|min:1',
            'per_page' => 'integer|min:1',
            'diff_time' => 'integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'lang.required' => 'Language is required as query string parameter'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors()->all()));
    }
}
