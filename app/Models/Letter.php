<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class letter extends Model
{
    //
    use HasFactory;

    protected $table = 'proofletter';
    protected $fillable = [
        'orders_id',
        'ormawa',
        'event',
        'letter',
    ];

}
