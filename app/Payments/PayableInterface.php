<?php


namespace App\Payments;


interface PayableInterface
{
    public function pay(array $payload);
}
