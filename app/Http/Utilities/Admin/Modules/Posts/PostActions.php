<?php

namespace App\Http\Utilities\Admin\Modules\Posts;

use App\Entities\Post;
use Auth;

class PostActions
{
    protected $posts;

    public function __construct($posts)
    {
        is_array($posts) ? $this->posts = $posts : $this->posts = [$posts];
    }


    private function delete()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
        Post::whereIn('id', $this->posts)->delete();

        return __('admin/messages.posts.mass.universal');
    }


    private function setVisibility($visible)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        Post::whereIn('id', $this->posts)->update(['is_active' => $visible]);

        return __('admin/messages.posts.mass.universal');
    }


    private function setCategory($category_id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        Post::whereIn('id', $this->posts)->update(['category_id' => $category_id]);

        return __('admin/messages.posts.mass.assign_category');
    }


    private function replaceInName($searched, $replace)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        $posts = Post::whereIn('id', $this->posts)->get(['id', 'name']);

        foreach ($posts as $key => $post) {
            if (strpos($post->name, $searched) !== false) {
                $post->name = str_replace($searched, $replace, $post->name);
                $post->save();
            }
        }

        return __('admin/messages.posts.mass.title_replace_phrases');
    }


    public function mass($data)
    {
        switch ($data['mass_action']) {
            case 'delete':
                return $this->delete();
                break;

            case 'hide':
                return $this->setVisibility(false);
                break;

            case 'show':
                return $this->setVisibility(true);
                break;

            case 'category':
                return $this->setCategory($data['category_id']);
                break;

            case 'name_replace':
                return $this->replaceInName($data['name_search_string'], $data['name_replace_string']);
                break;
        }
    }
}
