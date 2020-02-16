<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->string('excerpt');
            $table->string('slug');
            $table->text('content');
            $table->bigInteger('file_id')->index()->nullable();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('category_id')->index()->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('index')->default(false);
            $table->boolean('follow')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
