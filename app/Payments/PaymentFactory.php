<?php


namespace App\Payments;


class PaymentFactory
{
    public function initialize($type)
    {
        switch ($type)
        {
            case 'card':{
                return new OpenPayPayment();
                break;
            }
            default:{
                throw new \Exception("payment not supported ");
                break;
            }
        }
    }
}
