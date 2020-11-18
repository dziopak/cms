<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Modules\Categories\CategoriesRequest;

use App\Entities\PostCategory;
use Auth;

class PostCategoriesController extends Controller
{

    public function index(Request $request)
    {
        return PostCategory::webIndex($request);
    }

    public function create()
    {
        return PostCategory::webCreate();
    }

    public function store(CategoriesRequest $request)
    {
        return PostCategory::webStore($request);
    }

    public function edit($category)
    {
        return PostCategory::findOrFail($category)->webEdit();
    }

    public function update(CategoriesRequest $request, $category)
    {
        return PostCategory::findOrFail($category)->webUpdate($request);
    }

    public function destroy($category)
    {
        return PostCategory::findOrFail($category)->webDestroy();
    }

    public function mass(Request $request)
    {
        return PostCategory::mass($request);
    }
}
