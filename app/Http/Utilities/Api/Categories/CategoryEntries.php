<?php

namespace App\Http\Utilities\Api\Categories;

use App\Http\Resources\CategoryCollection;
use App\Models\Page;
use App\Models\Post;

class CategoryEntries
{
    protected $model;
    private $category;
    private $category_id;

    public function __construct($type, $id = null)
    {
        switch ($type) {
            case 'post':
                $this->model = Post::class;
                break;

            case 'page':
                $this->model = Page::class;
                break;
        }

        if (!empty($id)) {
            $this->category_id = $id;
            $this->category = $this->model::find($id);
        }
    }

    public function index()
    {
        return [
            'data' => CategoryCollection::collection($this->category),
            'status' => '200'
        ];
    }
}
