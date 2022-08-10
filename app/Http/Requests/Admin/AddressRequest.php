<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;


class AddressRequest extends FormRequest
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
        $id = (!empty(Route::current()->parameters()['user']->id) ? ','.Route::current()->parameters()['user']->id : '');
        return [
            'title'   =>  'required_unless:action,'.$unless.'|min:3',
            'manager_name'         =>  'required_unless:action,'.$unless.'|min:3',
            'contact_no'         =>  'required_unless:action,'.$unless.'|min:10',
            'alternative_contact_no'         =>  'required_unless:action,'.$unless.'|min:10',
            'address'         =>  'required_unless:action,'.$unless.'|min:5',
            'city_id'         =>  'required_unless:action,'.$unless,
        ];
    }
}
