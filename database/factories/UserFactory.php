<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {

    User::unsetEventDispatcher();
    return [
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'role_id' => '1',
        'is_active' => $faker->numberBetween(0, 1),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'avatar' => '1',
        'locale' => 'en'
    ];
});
