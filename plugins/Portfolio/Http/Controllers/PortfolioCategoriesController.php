<?php

namespace Plugins\Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use plugins\Portfolio\Entities\PortfolioCategory;

class PortfolioCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = PortfolioCategory::paginate(15);
        $table = getModuleData('portfolio_categories_index_table', 'Portfolio');
        return view('portfolio::categories.index', compact('categories', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = getModuleData('portfolio_categories_form', 'Portfolio');
        return view('portfolio::categories.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->except('type');
        PortfolioCategory::create($data);
        return redirect(route('admin.plugins.portfolio.categories.index'))->with('crud', 'Successfully created new category.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('portfolio::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $category = PortfolioCategory::findOrFail($id);
        $form = getModuleData('portfolio_categories_form', 'Portfolio');
        return view('portfolio::categories.edit', compact('category', 'form'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $category = PortfolioCategory::findOrFail($id);
        $category->update($request->all());

        return redirect(route('admin.plugins.portfolio.categories.index'))->with('crud', 'Successfully updated category data.');
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
