<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title_ge' => $faker->word,
        'title_en' => $faker->word,
        'title_ru' => $faker->word,
        'description_ge' => $faker->realtext,
        'description_en' => $faker->realtext,
        'description_ru' => $faker->realtext,
        'price' => $faker->randomNumber(4)
    ];
});
