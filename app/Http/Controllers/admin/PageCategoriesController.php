<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Session;

use App\PageCategory;
use App\Log;
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
        $id = PageCategory::create($data)->id;

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $id,
            'target_name' => $data['name'],
            'type' => 'PAGE_CATEGORY',
            'crud_action' => '1',
            'message' => 'created page category'
        ];

        Log::create($log_data);
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

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $category->name,
            'type' => 'PAGE_CATEGORY',
            'crud_action' => '2',
            'message' => 'updated page category'
        ];

        Log::create($log_data);
        Session::flash('crud', 'Page category "'.$category->name.'" has been updated successfully.');

        $category->update($data);
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

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $category->name,
            'type' => 'PAGE_CATEGORY',
            'crud_action' => '3',
            'message' => 'deleted page category'
        ];

        Log::create($log_data);
        Session::flash('crud', 'Page category "'.$category->name.'" has been deleted successfully.');

        $category->delete();
        return redirect(route('admin.pages.categories.index'));
    }
}
