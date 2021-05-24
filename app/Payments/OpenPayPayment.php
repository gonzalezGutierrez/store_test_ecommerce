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


        try {

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
                'cart' => $cart,
                'payment_ok'=>true
            );

        }catch (OpenpayApiTransactionError $e) {
            return [
                'payment_ok'=>false,
                'errors' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId(),
                ]
            ];
        }catch (OpenpayApiRequestError $e) {
            return [
                'payment_ok'=>false,
                'errors' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ];
        } catch (OpenpayApiConnectionError $e) {
            return [
                'payment_ok'=>false,
                'errors' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ];
        } catch (OpenpayApiAuthError $e) {
            return [
                'errors' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ];
        } catch (OpenpayApiError $e) {
            return [
                'payment_ok'=>false,
                'errors' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ];
        } catch (Exception $e) {
            return [
                'payment_ok'=>false,
                'errors' => [
                    'category' => $e->getCategory(),
                    'error_code' => $e->getErrorCode(),
                    'description' => $e->getMessage(),
                    'http_code' => $e->getHttpCode(),
                    'request_id' => $e->getRequestId()
                ]
            ];
        }


    }
}
