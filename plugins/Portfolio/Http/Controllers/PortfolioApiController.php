<?php

namespace plugins\Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use plugins\Portfolio\Transformers\PortfolioItemListResource as ItemListResource;
use plugins\Portfolio\Transformers\PortfolioItemResource as ItemResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Utilities\ModelUtilities;

use plugins\Portfolio\Entities\PortfolioItem;

class PortfolioApiController extends Controller
{

    public function index(Request $request)
    {
        $items = QueryBuilder::for(PortfolioItem::with('thumbnail', 'categories'))
            ->allowedFilters(['name', AllowedFilter::exact('id')])
            ->allowedSorts(['id', 'name'])
            ->defaultSort('-id');


        return ItemListResource::collection(ModelUtilities::scope($items->with('photos'), $request));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $item = PortfolioItem::with('thumbnail', 'photos', 'content_boxes');
        $item = ModelUtilities::bySlug($id, $item);

        if (empty($item)) return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        return new ItemResource($item);
    }
}
