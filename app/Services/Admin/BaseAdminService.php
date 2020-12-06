<?php

namespace App\Services\Admin;

use App\Exceptions\ModelDestroyException;
use App\Exceptions\NotExistingException;
use Auth;

class BaseAdminService
{

    public $model;
    public $repository;
    public $queries;

    const ENTITY_SINGULAR = 'SINGULAR';
    const ENTITY_PLURAL = 'PLURAL';
    const ROUTE = 'ROUTE';

    public function __construct($repository)
    {
        $this->repository = $repository;
        $this->model = $repository->getModel();
    }


    public function index($request, $params = null)
    {
        // Check access
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');

        // Custom action before
        if (!empty($params['before'])) $params['before']();

        // Default queries
        if (empty($this->queries['index'])) {
            $this->queries['index'] = [
                static::ENTITY_PLURAL => $this->model->orderByDesc('id')->filter($request)->paginate(15)
            ];
        }

        // Custom action after
        if (!empty($params['before'])) $params['before']();

        // Return view
        return $this->getView('index', $this->queries['index']);
    }


    public function create($params = null)
    {
        // Check access
        $this->getAccess('create');

        // Custom action before
        if (!empty($params['before'])) $params['before']();

        // Default queries
        if (empty($this->queries['create'])) $this->queries['create'] = [];

        // Custom action after
        if (!empty($params['after'])) $params['after']();

        // Return view
        return $this->getView('create', $this->queries['create']);
    }


    public function store($request, $params = null)
    {
        // Check access
        $this->getAccess('create');

        // Custom action before
        if (!empty($params['before'])) $params['before']();

        // Create new record
        $item = $this->repository->create($request->all());

        // Custom action after
        if (!empty($params['after'])) $params['after']($item);

        // Return view
        return $this->redirect('index');
    }


    public function edit($id, $params = null)
    {
        // Check access
        $this->getAccess('edit');

        // Custom action before
        if (!empty($params['before'])) $params['before']();

        // Default query
        if (empty($this->queries['edit'])) {
            $this->queries['edit'] = [
                static::ENTITY_SINGULAR => $this->repository->find($id)
            ];
        }

        // Custom action after
        if (!empty($params['after'])) $params['after']();

        // Return view
        return $this->getView('edit', $this->queries['edit']);
    }


    public function update($request, $id, $params = null)
    {
        // Check access
        $this->getAccess('edit');

        // Custom action before
        if (!empty($params['before'])) $params['before']();

        // Update
        $this->repository->find($id)->update($request->all());

        // Custom action after
        if (!empty($params['after'])) $params['after']();

        // Redirect back
        return $this->redirect('index');
    }


    public function destroy($id, $params = null)
    {
        // Check access
        $this->getAccess('delete');

        // Custom action before
        if (!empty($params['before'])) $params['before']();

        // Find item or throw exception
        $item = $this->repository->find($id);
        if (!$item) throw new NotExistingException();

        // Delete item or throw exception
        $delete = $item->delete();
        if (!$delete) throw new ModelDestroyException('Database failure.', 500);

        // Return JSON response
        return response()->json([
            'message' => __('admin/messages.' . static::ENTITY_PLURAL . '.delete.success'),
            'id' => $id
        ], 200);
    }


    protected function getView($view, $params = null)
    {
        return view('admin.' . static::ENTITY_PLURAL . '.' . $view, $params);
    }

    protected function redirect($route, $with = null, $message = null)
    {
        // Set redirect route
        $redirect = redirect(route(static::ROUTE . '.' . $route));

        // Set session flash message
        if (!empty($with) && !empty($message)) $redirect = $redirect->with($with, $message);

        // Return redirect
        return $redirect;
    }

    protected function getAccess($method)
    {
        $access = strtoupper(static::ENTITY_SINGULAR . '_' . $method);
        Auth::user()->hasAccessOrRedirect($access);

        return $this;
    }
}
