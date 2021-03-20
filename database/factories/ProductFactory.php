<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Product;
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->regexify('[A-Za-z0-9]{20}'),
        'brand'=>$faker->regexify('[A-Za-z0-9]{20}'),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 3),
        'description'=> $faker->text($maxNbChars = 100),
        'min'=> $faker->randomDigit,
        'stock'=>  $faker->randomDigit
    ];
});
