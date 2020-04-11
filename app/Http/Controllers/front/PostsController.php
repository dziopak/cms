<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Layout;

class PostsController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->theme['slug'] = config('global.general.theme');
        $this->theme['url'] = 'themes.' . $this->theme['slug'];
        $this->theme['layout'] = Layout::findOrFail(1);
    }

    public function index()
    {
        // return view($thisX->theme['url'] . '.posts.index', ['theme' => $this->theme]);
        return view($this->theme['url'] . '.posts.index', ['layout' => $this->theme['layout']]);
    }
}
