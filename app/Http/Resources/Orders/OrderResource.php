<?php

namespace App\Http\Resources\Orders;

use App\Http\Resources\Cart\CartResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'types'=>'orders',
            'id'=>$this->id,
            'order_key'=>$this->order_key,
            'total'=>$this->total,
            'status'=>$this->status,
            'created_at'=>$this->created_at->format('d-m-Y'),
            'user'=>$this->user,
            'cart'=>CartResource::make($this->cart),
            'shipping_address'=>$this->shippingAddress
        ];
    }
}
