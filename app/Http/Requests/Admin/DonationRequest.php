<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
            'donar_name'    =>  'required|max:50',
            'donar_email'   =>  'required|max:50',
            'donar_image'   =>  'required|mimes:jpg,jpeg,png',
            'amount'        =>  'required|number',
            'message'       =>  'required|max:150',
            'category_id'   =>  'required|exists:category,id',
        ];
    }
}
