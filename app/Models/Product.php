<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($request)
 * @method static where(string $string, $id)
 */
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description','price','status','slug'];

    protected $casts = [
        'id'=>'string'
    ];


    public static function issetSlug($slug)
    {
        return Product::where('slug',$slug)->first();
    }


}
