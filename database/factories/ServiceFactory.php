<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'title_ge' => $faker->word,
        'body_ge' => $faker->realText,
        'price' => $faker->randomNumber(2),
        'unit_ge' => $faker->word,
        'published' => $faker->boolean(5)
    ];
});
