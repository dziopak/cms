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
        if (!empty($request->get('search'))) {
            $categories = PostCategory::with('author', 'thumbnail')->where('name', 'like', '%'.$request->get('search').'%')->paginate(15);
        } else {
            $categories = PostCategory::paginate(15);
        }
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

        $post_cat = new PostCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $post_cat->list_all());
        
        return view('admin.post_categories.create', compact('categories'));
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
        $id = PostCategory::create($data)->id;

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
        $category = new PostCategory;
        
        $categories[0] = 'No category';
        $categories = array_merge($categories, $category->list_all());

        $category = $category::findOrFail($id);
        return view('admin.post_categories.edit', compact('category', 'categories'));
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
