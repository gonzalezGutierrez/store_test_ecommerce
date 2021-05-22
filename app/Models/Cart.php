<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @method static create(array $array)
 */
class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id'];

    public function items()
    {
        return $this->join('item_carts','carts.id','item_carts.cart_id')
            ->join('products','item_carts.product_id','products.id')
            ->groupBy(
                'products.id',
                'products.name',
                'item_carts.price'
            )
            ->orderBy('item_carts.created_at','DESC')
            ->select(
                DB::raw('sum(item_carts.amount) amount,sum(item_carts.subtotal)  subtotal,products.name  product,products.id  productId,item_carts.price')
            )
            ->get();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'item_carts','product_id')
            ->withPivot('subtotal','amount','price');
    }

    public function total() : Integer
    {
        return $this->items()->sum('subtotal');
    }

}
