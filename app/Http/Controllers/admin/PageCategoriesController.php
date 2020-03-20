<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Utilities\TableData;

use App\PageCategory;
use Auth;

class PageCategoriesController extends Controller
{
    
    public function index(Request $request)
    {
        $categories = PageCategory::filter($request)->paginate(15);
        $table = TableData::pageCategoriesIndex();
        return view('admin.page_categories.index', compact('categories', 'table'));
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');

        $page_cat = new PageCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $page_cat->list_all());

        $form = getData('admin/categories/page_categories_form', ['categories' => $categories]);    
        return view('admin.page_categories.create', compact('form'));
    }


    public function store(CategoriesRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');

        $data = $request->all();
        $category = PageCategory::create($data);

        Session::flash('crud', 'Page category "'.$data['name'].'" has been created successfully.');
        return redirect(route('admin.pages.categories.index'));
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        
        $categories[0] = 'No category';
        $categories = array_merge($categories, PageCategory::list_all());

        $category = PageCategory::findOrFail($id);
        $form = getData('admin/categories/page_categories_form', ['categories' => $categories]);
        
        return view('admin.page_categories.edit', compact('category', 'form'));
    }


    public function update(CategoriesRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
    
        $category = PageCategory::findOrFail($id);    
        $data = $request->all();

        $category->update($data);
        Session::flash('crud', 'Page category "'.$category->name.'" has been updated successfully.');
        
        return redirect(route('admin.pages.categories.index'));
    }

    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        $category = PageCategory::findOrFail($id);
        
        return view('admin.page_categories.delete', compact('category'));
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        $category = PageCategory::findOrFail($id);

        Session::flash('crud', 'Page category "'.$category->name.'" has been deleted successfully.');
        $category->delete();
        
        return redirect(route('admin.pages.categories.index'));
    }

    public function mass(Request $request) {
        $data = $request->all();
        if (empty($data['mass_edit'])) {
            return Redirect::back()->with('error', 'No categories were selected.');
        } else {
            switch($data['mass_action']) {
                case 'delete':
                    Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
                    PageCategory::whereIn('id', $data['mass_edit'])->delete();
                break;
            }
        }
        return redirect(route('admin.pages.categories.index'));
    }
}
