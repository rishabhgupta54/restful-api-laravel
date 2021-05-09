<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\APIController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductBuyerController extends APIController {
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product) {
        return $this->showAll($product->transactions()->with('buyer')->get()->pluck('buyer')->unique('id')->values());
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) {
        //
    }
}
