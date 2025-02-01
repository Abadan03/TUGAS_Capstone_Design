<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'order_id',
        'user_id',
        'nama_produk',
        'quantity',
        'amount',
        'status',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(Users::class);
    // }
    
}
