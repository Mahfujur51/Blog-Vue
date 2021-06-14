<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function(Faker $faker) {
    return [
        'category_id'=>rand(1,10),
        'user_id'=>rand(1,10),
        'comment_id'=>rand(1,10),
        'title' => $faker->sentence(10),
        'description' => $faker->sentence(50),
        'image' => $faker->imageUrl,
    ];
});
