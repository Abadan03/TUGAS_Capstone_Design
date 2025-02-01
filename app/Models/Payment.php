<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class Payment extends Model
{
    //
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        "order_id",
        "status",
        "price",
        "item_name",
        "customer_name",
        "payment_proof",
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
