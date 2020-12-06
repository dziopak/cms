<?php

namespace App\Http\Utilities\Api\v1\Categories;

use App\Http\Resources\CategoryResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Utilities\ModelUtilities;
use App\Entities\Category;
use App\Http\Utilities\Api\ApiResponse;
use App\Http\Utilities\Api\AuthResponse;
use App\Interfaces\ApiEntities;

class CategoryEntities extends ApiResponse implements ApiEntities
{


    public function __construct($items = null)
    {
        if (!empty($items)) $this->items = $items;
    }


    static function index($request)
    {
        $filters = ['name', 'slug', AllowedFilter::exact('id')];
        $sorting = ['id'];

        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters($filters)
            ->allowedSorts($sorting)
            ->defaultSort('-id');

        return CategoryResource::collection(ModelUtilities::scope($categories, $request));
    }


    static function store($request)
    {
        AuthResponse::checkAccess('CATEGORY_CREATE');
        CategoryValidation::validate($items = itemsToStore($request), 'store');

        $entity = new self;
        $entity->items = CategoryActions::create($items);

        return exists($entity->items) ? $entity->log('create', 'Categories have been successfully created.', 200, $entity->items) : false;
    }


    public function update($request)
    {
        AuthResponse::checkAccess('CATEGORY_EDIT');

        Category::flushQueryCache();
        $items = $this->items->dontCache()->get();

        // Mass Update whole collection
        if (!empty($request->get('mass'))) {
            $update = CategoryActions::massUpdate($request->get('mass'), $this->items);
            if ($update !== true) return $this->log('update', $update, 501);
        }

        // Update each item individually
        if (!empty($request->get('bulk'))) {
            $update = CategoryActions::bulkUpdate($request->get('bulk'), $this->items);
            if ($update !== true) return $this->log('update', $update, 501);
        }

        $this->items = $this->items->fresh();

        return $this->log('update', 'Categories have been successfully updated.', 200, $items->fresh());
    }


    public function destroy()
    {
        AuthResponse::checkAccess('CATEGORY_DELETE');

        $items = $this->items->dontCache()->get(['id', 'slug', 'name']);
        if (exists($items)) $delete = $this->items->delete();

        if (!$delete) return $this->log('delete', 'Failed to delete selected categories', 501);
        return $this->log('delete', 'Categories have been successfully deleted.', 200, $items);
    }
}
