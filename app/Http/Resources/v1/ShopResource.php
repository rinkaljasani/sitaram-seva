<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'id' => $this->custom_id,
            'name' => $this->name,
            'address' => $this->address,
            'usd_qr_code' => $this->usd_qr_code,
            'cdf_qr_code' => $this->cdf_qr_code,
            'usd_qr_url' => $this->usd_qr_url,
            'cdf_qr_url' => $this->cdf_qr_url,
        ];
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
