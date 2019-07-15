<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
            'user_id' => function () {
            return factory(App\User::class)->create()->id;
            },
            'title' => $faker->word,
            'content' => $faker->sentence,
            'wish_at' => $faker->date,
            'job_photo' => '/images/light.jpg',
            'money' => $faker->numberBetween(1000, 200000),
    ];
});
