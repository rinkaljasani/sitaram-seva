<?php

namespace App\Http\Requests\Api\Dealer\v1;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;

class EarningRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'currancy' => 'required|in:usd,cdf',
            'start_date'    => 'required|date|before_or_equal:end_date',
            'end_date'      => 'required|date|after_or_equal:start_date',
        ];
    }
    public function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json([
            // 'errors' => $validator->errors(),
            'meta' => [
                 'url'       =>  url()->current(),
                 'api'       =>  'v.1.0',
                 'language'  =>  app()->getLocale(),
                 'message'   =>  $validator->errors()->first(),
            ]
         ],412)); 
    }
}
