<?php

namespace App\Http\Requests\Api\Dealer\v1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'first_name'        =>  'required|min:2|max:100',
            'last_name'         =>  'required|min:2|max:100',
            'email'             =>  'required|email|max:150|unique:dealers,email',
            'country_code'      =>  'required|exists:countries,phonecode',
            'contact_no'        =>  'required|digits_between:6,16',
            'password'          =>  'required|min:8|max:16',
            'confirm_password'  =>  'required|same:password|min:8|max:16',
            'shop_name'         =>  'required|min:3|unique:dealer_shops,name',
            'shop_address'      =>  'required|min:5'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            // 'errors' => $validator->errors(),
            'meta' => [
                'url'       =>  url()->current(),
                'api'       =>  'v.1.0',
                'language'  =>  app()->getLocale(),
                'message'   =>  $validator->errors()->first(),
            ]
        ], 412));
    }
}
