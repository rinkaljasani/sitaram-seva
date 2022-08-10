<?php

namespace App\Http\Requests\Api\Dealer\v1;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;

class PaymentHistoryRequest extends FormRequest
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
            'currancy' => 'required|in:usd,cdf',
        ];
    }
    public function failedValidation(Validator $validator) { 
       throw new HttpResponseException(response()->json([
        //    'errors' => $validator->errors(),
           'meta' => [
                'url'       =>  url()->current(),
                'api'       =>  'v.1.0',
                'language'  =>  app()->getLocale(),
                'message'   =>  $validator->errors()->first(),
           ]
        ],412)); 
   }
}
