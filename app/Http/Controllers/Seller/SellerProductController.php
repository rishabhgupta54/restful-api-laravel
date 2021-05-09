<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\APIController;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends APIController {
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller) {
        return $this->showAll($seller->products);
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
    public function store(Request $request, User $seller) {
        $this->validate($request, [
            'name' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
            'image' => [
                'required',
                'image',
            ],
        ]);

        $data = $request->all();
        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = $request->image->store('');
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);

        return $this->showOne($product, 201);
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
    public function update(Request $request, Seller $seller, Product $product) {
        $this->validate($request, [
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
            'image' => [
                'image',
            ],
            'status' => [
                Rule::in([
                    Product::AVAILABLE_PRODUCT,
                    Product::UNAVAILABLE_PRODUCT,
                ]),
            ],
        ]);

        $this->checkSeller($seller, $product);

        $product->fill($request->only([
            'name',
            'description',
            'quantity',
        ]));

        if ($request->has('status')) {
            $product->status = $request->status;

            if ($product->isAvailable() && $product->categories()->count() == 0) {
                return $this->errorResponse('An active product must have at least 1 category', 422);
            }
        }

        if ($request->hasFile('image')) {
            Storage::delete($product->image);

            $product->image = $request->image->store('');
        }

        if ($product->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $product->save();

        return $this->showOne($product);

    }

    public function checkSeller(Seller $seller, Product $product) {
        if ($seller->id != $product->seller_id) {
            throw new HttpException('422', 'The specified seller is not the actual seller of the product');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller $seller
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Product $product) {
        $this->checkSeller($seller, $product);

        Storage::delete($product->image);
        $product->delete();

        return $this->showOne($product);
    }

}
