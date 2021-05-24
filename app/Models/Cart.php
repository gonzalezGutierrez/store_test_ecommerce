<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @method static create(array $array)
 * @method products()
 * @method static findOrFail($cartId)
 */
class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id'];

    public function items(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'item_carts')
            ->withPivot('subtotal','amount','price')
            ->withTimestamps();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getItems()
    {
        return $this->items()
            ->selectRaw('
                products.id,
                products.name,
                products.slug,
                products.image_url,
                item_carts.price,
                sum(item_carts.amount) amount,
                sum(item_carts.subtotal) subtotal
            ')
            ->groupBy('item_carts.product_id')
            ->get();
    }

    public function total()
    {
        return $this->getItems()->sum('subtotal');
    }

}
