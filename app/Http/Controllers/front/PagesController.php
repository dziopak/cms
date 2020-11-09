<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Entities\Page;

class PagesController extends Controller
{
    public function show($id)
    {
        $page = Page::findBySlugOrFail($id);
        return view('Theme::modules.pages.show', [
            'page' => $page,
            'blocks' => $page->layout->getLayout()
        ]);
    }
}
