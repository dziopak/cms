<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Modules\Categories\CategoriesRequest;
use App\Entities\Category;

class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        return Category::webIndex($request);
    }

    public function create()
    {
        return Category::webCreate();
    }

    public function store(CategoriesRequest $request)
    {
        return Category::webStore($request);
    }

    public function edit($category)
    {
        return Category::findOrFail($category)->webEdit();
    }

    public function update(CategoriesRequest $request, $category)
    {
        return Category::findOrFail($category)->webUpdate($request);
    }

    public function destroy($category)
    {
        return Category::findOrFail($category)->webDestroy();
    }

    public function mass()
    {
        return Category::mass();
    }
}
