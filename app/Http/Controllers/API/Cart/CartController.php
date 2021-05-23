<?php

namespace App\Http\Controllers\API\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
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

    public function show($id, CartService $cartService): \App\Http\Resources\Cart\CartResource
    {
        return $cartService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function addItem(Request $request , CartService $cartService ): \Illuminate\Http\JsonResponse
    {
        return $cartService->addItem($request);
    }

    public function removeItem(Request $request, CartService $cartService): \Illuminate\Http\JsonResponse
    {
        return $cartService->removeItem($request);
    }

    public function checkout(CheckoutRequest $request , $cartId,CartService $cartService) {
        return $cartService->checkout($request->validated(),$cartId);
    }

}
