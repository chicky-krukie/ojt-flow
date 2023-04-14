<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_methods',
        'payment_status',
        'multiplier_default',
        'multiplier_cost',
        'tcg_status',
        'sold_price',
        'estimated_card_cost',
        'shipment_cost',
        'shipment_price',
    ];
}
