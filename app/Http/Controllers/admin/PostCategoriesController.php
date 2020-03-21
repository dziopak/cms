<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Session;

use App\Events\Categories\CategoryCreateEvent;
use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;

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
        $categories = PostCategory::filter($request)->paginate(15);
        $table = getData('admin/categories/post_categories_index_table');
        return view('admin.post_categories.index', compact('categories', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');

        $categories[0] = 'No category';
        $categories = array_merge($categories, PostCategory::list_all());

        $form = getData('admin/categories/post_categories_form', ['categories' => $categories]);    
        return view('admin.post_categories.create', compact('categories', 'form'));
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
        $category = PostCategory::create($data);

        event(new CategoryCreateEvent($category, 'POST'));
        Session::flash('crud', 'Post category "'.$data['name'].'" has been created successfully.');

        return redirect(route('admin.posts.categories.index'));
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
        
        $categories[0] = 'No category';
        $categories = array_merge($categories, PostCategory::list_all());
        $category = PostCategory::findOrFail($id);

        $form = getData('admin/categories/post_categories_form', ['categories' => $categories]);    
        return view('admin.post_categories.edit', compact('category', 'categories', 'form'));
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
        
        $category = PostCategory::findOrFail($id);
        $data = $request->all();

        event(new CategoryUpdateEvent($category, 'POST'));
        Session::flash('crud', 'Post category "'.$category->name.'" has been updated successfully.');

        $category->update($data);
        return redirect(route('admin.posts.categories.index'));
    }

    public function delete($id) {
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
        $category = PostCategory::findOrFail($id);

        event(new CategoryDestroyEvent($category, 'POST'));
        Session::flash('crud', 'Post category "'.$category->name.'" has been deleted successfully.');

        $category->delete();
        return redirect(route('admin.posts.categories.index'));
    }

    public function mass(Request $request) {
        $data = $request->all();
        if (empty($data['mass_edit'])) {
            return Redirect::back()->with('error', 'No categories were selected.');
        } else {
            switch($data['mass_action']) {
                case 'delete':
                    Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
                    PostCategory::whereIn('id', $data['mass_edit'])->delete();
                break;
            }
        }
        return redirect(route('admin.posts.categories.index'));
    }
}
