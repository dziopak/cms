<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use App\Http\Utilities\Admin\Modules\Categories\PageCategoryEntity;

use App\Entities\PageCategory;
use Auth;

class PageCategoriesController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.page_categories.index');
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');
        return view('admin.page_categories.create');
    }


    public function store(CategoriesRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');

        PageCategory::create($request->all());
        return redirect(route('admin.pages.categories.index'));
    }


    public function edit(PageCategory $category)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return view('admin.page_categories.edit', compact('category'));
    }


    public function update(CategoriesRequest $request, PageCategory $category)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return PageCategoryEntity::update($category, $request);
    }

    public function delete(PageCategory $category)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        return view('admin.page_categories.delete', compact('category'));
    }


    public function destroy(PageCategory $category)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        return PageCategoryEntity::destroy($category);
    }

    public function mass(Request $request)
    {
        return PageCategoryEntity::massAction($request);
    }
}
