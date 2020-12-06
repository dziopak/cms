<?php

namespace App\Http\Utilities\Api\v1\Pages;

use App\Http\Utilities\Api\AuthResponse;
use App\Http\Resources\PageResource;
use App\Interfaces\ApiEntity;


class PageEntity implements ApiEntity
{
    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    public function show()
    {
        if (!$this->item) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        return new PageResource($this->item);
    }


    static function store($request)
    {
        $item = $request->all();
        if (!$valid = PageValidation::validate([$item], 'store', 'PAGE_CREATE')) return $valid;
        $page = PageActions::create(PageActions::prepareToStore($item));

        return response()->json([
            "status" => "201",
            "message" => "Successfully created new page.",
            "data" => compact('page')
        ], 201);
    }


    public function update($request)
    {
        if (!$validation = PageValidation::validate([$request->all()], 'update', 'PAGE_EDIT')) return response()->json($validation, 501);
        if (empty($this->item)) return response()->json(["status" => "404", "message" => "Page doesn't exist."], 404);

        $this->item->update(PageActions::prepareToUpdate($request->all()));
        return response()->json(["status" => "201", "message" => "Successfully updated page.", "data" => ['page' => $this->item->fresh()]], 201);
    }


    public function destroy()
    {
        $access = AuthResponse::hasAccessAndRespond('PAGE_EDIT');

        if (!$access === true) return $access;
        if (!$this->item) response()->json(["status" => "404", "message" => "Page doesn't exist."], 404);

        $this->item->delete();
        return response()->json(["status" => "200", "message" => "Page has been successfully deleted.", "data" => ['page' => $this->item]], 200);
    }
}
