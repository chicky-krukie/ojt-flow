<?php

namespace App\Imports;

use App\Models\Counter;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CounterImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Counter([
            'quantity' => $row['quantity'],
            'product_id' => $row['product_id'],
            'price_each' => $row['price_each'],
            'printing' => $row['printing'],
        ]);
    }
}