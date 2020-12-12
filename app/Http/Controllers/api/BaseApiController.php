<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{

    protected $service;


    public function index(Request $request)
    {
        return $this->service->index($request->all());
    }


    public function show($id)
    {
        return $this->service->show($id);
    }


    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }


    public function update(Request $request, $id = null)
    {
        return $this->service->update($request->all(), $id);
    }


    public function destroy(Request $request, $id = null)
    {
        return $this->service->destroy($request->all(), $id);
    }
}
