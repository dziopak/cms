<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Session;

use App\PostCategory;
use App\Log;
use Auth;

class PostCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PostCategory::paginate(15);
        return view('admin.post_categories.index', compact('categories'));
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

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $id,
            'target_name' => $data['name'],
            'type' => 'POST_CATEGORY',
            'crud_action' => '1',
            'message' => 'created post category'
        ];

        Log::create($log_data);
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

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $category->name,
            'type' => 'POST_CATEGORY',
            'crud_action' => '2',
            'message' => 'updated post category'
        ];

        Log::create($log_data);
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

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => 0,
            'target_name' => $category->name,
            'type' => 'POST_CATEGORY',
            'crud_action' => '3',
            'message' => 'deleted post category'
        ];

        Log::create($log_data);
        Session::flash('crud', 'Post category "'.$category->name.'" has been deleted successfully.');

        $category->delete();
        return redirect(route('admin.posts.categories.index'));
    }
}
