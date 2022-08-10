<?php

namespace App\Http\Requests\Api\User\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class UpdatePasswordRequest extends FormRequest
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
            'old_password'              =>  'required',
            'new_password'              =>  'required|min:8|string|max:255',
            'password_conformation'     =>  'required|same:new_password',
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
