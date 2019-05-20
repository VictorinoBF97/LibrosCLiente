<?php

use Faker\Generator as Faker;
use App\Publisher;

$factory->define(Publisher::class, function (Faker $faker) {
    $name = $faker->company();

    return [
        'name'      => $name,
        'slug'      => str_slug($name),
        'url'       => $faker->domainName(),
        'email'     => $faker->email(),
        'address'   => $faker->address()
    ];
});
