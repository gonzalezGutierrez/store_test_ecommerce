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

    public function shippingAddress(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ShippingAddress::class,'shipping_address_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class,'cart_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function setOrderKeyAtrribute($cartId)
    {
        $this->attributes['order_key'] = uniqid().$cartId;
    }


}
