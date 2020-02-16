<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $users = factory(App\User::class, 100)->create();
        $posts = factory(App\Post::class, 100)->create();
    }
}
