<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PageResource;
use App\Http\Utilities\AuthResponse;
use App\Http\Utilities\PageUtilities;
use App\Page;

class PagesController extends Controller
{

    public function index(Request $request)
    {
        return PageResource::collection(Page::with('author', 'thumbnail', 'category')->orderBy('id')->paginate(15));
    }


    public function store(Request $request)
    {
        $validation = PageUtilities::storeValidation($request);
        if ($validation !== true) return $validation;

        $page = PageUtilities::create($request);
        return response()->json(["status" => "201", "message" => "Successfully created new page.", "data" => compact('page')], 201);
    }


    public function show($id)
    {
        if (is_numeric($id)) {
            $page = Page::with('author', 'category', 'thumbnail')->find($id);
        } else {
            $page = Page::with('author', 'category', 'thumbnail')->where(['slug' => $id])->orWhere(['slug_pl' => $id])->first();
        }

        if (!$page) return response()->json(["status" => "404", "message" => "Page doesn't exist."], 404);
        return new PageResource($page);
    }


    public function update(Request $request, $id)
    {
        $validation = PageUtilities::updateValidation($request);
        if ($validation !== true) return $validation;

        $page = Page::find($id);
        if (!$page) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $data = $request->all();
        $page->update($data);

        return response()->json(["status" => "201", "message" => "Successfully updated new page.", "data" => compact('page')], 201);
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('PAGE_EDIT');
        if ($access !== true) return $access;

        $page = Page::find($id);
        if (!$page) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $page->delete();
        return response()->json(["status" => "200", "message" => "Page has been successfully deleted.", "data" => compact('page')], 200);
    }
}
