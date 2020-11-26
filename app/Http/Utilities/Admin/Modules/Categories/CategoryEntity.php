<?php

namespace App\Http\Utilities\Admin\Modules\Categories;

use App\Entities\Category;
use App\Interfaces\WebEntity;
use Auth;

class CategoryEntity implements WebEntity
{

    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        return view('admin.categories.index', [
            'categories' => Category::orderByDesc('id')->filter($request)->paginate(15)
        ]);
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');
        return view('admin.categories.create');
    }


    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');
        Category::create($request->all());

        return redirect(route('admin.categories.index'));
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return view('admin.categories.edit', [
            'category' => $this->item
        ]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        $this->item->update($request->all());

        return redirect(route('admin.categories.index'));
    }


    public function destroy()
    {
        if (!Auth::user()->hasAccess('CATEGORY_DELETE')) {
            return redirect()->back()->with('error', 'You don\'t have rights to finish this action.');
        }

        $this->item->delete();

        return response()->json(
            [
                'message' => __('admin/messages.categories.delete.success'),
                'id' => $this->item->id
            ],
            200
        );
    }
}
