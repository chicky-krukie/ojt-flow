<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
    }
    public function paymentMethods()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    protected $fillable = [
        'multiplier_default',
        'multiplier_cost',
        'tcg_low',
        'tcg_mid',
        'tcg_high',
        'sold_price',
        'ship_cost',
        'ship_price',
        'estimated_card_cost'
    ];
}
