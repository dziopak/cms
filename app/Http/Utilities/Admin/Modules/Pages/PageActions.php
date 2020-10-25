<?php

namespace App\Http\Utilities\Admin\Modules\Pages;

use App\Models\Page;
use Auth;

class PageActions
{
    protected $pages;

    public function __construct($pages)
    {
        $this->pages = $pages;
    }

    private function delete()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
        Page::whereIn('id', $this->pages)->delete();

        return __('admin/messages.pages.mass.universal');
    }

    private function setVisibility($visible)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        Page::whereIn('id', $this->pages)->update(['is_active' => $visible]);

        return __('admin/messages.pages.mass.universal');
    }

    private function setCategory($category_id)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        Page::whereIn('id', $this->pages)->update(['category_id' => $category_id]);

        return __('admin/messages.pages.mass.assign_category');
    }

    private function replaceInName($searched, $replace)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        $pages = Page::whereIn('id', $this->pages)->get(['id', 'name']);

        foreach ($pages as $key => $page) {
            if (strpos($page->name, $searched) !== false) {
                $page->name = str_replace($searched, $replace, $page->name);
                $page->save();
            }
        }

        return __('admin/messages.pages.mass.title_replace_phrases');
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
