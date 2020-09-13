<?php

namespace plugins\Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use plugins\Portfolio\Entities\ContentBox;
use plugins\Portfolio\Entities\PortfolioItem;

class PortfolioContentBoxesController extends Controller
{
    public function attach(Request $request, $id)
    {
        PortfolioItem::findOrFail($id);
        $box = ContentBox::create([
            'portfolio_item_id' => $id,
            'content' => ' ',
            'title' => ' ',
        ]);

        return response()->json(['message' => 'Successfully attached new content box', 'id' => $box->id], 200);
    }

    public function detach(Request $request, $id)
    {
        PortfolioItem::findOrFail($id)
            ->content_boxes()
            ->findOrFail($request->get('content'))
            ->delete();

        return response()->json(['message' => 'Successfully detached content box', 'id' => $request->get('content')], 200);
    }
}
