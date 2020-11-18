<?php

namespace App\Http\Utilities\Api\Pages;

use App\Http\Resources\PageResource;
use App\Http\Utilities\Api\AuthResponse;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Utilities\ModelUtilities;
use App\Entities\User;
use App\Entities\Page;
use App\Interfaces\ApiEntity;

class PageEntity implements ApiEntity
{

    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }


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


    public function show()
    {
        if (!$this->item) return response()->json(["status" => "404", "message" => "Page doesn't exist."], 404);
        return new PageResource($this->item);
    }


    public function update($request)
    {
        $validation = PageValidation::updateValidation($request);

        if ($validation !== true) return $validation;
        if (!$this->item) return response()->json([
            "status" => "404",
            "message" => "Resource doesn't exist."
        ], 404);

        $data = $request->all();
        $this->item->update($data);

        return response()->json([
            "status" => "201",
            "message" => "Successfully updated new page.",
            "data" => $this->item
        ], 201);
    }


    public function destroy()
    {
        $access = AuthResponse::hasAccess('PAGE_EDIT');

        if ($access !== true) return $access;
        if (!$this->item) return response()->json([
            "status" => "404",
            "message" => "Resource doesn't exist."
        ], 404);

        $this->item->delete();

        return response()->json([
            "status" => "200",
            "message" => "Page has been successfully deleted.",
            "data" => $this->item
        ], 200);
    }
}
