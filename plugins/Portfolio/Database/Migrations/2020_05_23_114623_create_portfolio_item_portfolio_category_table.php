<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioItemPortfolioCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_category_portfolio_item', function (Blueprint $table) {
            $table->integer('portfolio_item_id')->unsigned()->foreign('portfolio_item_id')->references('id')->on('portfolio_items')
                ->onDelete('cascade');
            $table->integer('portfolio_category_id')->unsigned()->foreign('portfolio_category_id')->references('id')->on('portfolio_categories')
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
        Schema::dropIfExists('portfolio_category_portfolio_item');
    }
}
