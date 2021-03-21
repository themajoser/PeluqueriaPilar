<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;
use Carbon\Carbon;

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
            $Movement->date_create= Carbon::now();
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

    public static function datesForGraficG(){
        return Movement::query()->where('operation','=',"quit")->where('deleted_at','=',null)->whereDate('date_create','>=', Carbon::now()->subDays(7))->get()->groupBy(function($date) {
            return Carbon::parse($date->date_create)->format('d-m-Y' );
        });
    }
    public static function datesForGraficI(){
        return Movement::query()->where('operation','=',"add")->where('deleted_at','=',null)->whereDate('date_create','>=', Carbon::now()->subDays(7))->get()->groupBy(function($date) {
            return Carbon::parse($date->date_create)->format('d-m-Y' );
        });
    }
}
