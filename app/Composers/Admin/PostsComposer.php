<?php

namespace App\Composers\Admin;

class PostsComposer
{

    private function index($request, $view)
    {
        return [
            'posts' => \App\Post::with('author', 'thumbnail')->orderByDesc('id')->filter($request)->paginate(15),
            'categories' => array_merge([0 => __('admin/general.no_category')], \App\PostCategory::all('id', 'name')->pluck('name', 'id')->toArray()),
            'table' => getData('Admin/Modules/posts/posts_index_table')
        ];
    }

    private function create($request, $view)
    {
        $categories = array_merge(['No category'], \App\PostCategory::list_all());
        return [
            'categories' => $categories,
            'form' => getData('Admin/Modules/posts/posts_form', ['categories' => $categories, 'thumbnail' => getThumbnail(null)])
        ];
    }

    private function edit($request, $view)
    {
        $categories = array_merge(['No category'], \App\PostCategory::list_all());
        return [
            'post' => \App\Post::with('thumbnail')->findOrFail($view->post_id),
            'form' => getData('Admin/Modules/posts/posts_form', ['categories' => $categories, 'thumbnail' => getThumbnail($view->post->thumbnail), 'thumb_endpoint' => route('admin.posts.update', $view->post_id)])
        ];
    }

    public function compose($view)
    {
        $request = request();
        $vw = explode('.', $view->getName())[2];

        switch ($vw) {
            case 'index':
                $data = $this->index($request, $view);
                break;

            case 'edit':
                $data = $this->edit($request, $view);
                break;

            case 'create':
                $data = $this->create($request, $view);
                break;
        }

        if (isset($data) && !empty($data)) {
            foreach ($data as $key => $row) {
                $view->with($key, $row);
            }
        }
    }
}
