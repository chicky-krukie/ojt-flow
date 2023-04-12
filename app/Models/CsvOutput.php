<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvOutput extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'quantity',
        'product_id',
        'price_each',
        'printing',
    ];
}