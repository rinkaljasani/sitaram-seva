<?php

namespace App\Http\Requests\Api\User\v1;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ProfileRequest extends FormRequest
{
    protected $errors=[];
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
            'profile_photo'     =>  'sometimes|mimes:jpg,jpeg,png'
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
