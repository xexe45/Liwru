<?php

use Faker\Generator as Faker;

$factory->define(App\Province::class, function (Faker $faker) {
    return [
        'department_id' => \App\Department::find(1)->id,
        'name' => $faker->name,
    ];
});
