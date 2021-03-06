<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\APIController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerBuyerController extends APIController {
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller) {
        return $this->showAll($seller->products()->whereHas('transactions')->with('transactions.buyer')->get()->pluck('transactions')->collapse()->pluck('buyer')->unique('id')->values());
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
     * @param  \App\Models\Seller $seller
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller $seller
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Seller $seller
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller $seller
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller) {
        //
    }
}
