<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'order_id',
        'invoice_number',
        'amount',
        'invoice_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
