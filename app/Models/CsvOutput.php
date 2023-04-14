<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvOutput extends Model
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

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'uid');
    }
    
}