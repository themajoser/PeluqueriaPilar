<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;
class Movement extends Model
{
    use SoftDeletes;
    public $timestamps = false;

   public  const OPERATIONS = [
        'add',
        'quit',
    ];
        protected $fillable = ['product_id', 'quantity', 'operation', 'note','stock_after'];
        protected $dates = ['created_at','deleted_at'];

    public function product()
    {
        return  $this->belongsTo(Product::class);
    }

   


    public static function boot()
    {
        parent::boot();
        static::created(function ($Movement){
            if( $Movement->operation=="add"){
                $resultado= $Movement->product->stock + $Movement->quantity;
            }
            if( $Movement->operation=="quit"){
                $resultado= $Movement->product->stock - $Movement->quantity;
            }
            $Movement->product->stock= $resultado;
            $Movement->product->save();

            $Movement->stock_after= $Movement->product->stock;
            $Movement->save();
        });
        static::deleting(function ($Movement) {
            $product=Product::getById($Movement->product_id);

           if( $Movement->operation=="add"){
            $resultado= $product->stock  - $Movement->quantity;
           }

          if( $Movement->operation=="quit"){
             $resultado=$product->stock  + $Movement->quantity;
            }
            $product->stock =$resultado ;
            $product->save();


        });


    }
}
