<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use App\Http\Utilities\Admin\PageCategoryUtilities;

use App\PageCategory;
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


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return view('admin.page_categories.edit', ['category_id' => $id]);
    }


    public function update(CategoriesRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return PageCategoryUtilities::update($id, $request);
    }

    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        
        $category = PageCategory::findOrFail($id);
        return view('admin.page_categories.delete', compact('category'));
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        return PageCategoryUtilities::destroy($id);
    }

    public function mass(Request $request) {
        return PageCategoryUtilities::massAction($request);
    }
}
