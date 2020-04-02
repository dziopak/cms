<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            DB::statement('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
            $table->bigIncrements('id');
            $table->string('name');
            $table->mediumText('access')->nullable();
            $table->string('description');
        });
                
        DB::table('roles')->insert([
            'id' => 0,
            'name' => 'Admin',
            'description' => 'Super User'
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
            'description' => 'Regular user with basic access'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
