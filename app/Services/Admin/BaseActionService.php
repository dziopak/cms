<?php

namespace App\Services\Admin;

class BaseActionService
{
    protected $items, $request;
    public $repository, $result;
    public $events;


    public function __construct($data)
    {
        $this->request = $data;
        $this->items = $this->getData($data);
        $this->action = $data['mass_action'];
    }


    protected function getData($data)
    {
        $ids = $data['mass_edit'];
        return $this->repository->findMany($ids);
    }


    public function delete()
    {
        $delete = $this->items->delete();
        if (!$delete) $this->result = redirect()->back()->with('error', 'Something went wrong... Please, try again.');
        $this->result = redirect()->back()->with('crud', __('admin/messages.categories.mass.universal'));

        return $this;
    }


    public function category()
    {
        $update = $this->items->update(['category_id' => $this->request->get('category_id')]);
        if (!$update) $this->result = redirect()->back()->with('error', 'Something went wrong... Please, try again.');
        $this->result = redirect()->back()->with('crud', __('admin/messages.categories.mass.universal'));

        return $this;
    }


    public function name_replace()
    {
        $searched = $this->request['name_search_string'] ?? null;
        $replace = $this->request['name_replace_string'] ?? null;
        $items = $this->items->get(['id', 'name']);

        if (empty($searched || empty($replace))) {
            $this->result = redirect()->back()->with('crud', __('admin/messages.categories.universal'));
        }

        foreach ($items as $item) {
            if (strpos($item->name, $searched) !== false) {
                $item->name = str_replace($searched, $replace, $item->name);
                $item->save();
            }
        }

        $this->result = redirect()->back()->with('crud', __('admin/messages.categories.universal'));
        return $this;
    }


    public function respond()
    {
        $event = $this->events[$this->action] ?? null;
        $model = $this->repository->getModel() ?? null;

        if (!empty($event)) dispatchEvent($event, $this->items);
        if (!empty($model)) $model::flushQueryCache();

        return $this->result;
    }


    static function build($data)
    {
        $class = new static($data);
        $action = $data['mass_action'];
        return $class->$action()->respond();
    }
}
