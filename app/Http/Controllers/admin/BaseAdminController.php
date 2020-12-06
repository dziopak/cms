<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseFormRequest;
use Illuminate\Http\Request;


class BaseAdminController extends Controller
{

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store(BaseFormRequest $request)
    {
        $request = $this->validation($request, 'store');
        return $this->service->store($request);
    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function update(BaseFormRequest $request, $id)
    {
        $request = $this->validation($request, 'update');
        return $this->service->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    public function mass(Request $request)
    {
        if (!empty($this->massAction)) return $this->massAction::build($request);
        return abort(404);
    }

    private function validation($request, $method)
    {
        if (!empty($this->requests) && !empty($this->requests[$method])) {
            return $request->convertRequest($this->requests[$method]);
        } else {
            return $request;
        }
    }
}
