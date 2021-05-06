<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\APIController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerSellerController extends APIController {
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer) {
        return $this->showAll($buyer->transactions()->with('product.seller')->get()->pluck('product.seller')->unique('id')->values());
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
     * @param  \App\Models\Buyer $buyer
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buyer $buyer
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $buyer) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Buyer $buyer
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyer $buyer) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyer $buyer
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer) {
        //
    }
}
