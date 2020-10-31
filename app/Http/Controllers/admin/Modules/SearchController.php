<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Helpers\CollectionHelpers;

use App\Entities\Page;
use App\Entities\Post;
use App\Entities\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $table = getData('Admin/Modules/Search/search_index_table');

        $result = (new Search())
            ->registerModel(Page::class, 'name', 'slug', 'content', 'excerpt')
            ->registerModel(Post::class, 'name', 'slug', 'content', 'excerpt')
            ->registerModel(User::class, 'name', 'first_name', 'last_name', 'email')
            ->perform($request->input('query'));

        $count = $result->count();
        $result = CollectionHelpers::paginate($result, 15)->appends(request()->except(['page', '_token']));

        return view('admin.search.index', compact('table', 'result', 'count'));
    }
}
