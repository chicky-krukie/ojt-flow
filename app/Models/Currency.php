<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'tcg_low',
        'tcg_mid',
        'tcg_high',
        'sold_price',
        'estimated_card_cost',
        'ship_cost',
        'ship_price',
    ];
}
