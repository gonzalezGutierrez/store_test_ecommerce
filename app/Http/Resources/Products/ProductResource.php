<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public static $wrap = false;

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'slug'=>$this->slug,
            'price'=>$this->price,
            'description'=>$this->description,
            'image_url'=>$this->image_url,
        ];
    }
}
