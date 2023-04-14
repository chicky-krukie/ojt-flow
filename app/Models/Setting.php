<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    public function paymentStatus()
    {
        return $this->hasMany(PaymentStatus::class, 'settings_id');
    }
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class, 'settings_id');
    }
    public function currency()
    {
        return $this->hasOne(Currency::class, 'settings_id');
    }
    protected $fillable = [
        'multiplier_default',
        'multiplier_cost',
    ];
}
