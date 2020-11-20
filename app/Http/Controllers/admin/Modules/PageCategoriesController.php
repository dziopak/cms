<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Modules\Categories\CategoriesRequest;
use App\Entities\PageCategory;

class PageCategoriesController extends Controller
{

    public function index(Request $request)
    {
        return PageCategory::webIndex($request);
    }

    public function create()
    {
        return PageCategory::webCreate();
    }

    public function store(CategoriesRequest $request)
    {
        return PageCategory::webStore($request);
    }

    public function edit($category)
    {
        return PageCategory::findOrFail($category)->webEdit();
    }

    public function update(CategoriesRequest $request, $category)
    {
        return PageCategory::findOrFail($category)->webUpdate($request);
    }

    public function destroy($category)
    {
        return PageCategory::findOrFail($category)->webDestroy();
    }

    public function mass()
    {
        return PageCategory::mass();
    }
}
