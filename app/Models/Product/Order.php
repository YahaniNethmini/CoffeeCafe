<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'state',
        'address',
        'city',
        'zip_code',
        'phone',
        'email',
        'price',
        'status',
    ];

    public $timestamps = true;
}
