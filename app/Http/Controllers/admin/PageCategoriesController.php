<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Session;

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

        PageCategory::create($data = $request->all());
        Session::flash('crud', 'Page category "'.$data['name'].'" has been created successfully.');

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
