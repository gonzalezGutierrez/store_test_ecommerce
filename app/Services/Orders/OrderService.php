<?php


namespace App\Services\Orders;


use App\Models\Order;
use App\Models\ShippingAddress;

class OrderService
{

    public function store(array $payment ) {


        $shippingAddress = ShippingAddress::create($payment['address_shipping']);

        $order = Order::create([
            'cart_id' => $payment['cart']->id,
            'total' => $payment['total_payment'],
            'order_key' => uniqid().$payment['cart']->id,
            'shipping_address_id'=>$shippingAddress->id
        ]);

        return response()->json([
            'message'=>'Order Created Successfuly',
            'order_id'=>$order->id,
            'order_key'=>$order->order_key
        ]);

    }

}
