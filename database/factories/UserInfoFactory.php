<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User_Info;
use Faker\Generator as Faker;

$factory->define(User_Info::class, function (Faker $faker) {
    return [
            'user_id' => function() {
                return factory(App\User::class)->create()->id;
            },
            'profile' => $faker->sentence,
            'photo' => '/images/avatar.jpg',
            'github' => 'hirakumorishima02',
            'url' => $faker->url,
    ];
});
