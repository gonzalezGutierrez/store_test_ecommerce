<?php


namespace App\Services\Orders;


use App\Http\Resources\Orders\OrderCollection;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Models\ShippingAddress;
use Illuminate\Database\Eloquent\Builder;

class OrderService
{

    public function getAll($user)
    {

        $orderQuery = Order::query();

        $orderQuery->orderBy('created_at','DESC');

        if (!$user->hasRole('admin')) {
            $orderQuery->where('user_id',$user->id);
        }

        return new OrderCollection($orderQuery->get());
    }

    public function getOne($orderKey)
    {

        $order = Order::with(['cart','shippingAddress','cart.user'])->where('order_key',$orderKey)->firstOrFail();

        return new OrderResource($order);

    }

    public function store(array $payment ) {


        $shippingAddress = ShippingAddress::create($payment['address_shipping']);

        $order = Order::create([
            'cart_id' => $payment['cart']->id,
            'user_id'=>$payment['cart']->user_id,
            'total' => $payment['total_payment'],
            'order_key' => uniqid(),
            'shipping_address_id'=>$shippingAddress->id
        ]);

        return response()->json([
            'message'=>'Order Created Successfuly',
            'order_id'=>$order->id,
            'order_key'=>$order->order_key
        ]);

    }

}
