<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPivotFieldsToBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->integer('layout_id')->unsigned();
            $table->tinyInteger('x')->default(0);
            $table->tinyInteger('y')->default(0);
            $table->tinyInteger('width')->default(3);
            $table->tinyInteger('height')->default(1);
        });

        Schema::dropIfExists('block_layout');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropColumn('layout_id');
            $table->dropColumn('x');
            $table->dropColumn('y');
            $table->dropColumn('width');
            $table->dropColumn('height');
        });

        Schema::create('block_layout', function (Blueprint $table) {
            $table->integer('block_id')->unsigned();
            $table->integer('layout_id')->unsigned();
            $table->tinyInteger('x');
            $table->tinyInteger('y');
            $table->tinyInteger('width');
            $table->tinyInteger('height');
        });
    }
}
