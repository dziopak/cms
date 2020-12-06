<?php

namespace App\Services\Admin\Pages;

use App\Services\Admin\BaseAdminService;
use App\Traits\ThumbnailService;

use App\Entities\Category;
use App\Entities\Layout;
use App\Interfaces\Repositories\PageRepositoryInterface;

class PageService extends BaseAdminService
{

    const ENTITY_SINGULAR = 'page';
    const ENTITY_PLURAL = 'pages';
    const ROUTE = 'admin.pages';

    use ThumbnailService;

    public function __construct(PageRepositoryInterface $repository)
    {
        parent::__construct($repository);

        $pages = $this->model
            ->with(['thumbnail:id,path', 'author:id,name'])
            ->orderByDesc('id')->filter()->paginate(15);


        $this->queries = [
            'index' => [
                'pages' => $pages,
                'table' => getData('Admin/Modules/Pages/pages_index_table')
            ],

            'create' => [
                'categories' => Category::list(),
                'layouts' => Layout::list()
            ],
        ];
    }

    public function edit($id, $params = null)
    {
        $page = $this->repository->with('thumbnail:id,path')->find($id);

        $this->queries['edit'] = [
            'page' => $page,
            'form' => getData('Admin/Modules/Pages/pages_form', [
                'categories' => Category::list(),
                'layouts' => Layout::list() ?? [0 => 'none'],
                'thumbnail' => getThumbnail($page->thumbnail),
                'thumbnail_endpoint' => route('admin.pages.update', $id)
            ]),
        ];

        return parent::edit($id);
    }
}
