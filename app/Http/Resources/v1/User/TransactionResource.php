<?php

namespace App\Http\Resources\v1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'currancy' => $this->currancy,
            'amount'   => $this->amount,
            'type' => $this->type,
            'status' => $this->status,
            'date'  => $this->created_at->format('d M Y'),
            'time' => $this->created_at->format('H:i A'),
            'shop'  => [
                'name' => $this->dealerShop->name,
                'address' => $this->dealerShop->address,
                'dealer' => [
                    'full_name' => $this->dealerShop->dealer->first_name.' '.$this->dealerShop->dealer->last_name,
                    'contact_no' => '+'.$this->dealerShop->dealer->country_code.' '.$this->dealerShop->dealer->contact_no,
                ]
            ],
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
