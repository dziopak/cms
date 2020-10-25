<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\Api\Categories\CategoryEntity;
use App\Http\Utilities\Api\Categories\CategoryEntries;

class PostCategoriesController extends Controller
{

    public function index(Request $request)
    {
        return (new CategoryEntity('post'))->index($request);
    }


    public function posts($id)
    {
        return (new CategoryEntries('post', $id))->index();
    }


    public function store(Request $request)
    {
        return (new CategoryEntity('post'))->store($request);
    }


    public function show($id)
    {
        return (new CategoryEntity('post'))->show($id);
    }


    public function update($id, Request $request)
    {
        return (new CategoryEntity('post'))->update($request, $id);
    }


    public function destroy($id)
    {
        return (new CategoryEntity('post'))->destroy($id);
    }
}
