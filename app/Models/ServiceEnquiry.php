<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceEnquiry extends Model
{
    protected $fillable = [
        'name',
        'follow_up',
        'service',
        'category',
        'number',
        'email',
        'address',
        'other',
    ];
}
