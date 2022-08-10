<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class VolunteerRequest extends FormRequest
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
        $unless = "change_status";
        $id = (!empty(Route::current()->parameters()['user']->id) ? Route::current()->parameters()['user']->id : NULL);
        return [
            'name'        =>  'required_unless:action,'.$unless.'|min:2|max:10',
            'address'         =>  'required_unless:action,'.$unless.'|min:2|max:100',
            'email'             =>  'required_unless:action,'.$unless.'|email|',
            'contact_no'        =>  'required_unless:action,'.$unless.'|digits_between:6,16',
            'image'     =>  'nullable|mimes:jpg,jpeg,png',
        ];
    }
}
