<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Role;


class RolesController extends Controller
{

    public function index(Request $request)
    {
        return Role::apiIndex($request);
    }

    public function show($id)
    {
        return Role::findOrFail($id)->apiShow();
    }

    public function store(Request $request)
    {
        return Role::apiStore($request);
    }

    public function update(Request $request, $id)
    {
        return Role::findOrFail($id)->apiUpdate($request);
    }

    public function destroy($id)
    {
        return Role::findOrFail($id)->destroy();
    }
}
