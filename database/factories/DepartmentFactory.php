<?php

use Faker\Generator as Faker;

$factory->define(App\Department::class, function (Faker $faker) {
    return [
        'country_id' => \App\Country::find(1)->id,
        'name' => $faker->name,
    ];
});
