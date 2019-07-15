<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Subscribe;
use Faker\Generator as Faker;

$factory->define(Subscribe::class, function (Faker $faker) {
    return [
            'user_id' => function() {
                return factory(App\User::class)->create()->id;
            },
            'job_id' => function() {
                return factory(App\Job::class)->create()->id;
            },
            'status' => $faker->numberBetween(1, 4),
            'message' => $faker->sentence,
    ];
});
