<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->index();

            $table->tinyInteger('category')->default(0);
            $table->mediumText('intro')->nullable();
            $table->mediumText('description')->nullable();

            $table->bigInteger('file_id')->nullable();

            $table->string('thumb_background')->default('#ffffff');
            $table->string('thumb_color')->default('#ffffff');

            // TO DO //
            // Testimonials plugin //
            $table->bigInteger('testimonial_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_items');
    }
}
