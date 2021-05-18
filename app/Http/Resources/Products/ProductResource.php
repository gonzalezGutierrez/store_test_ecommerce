<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public static $wrap = false;

    public function toArray($request)
    {
        return [
            'type'=>'products',
            'id'=>$this->id,
            'attributes'=>[
                'name'=>$this->name,
                'slug'=>$this->slug,
                'price'=>$this->price,
                'description'=>$this->description,
                'created_at'=>$this->created_at
            ],
            'links'=>[
                'self'=>url('products.show',$this)
            ]
        ];
    }
}
