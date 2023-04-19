<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'multiplier_default',
        'name',
        'quantity',
        'product_id',
        'price_each',
        'printing',
        'total',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id');
    }
}