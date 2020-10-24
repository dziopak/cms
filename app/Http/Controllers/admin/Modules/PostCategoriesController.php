<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use App\Http\Utilities\Admin\Modules\Categories\PostCategoryEntity;

use App\PostCategory;
use Auth;

class PostCategoriesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.post_categories.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');
        return view('admin.post_categories.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');
        return PostCategoryEntity::store($request);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return view('admin.post_categories.edit', ['category_id' => $id]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return PostCategoryEntity::update($id, $request);
    }


    public function delete($id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        $category = PostCategory::findOrFail($id);
        return view('admin.post_categories.delete', compact('category'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        return PostCategoryEntity::destroy($id);
    }


    public function mass(Request $request)
    {
        return PostCategoryEntity::massAction($request);
    }
}
