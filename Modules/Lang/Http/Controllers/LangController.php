<?php

namespace Modules\Lang\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Lang\Entities\Lang;
use Modules\Lang\Http\Utilities\TableData;


class LangController extends Controller
{
    public function index()
    {
        $langs = Lang::all();
        $table = TableData::langsIndex();
        return view('lang::index', compact('langs', 'table'));
    }

    public function create()
    {
        return view('lang::create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $tag = $data['lang_tag'];

        // Posts table
        Schema::table('posts', function (Blueprint $table) use ($tag) {
            $table->string('name_'.$tag);
            $table->string('slug_'.$tag)->index();
            $table->mediumText('excerpt_'.$tag);
            $table->mediumText('content_'.$tag);
            $table->string('meta_title_'.$tag)->nullable();
            $table->mediumText('meta_description_'.$tag)->nullable();
        });
        
        // Pages table
        Schema::table('pages', function (Blueprint $table) use ($tag) {
            $table->string('name_'.$tag);
            $table->string('slug_'.$tag)->index();
            $table->mediumText('excerpt_'.$tag);
            $table->mediumText('content_'.$tag);
            $table->string('meta_title_'.$tag)->nullable();
            $table->mediumText('meta_description_'.$tag)->nullable();
        });

        // Posts categories table
        Schema::table('post_categories', function (Blueprint $table) use ($tag) {
            $table->string('name_'.$tag);
            $table->string('slug_'.$tag)->index();
            $table->mediumText('description_'.$tag);
        });

        // Page categories table
        Schema::table('page_categories', function (Blueprint $table) use ($tag) {
            $table->string('name_'.$tag);
            $table->string('slug_'.$tag)->index();
            $table->mediumText('description_'.$tag);
        });

        // Testimonials module table
        Schema::table('testimonials', function (Blueprint $table) use ($tag) {
            $table->string('author_title_'.$tag);
            $table->mediumText('content_'.$tag);
        });

        // Portfolio module table
        Schema::table('portfolio_items', function (Blueprint $table) use ($tag) {
            $table->mediumText('intro_'.$tag);
            $table->mediumText('desc_'.$tag);
        });

        Lang::create($data);
        return redirect(route('admin.modules.lang.index'));
    }

    public function show($id)
    {
        return view('lang::show');
    }

    public function edit($id)
    {
        $lang = Lang::findOrFail($id);
        return view('lang::edit', compact('lang'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['lang_tag']);
        Lang::findOrFail($id)->update($data);
        
        return redirect(route('admin.modules.lang.index'));
    }
    
    public function delete($id)
    {
        $lang = Lang::findOrFail($id);
        return view('lang::delete', compact('lang'));
    }

    public function destroy($id)
    {
        $lang = Lang::findOrFail($id);
        $tag = $lang->lang_tag;
        
        $lang->delete();


        // Posts table
        Schema::table('posts', function (Blueprint $table) use ($tag) {
            $table->dropColumn('name_'.$tag);
            $table->dropColumn('slug_'.$tag);
            $table->dropColumn('excerpt_'.$tag);
            $table->dropColumn('content_'.$tag);
            $table->dropColumn('meta_title_'.$tag)->nullable();
            $table->dropColumn('meta_description_'.$tag)->nullable();
        });
        
        // Pages table
        Schema::table('pages', function (Blueprint $table) use ($tag) {
            $table->dropColumn('name_'.$tag);
            $table->dropColumn('slug_'.$tag);
            $table->dropColumn('excerpt_'.$tag);
            $table->dropColumn('content_'.$tag);
            $table->dropColumn('meta_title_'.$tag)->nullable();
            $table->dropColumn('meta_description_'.$tag)->nullable();
        });

        // Posts categories table
        Schema::table('post_categories', function (Blueprint $table) use ($tag) {
            $table->dropColumn('name_'.$tag);
            $table->dropColumn('slug_'.$tag)->index();
            $table->dropColumn('description_'.$tag);
        });

        // Page categories table
        Schema::table('page_categories', function (Blueprint $table) use ($tag) {
            $table->dropColumn('name_'.$tag);
            $table->dropColumn('slug_'.$tag)->index();
            $table->dropColumn('description_'.$tag);
        });

        // Testimonials module table
        Schema::table('testimonials', function (Blueprint $table) use ($tag) {
            $table->dropColumn('author_title_'.$tag);
            $table->dropColumn('content_'.$tag);
        });

        return redirect(route('admin.modules.lang.index'));
    }

    public function setLang(Request $request) {
        session(['lang' => $request->get('lang')]);
        return redirect()->back();
    }
}
