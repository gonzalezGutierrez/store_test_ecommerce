<?php


namespace App\Services\Cart;


use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Models\ItemCart;
use App\Models\Product;
use App\Payments\PaymentFactory;
use App\Services\BaseServiceInterface;
use App\Services\Orders\OrderService;
use App\Services\Products\ProductService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
        $cart = Cart::with('items')->findOrFail($id);
        return new CartResource($cart);
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

    public function addItem($request)
    {

        DB::beginTransaction();

        try {

            $product = Product::findOrFail($request->item_id);

            $cart    = $request->cart;

            $amount  = $request->amount ? $request->amount : 1;

            $item = [
                'amount'=>$amount,
                'subtotal'=> $amount * $product->price ,
                'price' =>  $product->price
            ];

            $cart->items()->attach($product->id,$item);

            DB::commit();

            return response()->json(['message'=>'Item add successfully'], Response::HTTP_CREATED);

        }catch (\Exception $exception) {

            DB::rollBack();
            return response()->json([
                'message'=>'Error to add Item',
                'error'=>$exception->getMessage()
            ],Response::HTTP_BAD_REQUEST);

        }
    }

    public function removeItem($request): \Illuminate\Http\JsonResponse
    {

        try {

            $cart = $request->cart;

            $product = Product::findOrFail($request->item_id);

            ItemCart::where([['product_id',$product->id],['cart_id',$cart->id]])
                ->delete();

            return response()->json(['message'=>'Item Removed Successfuly'],Response::HTTP_OK);

        }catch (\Exception $exception) {
            return response()->json([
                'message'=>'Error to Remove Item',
                'error'=>$exception->getMessage()
            ] ,  Response::HTTP_BAD_REQUEST);
        }

    }

    public function checkout($request, $cartId)
    {

        DB::beginTransaction();

        try {

            $paymentFactory = new PaymentFactory();

            $payment = $paymentFactory->initialize('card');

            $request['cart'] = Cart::findOrFail($cartId);

            $paymentResponse = $payment->pay($request);

            $orderService = new OrderService();

            $response  = $orderService->store($paymentResponse);

            DB::commit();

            return $response;

        }catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }



    }



}
