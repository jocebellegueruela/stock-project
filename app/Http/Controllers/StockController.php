<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\StockCategory;
use App\Models\Uom;
use App\Models\Stock;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Stocks/Create', [
            'categories'=>StockCategory::get(),
            'uoms'=>Uom::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate(

            [
                'stock_category_id' => 'exists:stock_categories,id',
                'description' => 'required',
                'uom' => 'exists:uoms,id',
                'barcode' => 'string',
                'discontinued' => 'required|boolean',
            ]

        );

        Stock::create(array_merge($validatedData, [
            'id' => uniqid(),
            'discontinued' => request()->boolean('discontinued') ? 'Y' : 'N'],
        ));

        return redirect()->back()->with('success', 'New Stock Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
