<?php

namespace App\Http\Utilities\Admin\Modules\Pages;

use App\Http\Utilities\Admin\Modules\Pages\PageFiles;
use App\Entities\Page;
use App\Interfaces\WebEntity;
use Auth;

class PageEntity implements WebEntity
{

    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        $perPage = config('global')['content']['admin_pages_per_page'] ?? 15;

        return view('admin.pages.index', [
            'pages' => Page::with('author', 'thumbnail')->filter($request)->paginate($perPage)
        ]);
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_CREATE');
        return view('admin.pages.create');
    }


    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_CREATE');

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        Page::create($data);

        return redirect(route('admin.pages.index'));
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        return view('admin.pages.edit', [
            'page' => $this->item
        ]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');

        if ($request->get('request') === 'photo') {
            return (new PageFiles([$this->item->id]))->updateThumbnail($request->get('file'));
        }

        $this->item->update($request->except('thumbnail'));
        return redirect(route('admin.pages.index'));
    }


    public function destroy()
    {
        if (!Auth::user()->hasAccess('PAGE_DELETE')) {
            return redirect()->back()->with('error', 'You don\'t have rights to finish this action.');
        }

        $this->item->delete();
        // $items = MenuItem::where(['model_type' => 'page', 'model_id' => $this->item->id])->delete();

        return response()->json([
            'message' => __('admin/messages.pages.delete.success'),
            'id' => $this->item->id
        ], 200);
    }
}
