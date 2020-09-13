<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioContentBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_content_boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('portfolio_item_id')->unsigned()->foreign('portfolio_item_id')->references('id')->on('portfolio_items')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('content');

            // TO DO //
            // LANG PLUGIN //
            $table->string('title_pl')->nullable();
            $table->text('content_pl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_content_boxes');
    }
}
