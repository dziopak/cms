<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use Illuminate\Support\Facades\Session;

use App\Page;
use App\File;
use App\Log;
use App\PageCategory;
use Auth;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::with('author', 'thumbnail')->paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');

        $page_cat = new PageCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $page_cat->list_all());
        
        return view('admin.pages.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagesRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;
        !isset($data['index']) ? $data['index'] = 0 : "";
        !isset($data['follow']) ? $data['follow'] = 0 : "";
        
        if ($thumbnail = $request->file('thumbnail')) {
            $name = time(). '_' .$thumbnail->getClientOriginalName();
            $thumbnail->move('images/thumbnails', $name);
            
            $photo = File::create(['path' => 'thumbnails/'.$name, 'type' => '1']);
            $data['file_id'] = $photo->id;
        }

        $id = Page::create($data)->id;

        $log_data = [
            'user_id' => $data['user_id'],
            'target_id' => $id,
            'target_name' => $data['name'],
            'type' => 'PAGE',
            'crud_action' => '1',
            'message' => 'created new page'
        ];

        Log::create($log_data);
        Session::flash('crud', 'Page "'.$data['name'].'" has been created successfully.');

        return redirect(route('admin.pages.index'));
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
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        $page = Page::findOrFail($id);
        $page_cat = new PostCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $page_cat->list_all());
        return view('admin.pages.edit', compact('page', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        
        $page = Page::findOrFail($id);
        $data = $request->all();
        if ($thumbnail = $request->file('thumbnail')) {
            $name = time(). '_' .$thumbnail->getClientOriginalName();
            $thumbnail->move('images/thumbnails', $name);
            
            $photo = File::create(['path' => 'thumbnails/'.$name, 'type' => '1']);
            $data['file_id'] = $photo->id;
        }

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $page->id,
            'target_name' => $data['name'],
            'type' => 'PAGE',
            'crud_action' => '2',
            'message' => 'edited page'
        ];
        
        $page->update($data);

        Log::create($log_data);
        Session::flash('crud', 'Page "'.$data['name'].'" has been updated successfully.');

        return redirect(route('admin.pages.index'));
    }

    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
        $page = Page::findOrFail($id);
        return view('admin.pages.delete', compact('page'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
        $page = Page::findOrFail($id);

        $log_data = [
            'user_id' => $page->user_id,
            'target_id' => $page->id,
            'target_name' => $page->name,
            'type' => 'PAGE',
            'crud_action' => '3',
            'message' => 'deleted page'
        ];

        Session::flash('crud', 'Page "'.$page->name.'" has been deleted successfully.');
        Log::create($log_data);
        
        $page->delete();
        
        return redirect(route('admin.pages.index'));
    }
}
