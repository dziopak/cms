<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use Illuminate\Support\Facades\Session;

use App\Events\Pages\PageCreateEvent;
use App\Events\Pages\PageUpdateEvent;
use App\Events\Pages\PageDestroyEvent;

use App\Page;
use App\File;
use App\Log;
use App\PageCategory;
use Auth;

class PagesController extends Controller
{

    public function index()
    {
        $pages = Page::with('author', 'thumbnail')->paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');

        $page_cat = new PageCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $page_cat->list_all());
        
        return view('admin.pages.create', compact('categories'));
    }

    public function store(PagesRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        $thumbnail = $request->file('thumbnail');
        $page = Page::create($data);

        event(new PageCreateEvent($page, $thumbnail));
        Session::flash('crud', 'Page "'.$data['name'].'" has been created successfully.');

        return redirect(route('admin.pages.index'));
    }

    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        
        $page = Page::findOrFail($id);
        $page_cat = new PageCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $page_cat->list_all());
        
        return view('admin.pages.edit', compact('page', 'categories'));
    }

    public function update(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        
        $page = Page::findOrFail($id);
        $thumbnail = $request->file('thumbnail');
        
        $page->update($request->all());
        event(new PageUpdateEvent($page, $thumbnail));
        Session::flash('crud', 'Page "'.$page->name.'" has been updated successfully.');
        
        return redirect(route('admin.pages.index'));
    }

    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
        $page = Page::findOrFail($id);
        return view('admin.pages.delete', compact('page'));
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
        $page = Page::findOrFail($id);
    
        Session::flash('crud', 'Page "'.$page->name.'" has been deleted successfully.');
        event(new PageDestroyEvent($page));

        $page->delete();
        
        return redirect(route('admin.pages.index'));
    }
}
