<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Portfolio;
use Faker\Generator as Faker;

$factory->define(Portfolio::class, function (Faker $faker) {
    return [
            'user_id' => function() {
                return factory(App\User::class)->create()->id;
            },
            'title' => $faker->word,
    ];
});
