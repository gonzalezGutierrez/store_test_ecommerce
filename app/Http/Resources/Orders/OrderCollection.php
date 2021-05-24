<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{

    public $collection = OrderResource::class;
    /**
     *
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
