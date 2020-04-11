<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'name_pl' => $faker->sentence,
        'excerpt' => $faker->paragraph(2),
        'excerpt_pl' => $faker->paragraph(2),
        'slug' => $faker->word,
        'slug_pl' => $faker->word,
        'content' => $faker->text(600),
        'content_pl' => $faker->text(600),
        'user_id' => '1',
        'category_id' => $faker->numberBetween(0, 1),
        // 'created_at' => $faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now')
    ];
});
