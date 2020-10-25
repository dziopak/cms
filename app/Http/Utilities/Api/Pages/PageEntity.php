<?php

namespace App\Http\Utilities\Api\Pages;

use App\Http\Resources\PageResource;
use App\Http\Utilities\Api\AuthResponse;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Utilities\ModelUtilities;
use App\Models\User;
use App\Models\Page;

class PageEntity
{


    static function index($request)
    {
        $filters = ['created_at', 'updated_at', 'name', 'slug', AllowedFilter::exact('id')];
        $sorting = ['id', 'created_at', 'updated_at'];

        $pages = QueryBuilder::for(Page::with('author', 'thumbnail', 'category'))
            ->allowedFilters($filters)
            ->allowedSorts($sorting)
            ->defaultSort('-created_at');

        return PageResource::collection(ModelUtilities::scope($pages, $request));
    }


    static function store($request)
    {
        $validation = PageValidation::storeValidation($request);
        if ($validation !== true) return $validation;

        $page = PageEntity::create($request);
        return response()->json(["status" => "201", "message" => "Successfully created new page.", "data" => compact('page')], 201);
    }


    static function create($request)
    {
        $user = User::jwtUser();
        $user = User::find($user->id);

        $data = $request->all();
        $data['user_id'] = $user->id;

        return Page::create($data);
    }


    static function show($id)
    {
        if (is_numeric($id)) {
            $page = Page::with('author', 'category', 'thumbnail')->find($id);
        } else {
            $page = Page::with('author', 'category', 'thumbnail')->where(['slug' => $id])->orWhere(['slug_pl' => $id])->first();
        }

        if (!$page) return response()->json(["status" => "404", "message" => "Page doesn't exist."], 404);
        return new PageResource($page);
    }


    static function update($request, $id)
    {
        $validation = PageValidation::updateValidation($request);
        if ($validation !== true) return $validation;

        $page = Page::find($id);
        if (!$page) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $data = $request->all();
        $page->update($data);

        return response()->json(["status" => "201", "message" => "Successfully updated new page.", "data" => compact('page')], 201);
    }


    static function destroy($id)
    {
        $access = AuthResponse::hasAccess('PAGE_EDIT');
        if ($access !== true) return $access;

        $page = Page::find($id);
        if (!$page) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);

        $page->delete();
        return response()->json(["status" => "200", "message" => "Page has been successfully deleted.", "data" => compact('page')], 200);
    }


    // public function store($request)
    // {
    //     $data = $request->all();
    //     $data['user_id'] = Auth::user()->id;

    //     Page::create($data);
    //     return redirect(route('admin.pages.index'));
    // }
}
