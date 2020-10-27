<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use App\Http\Utilities\Admin\Modules\Pages\PageEntity;

use App\Entities\Page;
use Auth;

class PagesController extends Controller
{


    public function index(Request $request)
    {
        return view('admin.pages.index');
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_CREATE');
        return view('admin.pages.create');
    }


    public function store(PagesRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_CREATE');
        return PageEntity::store($request->all());
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        return view('admin.pages.edit', ['page_id' => $id]);
    }


    public function update(PagesRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        return PageEntity::update($id, $request);
    }


    public function delete($id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
        return view('admin.pages.delete', ['page' => Page::findOrFail($id)]);
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
        return PageEntity::destroy($id);
    }


    public function mass(Request $request)
    {
        return PageEntity::massAction($request);
    }
}
