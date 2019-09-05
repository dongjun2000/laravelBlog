<?php

use Faker\Generator as Faker;

$factory->define(App\Blog::class, function (Faker $faker) {
    $user = \App\User::pluck('id');
    return [
        'content' => $faker->text(200),
        'user_id' => $faker->randomElement($user->toArray())
    ];
});
