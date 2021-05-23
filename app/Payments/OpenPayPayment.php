<?php


namespace App\Payments;

use Openpay;
use Exception;
use OpenpayApiError;
use OpenpayApiAuthError;
use OpenpayApiRequestError;
use OpenpayApiConnectionError;
use OpenpayApiTransactionError;
use Illuminate\Http\JsonResponse;


class OpenPayPayment implements PayableInterface
{


    public function pay(array $dataPayment)
    {

        // create instance OpenPay
        $openpay = Openpay::getInstance(env('OPENPAY_ID'), env('OPENPAY_SK'));

        Openpay::setProductionMode(env('OPENPAY_PRODUCTION_MODE'));

        $cart = $dataPayment['cart'];

        $amount = $cart->total();

        $chargeRequest =  array(
            'method' => 'card',
            'source_id' => $dataPayment['payment']['token'],
            'amount' => $amount,
            'currency' => 'USD',
            'description' => 'Store Payment',
            'device_session_id' => $dataPayment['payment']['deviceSessionId'],
            'customer' => $dataPayment['customer']
        );

        $charge = $openpay->charges->create($chargeRequest);

        return array(
            'payment_code'=>$charge->id,
            'address_shipping' => $dataPayment['address'],
            'total_payment' => $amount,
            'cart' => $cart
        );

    }
}
