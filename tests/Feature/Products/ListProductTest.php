<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProductTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
   public function can_fetch_single_product()
   {

       $product = Product::factory()->create();

       $response = $this->getJson(route('products.show',$product->getRouteKey()));

       $response->assertExactJson([
           'data'=>[
               'type'=>'products',
               'id'=>  $product->getRouteKey(),
               'attributes'=>[
                   'name'=>$product->name,
                   'slug'=>$product->slug,
                   'price'=>$product->price,
                   'description'=>$product->description,
                   'created_at'=>$product->created_at
               ],
               'links'=>[
                   'self'=>url(route('products.show',$product->getRouteKey()))
               ]
           ]
       ]);
   }

    /** @test */
    public function can_fetch_all_products()
    {

        $this->withoutExceptionHandling();

        $products = Product::factory(3)->create();

        $response = $this->getJson(route('products.index'));

        $response->assertJsonFragment([
            'data'=>[
                [
                    'type'=>'products',
                    'id'=>$products[0]->id,
                    'attributes'=>[
                        'name'=>$products[0]->name,
                        'slug'=>$products[0]->slug,
                        'price'=>$products[0]->price,
                        'description'=>$products[0]->description,
                        'created_at'=>$products[0]->created_at
                    ],
                    'links'=>[
                        'self'=>route('products.show',$products[0])
                    ]
                ],
                [
                    'type'=>'products',
                    'id'=>$products[1]->id,
                    'attributes'=>[
                        'name'=>$products[1]->name,
                        'slug'=>$products[1]->slug,
                        'price'=>$products[1]->price,
                        'description'=>$products[1]->description,
                        'created_at'=>$products[1]->created_at
                    ],
                    'links'=>[
                        'self'=>route('products.show',$products[1])
                    ]
                ],
                [
                    'type'=>'products',
                    'id'=>$products[2]->id,
                    'attributes'=>[
                        'name'=>$products[2]->name,
                        'slug'=>$products[2]->slug,
                        'price'=>$products[2]->price,
                        'description'=>$products[2]->description,
                        'created_at'=>$products[2]->created_at
                    ],
                    'links'=>[
                        'self'=>route('products.show',$products[2])
                    ]
                ]
            ]
        ]);

    }

}
