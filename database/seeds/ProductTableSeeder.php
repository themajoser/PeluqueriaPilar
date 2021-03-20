<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Product;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = factory(Product::class,10)->make();
        $products->each(function($v) {
            $v->url = Str::slug($v->name);
            $v= Product::updateState($v);
            $v->save();
        });
    }
}
