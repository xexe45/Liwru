<?php

use Faker\Generator as Faker;

$factory->define(App\Library::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'logo' => \Faker\Provider\Image::image(storage_path() . '/app/public/library',600,350,'business',false),
    ];
});
