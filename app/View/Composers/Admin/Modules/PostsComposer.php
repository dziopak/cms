<?php

namespace App\View\Composers\Admin\Modules;

use App\Entities\Post;
use App\Entities\PostCategory;

class PostsComposer
{

    private function index($request, $view)
    {
        return [
            'posts' => Post::with('author', 'thumbnail')->orderByDesc('id')->filter($request)->paginate(15),
            'categories' => array_merge([0 => __('admin/general.no_category')], PostCategory::all('id', 'name')->pluck('name', 'id')->toArray()),
            'table' => getData('Admin/Modules/Posts/posts_index_table')
        ];
    }

    private function create($request, $view)
    {
        $categories = array_merge(['No category'], PostCategory::list_all());
        return [
            'categories' => $categories,
            'form' => getData('Admin/Modules/Posts/posts_form', ['categories' => $categories, 'thumbnail' => getThumbnail(null)])
        ];
    }

    private function edit($request, $view)
    {
        $categories = array_merge(['No category'], PostCategory::list_all());
        return [
            'form' => getData('Admin/Modules/Posts/posts_form', ['categories' => $categories, 'thumbnail' => getThumbnail($view->post->thumbnail), 'thumb_endpoint' => route('admin.posts.update', $view->post->id)])
        ];
    }

    public function compose($view)
    {
        $request = request();
        $vw = explode('.', $view->getName())[2];

        // Boot proper method
        $data = $this->$vw($request, $view);

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
