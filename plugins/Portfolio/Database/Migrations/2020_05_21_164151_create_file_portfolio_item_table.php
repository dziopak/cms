<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilePortfolioItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_portfolio_item', function (Blueprint $table) {
            $table->integer('file_id')->unsigned()->foreign('file_id')->references('id')->on('files')
                ->onDelete('cascade');
            $table->integer('portfolio_item_id')->unsigned()->references('id')->on('portfolio_items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_portfolio_item');
    }
}
