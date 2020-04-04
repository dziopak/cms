<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            DB::statement('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
            $table->bigIncrements('id');
            $table->string('path');
            $table->tinyInteger('type');
            $table->timestamps();
        });

        DB::table('files')->insert([
            'id' => 0,
            'path' => 'assets/no-avatar.png',
            'type' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
