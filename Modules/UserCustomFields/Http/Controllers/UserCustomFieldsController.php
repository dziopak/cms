<?php

namespace Modules\UserCustomFields\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Modules\UserCustomFields\Entities\UserCustomField;
use Modules\UserCustomFields\Http\Requests\FieldRequest;

class UserCustomFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $fields = UserCustomField::paginate(15);
        return view('usercustomfields::index', compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('usercustomfields::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(FieldRequest $request)
    {
        $data = $request->all();
        UserCustomField::create($data);
        Schema::table('users', function (Blueprint $table) use ($data) {
            $table->text($data['name']);
        });
        return redirect(route('admin.modules.usercustomfields.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('usercustomfields::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $field = UserCustomField::findOrFail($id);
        return view('usercustomfields::edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $field = UserCustomField::findOrFail($id);
        $field->update($request->all());
        return redirect(route('admin.modules.usercustomfields.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
