<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'url', 'brand', 'min', 'state', 'price', 'description', 'stock'];
    protected $dates = ['created_at', 'updated_at','deleted_at'];

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function($product){
            $product->movements()->delete();
        });
        static::updating(function($product) {
            if($product->stock >= $product->min ){
                $product->state="below";
            }
        });
    }
    public static function create(array $attributes = [])
    {

        $product = static::query()->create($attributes);

        $product->generateSlug();

        return $product;
    }

    public function generateSlug()
    {
        $url = Str::slug($this->name);

        if(static::whereUrl($url)->exists()) {
            $url .= '--' . static::where('url', 'like', $url . '-%')->count();
        }

        $this->url = $url;
        $this->save();
    }

    public function getRouteKeyName()
    {
        return 'url';
    }

    public static function updateState(Collection $products){

        foreach($products as $product){
            if($product->stock >= $product->min ){
                 $product->state="below";
            }
            if($product->stock <= $product->min ){
                $product->state="above";
           }
            $resultado[]=$product;
        }

        return $resultado;
    }
}
