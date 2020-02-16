<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'excerpt' => $faker->paragraph(2),
        'slug' => $faker->unique()->word,
        'content' => $faker->text(600),
        'user_id' => '1',
        'category_id' => $faker->numberBetween(0, 1)
    ];
});
