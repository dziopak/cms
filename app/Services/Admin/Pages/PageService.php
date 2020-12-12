<?php

namespace App\Services\Admin\Pages;

use App\Interfaces\Repositories\PageRepositoryInterface;
use App\Services\Admin\BaseAdminService;
use App\Traits\CategorizableService;
use App\Traits\ThumbnailService;
use App\Entities\Category;

class PageService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'page';
    const ENTITY_PLURAL = 'pages';
    const ROUTE = 'admin.pages';

    use ThumbnailService;
    use CategorizableService;

    public function __construct(PageRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }


    public function index($request, $params = null)
    {
        // Get neccessary data
        $query = [
            'table' => getData('Admin/Modules/Pages/pages_index_table'),
            'pages' => $this->repository->index()
        ];

        // Return parent method with custom query
        return parent::index($request, [
            'before' => function () use ($query) {
                $this->queries['index'] = $query;
            }
        ]);
    }


    public function create($params = null)
    {
        // Prepare query
        $query = [
            'form' => getData('Admin/Modules/Pages/pages_form', [
                'categories' => Category::list(),
                'thumbnail' => getThumbnail(null)
            ])
        ];

        // Return parent method with prepared query
        return parent::create([
            'before' => function () use ($query) {
                $this->queries['create'] = $query;
            }
        ]);
    }


    public function store($request, $params = null)
    {
        // Return parent method and synchronize categories
        return parent::update($request, [
            'after' => function ($id) use ($request) {
                $this->synchronizeCategories($request, $id);
            }
        ]);
    }


    public function edit($id, $params = null)
    {
        // Fetch data
        $page = $this->repository->with('thumbnail:id,path')->find($id);
        $endpoint = route('admin.pages.update', $id);

        // Prepare query
        $before = function () use ($id, $page, $endpoint) {
            $this->queries['edit'] = [
                'page' => $page,
                'form' => getData('Admin/Modules/Pages/pages_form', [
                    'categories' => Category::list(),
                    'thumbnail' => getThumbnail($page->thumbnail),
                    'thumbnail_endpoint' => $endpoint
                ]),
            ];
        };

        // Call parent method with custom query
        return parent::edit($id, [
            'before' => $before
        ]);
    }


    public function update($request, $id, $params = null)
    {
        // Call parent method and synchronize categories
        return parent::update($request, $id, [
            'after' => $this->synchronizeCategories($request, $id)
        ]);
    }
}
