<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                =>  $this->custom_id ?? "",
            'first_name'        =>  $this->first_name ?? "",
            'last_name'         =>  $this->last_name ?? "",
            'email'             =>  $this->email ?? "",
            'contact'   => [
                'code'          =>  $this->country_code ?? "",
                'number'        =>  $this->contact_no ?? "",       
            ],
            'profile_image'     =>  ($this->profile_photo) ? generateUrl($this->profile_photo) : ""
        ];
        // return parent::toArray($request);
    }
    public function with($request)
    {
        return [
            'meta' => [
                'url'       =>  url()->current(),
                'api'       =>  'v.1.0',
                'language'  =>  app()->getLocale(),
            ],
        ];
    }
}
