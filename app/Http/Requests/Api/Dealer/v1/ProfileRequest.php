<?php

namespace App\Http\Requests\Api\Dealer\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProfileRequest extends FormRequest
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
            'first_name'        =>  'sometimes|min:2|max:100',
            'last_name'         =>  'sometimes|min:2|max:100',
            'country_code'      =>  'sometimes|exists:countries,phonecode',
            'contact_no'        =>  'sometimes|digits_between:6,16',
            'profile_photo'     =>  'sometimes|mimes:jpg,jpeg,png',
            'shop_name'         =>  'sometimes'
            // 'shop_name'         =>  'required|unique:shop,shop_name,NULL,id,shop_id,'.$this->get('shop_id').'|max:255'
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
