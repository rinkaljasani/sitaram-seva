<?php

namespace App\Http\Resources\v1\Dealer;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
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
            'usd' => [
                'code' => $this->usd_qr_code,
                'url' => $this->usd_qr_url,
                'today' => Transaction::where('dealer_shop_id',Auth()->user()->shop->id)->whereDate('created_at', Carbon::today())->where('currancy','usd')->count(),
                'this_week' => Transaction::where('dealer_shop_id',Auth()->user()->shop->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('currancy','usd')->count(),
                'this_month' => Transaction::where('dealer_shop_id',Auth()->user()->shop->id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('currancy','usd')->count(),
                'this_year' => Transaction::where('dealer_shop_id',Auth()->user()->shop->id)->whereYear('created_at', date('Y'))->where('currancy','usd')->count(),
            ],
            'cdf' => [
                'code' => $this->cdf_qr_code,
                'url' => $this->cdf_qr_url,
                'today' => Transaction::where('dealer_shop_id',Auth()->user()->shop->id)->whereDate('created_at', Carbon::today())->where('currancy','cdf')->count(),
                'this_week' => Transaction::where('dealer_shop_id',Auth()->user()->shop->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('currancy','cdf')->count(),
                'this_month' => Transaction::where('dealer_shop_id',Auth()->user()->shop->id)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('currancy','cdf')->count(),
                'this_year' => Transaction::where('dealer_shop_id',Auth()->user()->shop->id)->whereYear('created_at', date('Y'))->where('currancy','cdf')->count(),
            ]
            
            
            
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
