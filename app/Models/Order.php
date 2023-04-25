<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'sold_date',
        'sold_to',
        'card_name',
        'set',
        'finish',
        'tcg_mid',
        'qty',
        'sold_price',
        'ship_cost',
        'payment_status',
        'payment_method',
        'multiplier_default',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(DataUpload::class, 'product_id');
    }


}
