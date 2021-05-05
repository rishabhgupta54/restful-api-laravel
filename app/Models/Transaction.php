<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id',
    ];

    public function buyers() {
        return $this->belongTo(Buyer::class);
    }

    public function product() {
        return $this->belongTo(Product::class);
    }
}
