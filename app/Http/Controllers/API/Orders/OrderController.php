<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Services\Orders\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index( OrderService $orderService)
    {
        return $orderService->getAll(Auth::user());
    }

    public function show(OrderService  $orderService , $orderKey)
    {
        return $orderService->getOne($orderKey);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
