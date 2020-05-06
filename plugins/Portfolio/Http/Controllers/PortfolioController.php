<?php

namespace plugins\Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use plugins\Portfolio\Entities\PortfolioItem;
use plugins\Portfolio\Entities\PortfolioItemPicture;
use Illuminate\Support\Facades\Session;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $items = PortfolioItem::with('thumbnail', 'photos')->filter($request)->paginate(15);
        $table = getModuleData('portfolio_index_table', 'Portfolio');

        return view('portfolio::index', compact('items', 'table'));
    }


    public function create()
    {
        $form = getModuleData('portfolio_form', 'Portfolio');
        return view('portfolio::create', compact('form'));
    }


    public function store(Request $request)
    {
        $data = $request->except(['pictures', '_method', '_token', 'thumbnail']);
        $item = PortfolioItem::create($data);

        if (!empty($request->get('pictures'))) {
            PortfolioItemPicture::whereIn('id', $request->get('pictures'))->update(['portfolio_item_id' => $item->id]);
        }

        Session::flash('crud', 'Project "' . $data['name'] . '" has been created successfully.');
        return redirect(route('admin.plugins.portfolio.index'));
    }


    public function show($id)
    {
        return view('portfolio::show');
    }


    public function edit($id)
    {
        $item = PortfolioItem::with('thumbnail', 'photos')->find($id);
        $form = getModuleData('portfolio_form', 'Portfolio');
        return view('portfolio::edit', compact('item', 'form'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->except(['pictures', '_method', '_token', 'thumbnail']);
        PortfolioItem::findOrFail($id)->update($data);

        if (!empty($request->get('pictures'))) {
            PortfolioItemPicture::whereIn('id', $request->get('pictures'))->update(['portfolio_item_id' => $id]);
        }

        Session::flash('crud', 'Project "' . $data['name'] . '" has been updated successfully.');
        return redirect(route('admin.plugins.portfolio.index'));
    }


    public function destroy($id)
    {
        //
    }

    public function fileupload(Request $request)
    {

        if ($request->hasFile('file')) {
            $destinationPath = 'images/';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $extension = $request->file('file')->getClientOriginalExtension();
            $validextensions = array("jpeg", "jpg", "png", "pdf");

            if (in_array(strtolower($extension), $validextensions)) {
                $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
                // if (file_exists($destinationPath.$fileName)) {
                //     $fileName = time().'_'.rand(11111, 99999).'_'.$request->file('file')->getClientOriginalName();
                // }
                $request->file('file')->move($destinationPath, $fileName);
                $picture = PortfolioItemPicture::create(['path' => $destinationPath . $fileName]);

                return response()->json($picture->id, 200);
            } else {
                return response()->json("Incorrect format", 500);
            }
        }
    }
}
