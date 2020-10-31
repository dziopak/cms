<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use App\Http\Utilities\Admin\Modules\Categories\PostCategoryEntity;

use App\Entities\PostCategory;
use Auth;

class PostCategoriesController extends Controller
{


    public function index(Request $request)
    {
        return view('admin.post_categories.index');
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');
        return view('admin.post_categories.create');
    }


    public function store(CategoriesRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');
        return PostCategoryEntity::store($request);
    }


    public function edit(PostCategory $category)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return view('admin.post_categories.edit', compact('category'));
    }


    public function update(CategoriesRequest $request, PostCategory $category)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return PostCategoryEntity::update($category, $request);
    }


    public function delete(PostCategory $category)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        return view('admin.post_categories.delete', compact('category'));
    }


    public function destroy(PostCategory $category)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        return PostCategoryEntity::destroy($category);
    }


    public function mass(Request $request)
    {
        return PostCategoryEntity::massAction($request);
    }
}
