<?php

namespace App\Http\Middleware;

use App\Services\Cart\CartService;
use Closure;
use Illuminate\Http\Request;

class CartGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $cartId = $request->route()->parameter('cart_id');

        $cartService = new CartService();

        $cart = $cartService->getOne($cartId);

        if (!$cart) {
            return response()->json([
                'message'=>'Ups , You dont permission to add one item to cart'
            ], 400);
        }

        $request->cart = $cart;


        return $next($request);
    }
}
