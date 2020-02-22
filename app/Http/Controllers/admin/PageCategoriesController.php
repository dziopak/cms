<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Session;

use App\Events\Categories\CategoryCreateEvent;
use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;

use App\PageCategory;
use Auth;

class PageCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PageCategory::paginate(15);
        return view('admin.page_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');

        $page_cat = new PageCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $page_cat->list_all());
        
        return view('admin.page_categories.create', compact('categories'));
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

        $data = $request->all();
        $category = PageCategory::create($data);

        event(new CategoryCreateEvent($category, 'PAGE'));
        Session::flash('crud', 'Page category "'.$data['name'].'" has been created successfully.');

        return redirect(route('admin.pages.categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $category = new PageCategory;
        
        $categories[0] = 'No category';
        $categories = array_merge($categories, $category->list_all());

        $category = $category::findOrFail($id);
        return view('admin.page_categories.edit', compact('category', 'categories'));
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
    
        $category = PageCategory::findOrFail($id);    
        $data = $request->all();

        $category->update($data);
        Session::flash('crud', 'Page category "'.$category->name.'" has been updated successfully.');
        
        event(new CategoryUpdateEvent($category, 'PAGE'));
        
        return redirect(route('admin.pages.categories.index'));
    }

    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        $category = PageCategory::findOrFail($id);
        
        return view('admin.page_categories.delete', compact('category'));
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
        $category = PageCategory::findOrFail($id);

        event(new CategoryDestroyEvent($category, 'PAGE'));
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
