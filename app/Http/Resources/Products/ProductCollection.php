<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{

    public $collection = ProductResource::class;

    public function toArray($request)
    {
        return [
            'data'=>$this->collection
        ];
    }

}
