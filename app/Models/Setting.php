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
    public function tcg()
    {
        return $this->hasMany(TCG::class, 'settings_id');
    }
}
