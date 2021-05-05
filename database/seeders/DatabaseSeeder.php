<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     * @return void
     */
    public function run() {

        User::truncate();
        Buyer::truncate();
        Seller::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();
        User::factory(200)->create();
        Category::factory(30)->create();
        Product::factory(1000)->create()->each(function($product) {
            $product->categories()->sync(Category::all()->random(rand(1, 5))->pluck('id'));
        });
        Transaction::factory(10000)->create();
    }
}
