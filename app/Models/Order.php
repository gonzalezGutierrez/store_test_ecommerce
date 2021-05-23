<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = ['cart_id','total','user_id','order_key','shipping_address_id'];

    public function shippingAddress(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ShippingAddress::class);
    }

    public function setOrderKeyAtrribute($cartId)
    {
        $this->attributes['order_key'] = uniqid().$cartId;
    }


}
