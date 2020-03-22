<?php

namespace App\Http\Controllers\api\datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\User;
use DataTables;

class UsersDatatableController extends Controller
{
    public function __invoke(Request $request) {
        $collection = UserResource::collection(User::with('role', 'photo')->get());
        return datatables($collection)->toJson();
    }
}
