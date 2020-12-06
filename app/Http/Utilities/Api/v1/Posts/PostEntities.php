<?php

namespace App\Http\Utilities\Api\v1\Posts;

use App\Http\Resources\PostResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Utilities\ModelUtilities;
use App\Entities\Post;
use App\Http\Utilities\Api\AuthResponse;
use App\Interfaces\ApiEntities;

class PostEntities implements ApiEntities
{

    private $items;
    private $result;
    private $steps;

    public function __construct($items = null)
    {
        if (!empty($items)) $this->items = $items;
    }


    static function index($request)
    {
        $filters = ['created_at', 'updated_at', 'name', 'slug', AllowedFilter::exact('id')];
        $sorting = ['id', 'created_at', 'updated_at'];

        $posts = QueryBuilder::for(Post::with('author', 'thumbnail', 'categories'))
            ->allowedFilters($filters)
            ->allowedSorts($sorting)
            ->defaultSort('-created_at');

        return PostResource::collection(ModelUtilities::scope($posts, $request));
    }


    static function store($request)
    {
        $entity = new self;
        $items = itemsToStore($request);

        $valid = PostValidation::validate($items, 'store', 'POST_CREATE');
        if ($valid !== true) return $entity->log('create', $valid['message'], 501, $valid['validation']);

        $entity->items = PostActions::create($items);
        if (empty($entity->items)) return $entity->log('create', 'Unknown error occured during creating the post', 501);

        return $entity->log('create', 'Posts have been successfully created.', 200, $entity->items);
    }


    public function update($request)
    {
        $access = AuthResponse::hasAccess('POST_EDIT', true);
        if ($access !== true) return $this->log('update', $access, 403);

        Post::flushQueryCache();
        $items = $this->items->dontCache()->get();

        // Mass Update whole collection
        if (!empty($request->get('mass'))) {
            $update = PostActions::massUpdate($request->get('mass'), $this->items);
            if ($update !== true) return $this->log('update', $update, 501);
        }

        // Update each item individually
        if (!empty($request->get('bulk'))) {
            $update = PostActions::bulkUpdate($request->get('bulk'), $this->items);
            if ($update !== true) return $this->log('update', $update, 501);
        }

        return $this->log('update', 'Posts have been successfully updated.', 200, $items->fresh());
    }


    public function destroy()
    {
        $access = AuthResponse::hasAccess('POST_DELETE', true);
        if ($access !== true) return $this->log('delete', $access, 403);

        $items = $this->items->dontCache()->get(['id', 'slug', 'name']);
        if (!count($items)) return $this->log('delete', 'No records found', 404);
        $delete = $this->items->delete();

        if (!$delete) return $this->log('delete', 'Failed to delete selected posts', 501);
        return $this->log('delete', 'Posts have been successfully deleted.', 200, $items);
    }


    private function log($action, $message, $status = 200, $data = [])
    {
        $this->steps[$action] = ['message' => $message, 'status' => $status];

        $success = ($status >= 200 && $status < 300);

        $this->result =  response()->json([
            'message' => $success ? 'Successfully performed selected tasks.' : "There were errors during performing selected tasks",
            'status' => $status,
            'actions' => $this->steps,
            'data' => $data
        ], $status);

        return $this;
    }


    public function respond()
    {
        return $this->result;
    }
}
