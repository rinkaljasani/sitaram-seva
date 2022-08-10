<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class WithdrawRequest extends FormRequest
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
            'amount'        =>  'required_unless:action,'.$unless.'|min:2|numeric',
        ];
    }
}
