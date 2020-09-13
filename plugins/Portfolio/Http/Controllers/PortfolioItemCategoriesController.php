<?php

namespace Plugins\Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use plugins\Portfolio\Entities\PortfolioCategory;
use plugins\Portfolio\Entities\PortfolioItem;

class PortfolioItemCategoriesController extends Controller
{
    public function attach(Request $request, $id)
    {
        if (!empty($category = $request->get('category'))) {
            $category = PortfolioCategory::findOrFail($category);
            PortfolioItem::findOrFail($id)->categories()->sync($category->id, false);
            return response()->json(['message' => 'Successfully attached new category', 'category' => $category], 200);
        }
        return response()->json(['message' => 'Failed to attach new category.', 'status' => '400'], 400);
    }

    public function detach(Request $request, $id)
    {
        if (!empty($category = $request->get('category'))) {
            PortfolioItem::findOrFail($id)->categories()->detach($category, false);
            return response()->json(['message' => 'Successfully detached new category', 'category' => $category], 200);
        }
        return response()->json(['message' => 'Failed to attach new category.', 'status' => '400'], 400);
    }
}
