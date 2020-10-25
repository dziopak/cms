<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\Api\Categories\CategoryEntity;
use App\Http\Utilities\Api\Categories\CategoryEntries;

class PageCategoriesController extends Controller
{

    public function index(Request $request)
    {
        return (new CategoryEntity('page'))->index($request);
    }


    public function pages($id)
    {
        return (new CategoryEntries('page', $id))->index();
    }


    public function store(Request $request)
    {
        return (new CategoryEntity('page'))->store($request);
    }


    public function show($id)
    {
        return (new CategoryEntity('page'))->show($id);
    }


    public function update($id, Request $request)
    {
        return (new CategoryEntity('page'))->update($request, $id);
    }


    public function destroy($id)
    {
        return (new CategoryEntity('page'))->destroy($id);
    }
}
