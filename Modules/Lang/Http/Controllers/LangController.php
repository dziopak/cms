<?php

namespace Modules\Lang\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Lang\Entities\Lang;


class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $langs = Lang::all();
        return view('lang::index', compact('langs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('lang::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
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
            $table->string('meta_description_'.$tag)->nullable();
        });
        
        // Pages table
        Schema::table('pages', function (Blueprint $table) use ($tag) {
            $table->string('name_'.$tag);
            $table->string('slug_'.$tag)->index();
            $table->mediumText('excerpt_'.$tag);
            $table->mediumText('content_'.$tag);
            $table->string('meta_title_'.$tag)->nullable();
            $table->string('meta_description_'.$tag)->nullable();
        });

        // Posts categories table
        Schema::table('post_categories', function (Blueprint $table) use ($tag) {
            $table->string('name_'.$tag);
            $table->string('slug_'.$tag)->index();
            $table->string('description_'.$tag);
        });

        // Page categories table
        Schema::table('page_categories', function (Blueprint $table) use ($tag) {
            $table->string('name_'.$tag);
            $table->string('slug_'.$tag)->index();
            $table->string('description_'.$tag);
        });

        Lang::create($data);
        return redirect(route('admin.modules.lang.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('lang::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $lang = Lang::findOrFail($id);
        return view('lang::edit', compact('lang'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
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

        return redirect(route('admin.modules.lang.index'));
    }

    public function setLang(Request $request) {
        session(['lang' => $request->get('lang')]);
        return redirect()->back();
    }
}
