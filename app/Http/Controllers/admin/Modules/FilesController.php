<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;
use App\Http\Utilities\FileUtilities;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.media.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id === "0" ?
            $path = 'assets/no-thumbnail.png' :
            $path = \App\File::findOrFail($id)->path;

        return response()->json(['path' => $path]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = File::findOrFail($id);
        return view('admin.media.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = File::findOrFail($id);
        $file->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        return redirect(route('admin.media.index'));
    }

    /**
     * Show confirmation view before deleting resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $file = \App\File::findOrFail($id);
        return view('admin.media.delete', compact('file'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\File::findOrFail($id)->delete();
        return response()->json(['message' => __('admin/messages.files.delete.success'), 'id' => $id], 200);
        // return redirect(route('admin.media.index'));
    }

    public function upload(Request $request)
    {
        return FileUtilities::upload($request);
    }

    public function mass(Request $request)
    {
        $data = $request->all();

        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', __('admin/messages.files.mass.errors.no_files'));
        } else {
            switch ($data['mass_action']) {
                case 'delete':
                    \App\File::whereIn('id', $data['mass_edit'])->delete();
                    return redirect()->back()->with('crud', __('admin/messages.files.mass.delete'));
                    break;

                default:
                    return redirect()->back();
                    break;
            }
        }
        return redirect()->back();
    }
}
