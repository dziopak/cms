<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use Illuminate\Support\Facades\Session;

use App\Page;
use App\PageCategory;
use Auth;

class PagesController extends Controller
{

    public function index(Request $request)
    {
        $pages = Page::with('author', 'thumbnail')->filter($request)->paginate(15);
        $table = getData('admin/pages/pages_index_table');

        return view('admin.pages.index', compact('pages', 'table'));
    }

    public function create()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_CREATE');

        $page_cat = new PageCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $page_cat->list_all());
        
        $form = getData('admin/pages_form', ['categories' => $categories]);
        return view('admin.pages.create', compact('form'));
    }

    public function store(PagesRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_CREATE');
        
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        $page = Page::create($data);
        Session::flash('crud', 'Page "'.$data['name'].'" has been created successfully.');

        return redirect(route('admin.pages.index'));
    }

    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        
        $page = Page::findOrFail($id);
    
        $categories[0] = 'No category';
        $categories = array_merge($categories, PageCategory::list_all());
        
        $form = getData('admin/pages/pages_form', ['categories' => $categories]);
        return view('admin.pages.edit', compact('page', 'form'));
    }

    public function update(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        
        $page = Page::findOrFail($id);
        
        $page->update($request->all());
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
        $page->delete();
        
        return redirect(route('admin.pages.index'));
    }

    public function mass(Request $request) {
        $data = $request->all();
        if (empty($data['mass_edit'])) {
            return Redirect::back()->with('error', 'No pages were selected.');
        } else {
            switch($data['mass_action']) {
                case 'delete':
                    Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
                    Page::whereIn('id', $data['mass_edit'])->delete();
                break;
                
                case 'hide':
                    Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
                    Page::whereIn('id', $data['mass_edit'])->update(['is_active' => 0]);
                break;
                
                case 'show':
                    Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
                    Page::whereIn('id', $data['mass_edit'])->update(['is_active' => 1]);
                break;
                
                case 'category':
                    // TO DO //
                    Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
                    return Redirect::back()->with('error', 'Functionality not ready yet.');
                break;
            }
        }
        return redirect(route('admin.pages.index'));
    }
}
