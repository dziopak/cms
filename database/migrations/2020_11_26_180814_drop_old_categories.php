<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropOldCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('page_categories');

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // NO WAY BACK
    }
}
