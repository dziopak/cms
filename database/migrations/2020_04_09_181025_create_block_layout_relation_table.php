<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockLayoutRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_layout', function (Blueprint $table) {
            $table->integer('block_id')->unsigned();
            $table->integer('layout_id')->unsigned();
            $table->tinyInteger('x');
            $table->tinyInteger('y');
            $table->tinyInteger('width');
            $table->tinyInteger('height');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block_layout');
    }
}
