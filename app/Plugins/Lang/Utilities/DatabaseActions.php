<?php

namespace App\Plugins\Lang\Utilities;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DatabaseActions
{
    private $tag;

    public function __construct($tag)
    {
        $this->tag = $tag;
    }


    public function createPostFields()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('name_' . $this->tag)->nullable();
            $table->string('slug_' . $this->tag)->index()->nullable();
            $table->mediumText('excerpt_' . $this->tag)->nullable();
            $table->mediumText('content_' . $this->tag)->nullable();
            $table->string('meta_title_' . $this->tag)->nullable();
            $table->mediumText('meta_description_' . $this->tag)->nullable();
        });

        return $this;
    }


    public function createPageFields()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('name_' . $this->tag)->nullable();
            $table->string('slug_' . $this->tag)->index()->nullable();
            $table->mediumText('excerpt_' . $this->tag)->nullable();
            $table->mediumText('content_' . $this->tag)->nullable();
            $table->string('meta_title_' . $this->tag)->nullable();
            $table->mediumText('meta_description_' . $this->tag)->nullable();
        });

        return $this;
    }


    public function createCategoryFields()
    {
        // Post categories table
        Schema::table('post_categories', function (Blueprint $table) {
            $table->string('name_' . $this->tag)->nullable();
            $table->string('slug_' . $this->tag)->index()->nullable();
            $table->mediumText('description_' . $this->tag)->nullable();
        });

        // Page categories table
        Schema::table('page_categories', function (Blueprint $table) {
            $table->string('name_' . $this->tag)->nullable();
            $table->string('slug_' . $this->tag)->index()->nullable();
            $table->mediumText('description_' . $this->tag)->nullable();
        });

        return $this;
    }


    public function createLang()
    {
        // Create lang fields in database
        $this->createPostFields()
            ->createPageFields()
            ->createCategoryFields();
    }


    private function deletePostFields()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('name_' . $this->tag);
            $table->dropColumn('slug_' . $this->tag);
            $table->dropColumn('excerpt_' . $this->tag);
            $table->dropColumn('content_' . $this->tag);
            $table->dropColumn('meta_title_' . $this->tag)->nullable();
            $table->dropColumn('meta_description_' . $this->tag)->nullable();
        });

        return $this;
    }

    private function deletePageFields()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('name_' . $this->tag);
            $table->dropColumn('slug_' . $this->tag);
            $table->dropColumn('excerpt_' . $this->tag);
            $table->dropColumn('content_' . $this->tag);
            $table->dropColumn('meta_title_' . $this->tag)->nullable();
            $table->dropColumn('meta_description_' . $this->tag)->nullable();
        });

        return $this;
    }

    private function deleteCategoryFields()
    {
        // Posts categories table
        Schema::table('post_categories', function (Blueprint $table) {
            $table->dropColumn('name_' . $this->tag);
            $table->dropColumn('slug_' . $this->tag)->index();
            $table->dropColumn('description_' . $this->tag);
        });

        // Page categories table
        Schema::table('page_categories', function (Blueprint $table) {
            $table->dropColumn('name_' . $this->tag);
            $table->dropColumn('slug_' . $this->tag)->index();
            $table->dropColumn('description_' . $this->tag);
        });
    }


    public function deleteLang()
    {

        // Delete lang fields in database
        $this->deletePostFields()
            ->deletePageFields()
            ->deleteCategoryFields();
    }
}



        // Testimonials module table
        // Schema::table('testimonials', function (Blueprint $table) use ($tag) {
        //     $table->dropColumn('author_title_' . $tag);
        //     $table->dropColumn('content_' . $tag);
        // });



         // Testimonials module table
        // Schema::table('testimonials', function (Blueprint $table) use ($tag) {
        //     $table->string('author_title_' . $tag)->nullable();
        //     $table->mediumText('content_' . $tag)->nullable();
        // });

        // Portfolio module table
        // Schema::table('portfolio_items', function (Blueprint $table) use ($tag) {
        //     $table->mediumText('intro_' . $tag)->nullable();
        //     $table->mediumText('desc_' . $tag)->nullable();
        // });
