<?php


namespace App\Services\Cart;


use App\Models\Cart;
use App\Models\ItemCart;
use App\Services\BaseServiceInterface;
use Illuminate\Http\Response;

class CartService   implements  BaseServiceInterface
{

    public function getAll()
    {

    }

    public function search()
    {

    }

    public function getOne($id)
    {
        return Cart::find($id);
    }

    public function store($request): \Illuminate\Http\JsonResponse
    {
        $cart = Cart::create([]);
        return response()->json($cart,Response::HTTP_CREATED);
    }

    public function update($request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function addItem($cart,$product,$amount)
    {

        return $cart->products()->attach($product->id,[
            'amount'=>$amount,
            'subtotal' => $product->price * $amount,
            'price' => $product->price
        ]);
        return ItemCart::create([
            'cart_id' => $cart->id,
            'product_id'=>$product->id,
            'subtotal' => $product->price * $amount,
            'price' => $product->price
        ])->save();
    }



}
