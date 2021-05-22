<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static create($request)
 * @method static where(string $string, $id)
 */
class Product extends Model
{

    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description','price','status','slug','image_url'];

    public $allowedSorts = ['name','price'];

    protected $casts = [
        'id'=>'string'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query)
    {

        foreach (request('filter',[]) as $filter => $value )
        {
            abort_unless($this->hasNamedScope($filter),400,"The filter '{$filter}' is not allowed ");
            $query->{$filter}($value);
        }

        return ( request('filter.news') != null || request('filter.featured') != null )
            ? $query->get()
            : $query->paginate(10);
    }

    public function scopeName(Builder $query , $value): Builder
    {
        return $query->where('name','LIKE',"%{$value}%");
    }

    public function scopeNews(Builder $query,$value): Builder
    {
        return $query->take(6);
    }

    public function scopeFeatured(Builder $query , $value): Builder
    {
        return $query->inRandomOrder()->take(4);
    }

    public function scopeCategory(Builder $query,$value): Builder
    {
        return $query->where('category_id',$value);
    }

    public function scopeSort(Builder $query): Builder
    {
        if (!property_exists($this,'allowedSorts'))
        {
            abort(500,'Please set the public array property $allowedSorts=[] inside'.get_class($this));
        }

        if (is_null($sort=request('sort')))
        {
            return $query;
        }

        $direction = 'ASC';
        $sortFields = Str::of($sort)->explode(',');

        foreach ($sortFields as $sortField)
        {
            $direction = 'ASC';

            if ($this->isAFieldWithDirectionDesc($sortField))
            {
                $direction = 'DESC';
                $sortField = Str::of($sortField)->substr('1');
            }

            if (!$this->isAPermittedFieldToSort($sortField))
            {
                abort(400,"Invalid Query Parameter, {$sortField} is not allowed");
            }

            $query->orderBy($sortField,$direction);
        }

        return $query;

    }

    private  function isAPermittedFieldToSort($field): bool
    {
        return collect($this->allowedSorts)->contains($field);
    }

    private function isAFieldWithDirectionDesc($field): bool
    {
        return Str::of($field)->startsWith('-');
    }

    public static function issetSlug($slug)
    {
        return Product::where('slug',$slug)->first();
    }


}
