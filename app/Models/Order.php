<?php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'countryCode',
        'email',
        'firstName',
        'lastName',
        'phone',
        'postalCode',
        'time',
        'zone',
        'products',
        'status',
        'description',
        'notes',
        'other'
    ];

    // You can add any relationships or additional methods here
}
