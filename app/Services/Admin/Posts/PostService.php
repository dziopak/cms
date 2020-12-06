<?php

namespace App\Services\Admin\Posts;

use App\Services\Admin\BaseAdminService;
use App\Traits\ThumbnailService;
use App\Entities\Category;
use App\Interfaces\Repositories\PostRepositoryInterface;

class PostService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'post';
    const ENTITY_PLURAL = 'posts';
    const ROUTE = 'admin.posts';

    use ThumbnailService;

    public function __construct(PostRepositoryInterface $repository)
    {
        parent::__construct($repository);

        $categories = Category::list();
        $posts = $this->repository
            ->with(['thumbnail:id,path', 'author:id,name'])
            ->orderByDesc('id')->filter()->paginate(15);


        $this->queries = [
            'index' => [
                'posts' => $posts,
                'table' => getData('Admin/Modules/Posts/posts_index_table')
            ],

            'create' => [
                'categories' => $categories,
                'form' => getData('Admin/Modules/Posts/posts_form', [
                    'categories' => $categories,
                    'thumbnail' => getThumbnail(null)
                ])
            ],
        ];
    }


    public function edit($id, $params = null)
    {
        $post = $this->repository->with('thumbnail:id,path')->find($id);
        $endpoint = route('admin.posts.update', $id);

        $this->queries['edit'] = [
            'post' => $post,
            'form' => getData('Admin/Modules/Posts/posts_form', [
                'categories' => Category::list(),
                'thumbnail' => getThumbnail($post->thumbnail),
                'thumbnail_endpoint' => $endpoint
            ]),
        ];

        return parent::edit($id);
    }
}
