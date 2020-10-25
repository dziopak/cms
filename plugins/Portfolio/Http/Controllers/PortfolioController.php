<?php

namespace plugins\Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use plugins\Portfolio\Entities\PortfolioItem;
use plugins\Portfolio\Entities\PortfolioItemPicture;
use Plugins\Portfolio\Entities\PortfolioCategory;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $items = PortfolioItem::with('thumbnail', 'photos')->orderByDesc('id')->filter($request)->paginate(15);
        $table = getModuleData('portfolio_index_table', 'Portfolio');

        return view('portfolio::items.index', compact('items', 'table'));
    }


    public function create()
    {
        $form = getModuleData('portfolio_form', 'Portfolio', ['thumbnail' => getThumbnail(null)]);
        return view('portfolio::items.create', compact('form'));
    }


    public function store(Request $request)
    {
        $data = $request->except(['pictures', '_method', '_token', 'thumbnail']);
        $item = PortfolioItem::create($data);

        if (!empty($request->get('pictures'))) PortfolioItemPicture::whereIn('id', $request->get('pictures'))->update(['portfolio_item_id' => $item->id]);
        return redirect(route('admin.plugins.portfolio.edit', $item->id))->with('crud', 'Project "' . $data['name'] . '" has been created successfully.');;
    }


    public function edit($id)
    {
        $item = PortfolioItem::with('thumbnail', 'photos', 'categories', 'content_boxes')->find($id);
        $categories = PortfolioCategory::all('id', 'name')->pluck('name', 'id')->toArray();
        $form = getModuleData('portfolio_form', 'Portfolio', ['thumbnail' => getThumbnail($item->thumbnail), 'thumbnail_endpoint' => route('admin.plugins.portfolio.update', $id)]);
        return view('portfolio::items.edit', compact('item', 'form', 'categories'));
    }


    public function update(Request $request, $id)
    {
        switch ($request->get('request')) {
            case 'photo':
                $file = $request->get('file');
                PortfolioItem::findOrFail($id)->update([
                    'file_id' => $file
                ]);

                if ($file === 0) {
                    $path = 'assets/no-thumbnail.png';
                } else {
                    $path = \App\Models\File::select('path')->findOrFail($file)->path;
                }
                return response()->json(['message' => 'Successfully updated project\'s thumbnail', 'path' => $path], 200);
                break;

            default:
                $data = $request->except(['_method', '_token', 'thumbnail', 'mass_edit', 'new_category', 'content']);
                PortfolioItem::findOrFail($id)->update($data);

                if (!empty($content = $request->get('content'))) {
                    foreach ($content as $box_id => $box) {
                        PortfolioItem::findOrFail($id)->content_boxes()->updateOrCreate(['id' => $box_id], [
                            'portfolio_item_id' => $id,
                            'title' => $box['title'],
                            'content' => $box['content']
                        ]);
                    }
                }

                return redirect(route('admin.plugins.portfolio.index'))->with('crud', 'Project "' . $data['name'] . '" has been updated successfully.');
                break;
        }
    }


    public function destroy($id)
    {
        //
    }

    public function attach(Request $request, $id)
    {

        $data = $request->get('file');
        PortfolioItem::findOrFail($id)->photos()->sync($data, false);
        if (!is_array($request->get('file'))) {
            $data = [0 => $request->get('file')];
        }

        foreach ($data as $photo) {
            $file = \App\Models\File::findOrFail($photo);
            if ($file) {
                $res[] = $file;
            }
        }

        return response()->json(['message' => 'Successfully attached pictures to portfolio\'s project', 'files' => $res]);
    }

    public function detach(Request $request, $id)
    {
        PortfolioItem::findOrFail($id)->photos()->detach($request->get('file'));
        return response()->json(['message' => 'Successfully detached picture to portfolio\'s project']);
    }
}
