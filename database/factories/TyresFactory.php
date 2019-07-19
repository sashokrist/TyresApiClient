<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Tyre::class, function (Faker $faker) {
    return [
        'manufacture' => $faker->text(50),
        'price' => $faker->numberBetween(1, 500),
        'image' => $faker->image(null, 100, 100),
        'type' => $faker->text(20),
        'manufactureDate' => $faker->date()
    ];
});
