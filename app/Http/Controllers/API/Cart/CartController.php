<?php

namespace App\Http\Controllers\API\Cart;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartService;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        //
    }


    public function store(Request $request , CartService $cartService): \Illuminate\Http\JsonResponse
    {
        return $cartService->store([]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function addItem(Request $request, $cartId , CartService $cartService , ProductService  $productService)
    {

        $cart    = $request->cart;
        $product = $productService->getOne($request->product_id);
        $amount  = $request->amount;

        return $cartService->addItem($cart,$product,$amount);

    }
}
