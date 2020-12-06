<?php

namespace App\Services\Admin\Layouts;

use App\Services\Admin\BaseAdminService;
use App\Traits\ThumbnailService;
use App\Repositories\LayoutRepository;
use App\Entities\Block;
use App\Interfaces\Repositories\LayoutRepositoryInterface;

class LayoutService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'layout';
    const ENTITY_PLURAL = 'layouts';
    const ROUTE = 'admin.pages.layouts';

    use ThumbnailService;

    public function __construct(LayoutRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function store($request, $params = null)
    {
        $data = $request->except('config', '_token', 'result');
        $this->updateBlocks($this->repository->store($data), $request);

        return $this->redirect('index', 'crud', 'Successfully created new layout');
    }

    public function edit($id, $params = null)
    {
        $item = $this->repository->find($id);
        return view('admin.layouts.edit', [
            'form' => getData('Admin/Modules/Layouts/layouts_form'),
            'layout' => $item->load('blocks')
        ]);
    }


    public function update($request, $id, $params = null)
    {
        $this->updateBlocks($this->repository->find($id), $request);
        $this->getAccess('edit')->repository->find($id)->update([
            'name' => $request->get('name')
        ]);
        return $this->redirect('index', 'crud', 'Successfully updated selected layout');
    }

    public function updateBlocks($layout, $request)
    {
        $json = json_decode($request->get('result'), true);
        $blocks = $request->get('config');

        $layout->blocks()->delete();

        foreach ($json as $block) {
            $config = $blocks[$block['key']];
            $title = $config['title'] ?? "Untitled";
            $container = filter_var($config['container'], FILTER_VALIDATE_BOOLEAN);

            unset($config['title']);
            unset($config['container']);

            Block::updateOrCreate(['id' => $block['id']], [
                'title' => $title,
                'container' => $container,
                'config' => serialize($config ?? []),
                'type' => explode('-block', $block['type'])[0],
                'x' => $block['x'],
                'y' => $block['y'],
                'width' => $block['w'],
                'height' => $block['h'],
                'layout_id' => $layout->id
            ]);
        }
    }

    public function getBlock($request)
    {
        if (empty($request->get('name'))) return response()->json('URL parameter "name" is missing.', 404);

        try {
            $name = camelCase($request->get('name'));
            $name = 'App\View\Components\Admin\Blocks\\' . ucfirst($name);
            $block = (object) [
                'id' => $request->get('name'),
                'x' => 0,
                'y' => 0,
                'auto' => true
            ];
            $widget = new $name($block, true);
            $widget = $widget->render();
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => '404'], 404);
        }

        return response()->json((string) $widget, 200);
    }
}
