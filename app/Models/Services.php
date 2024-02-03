<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'category_id', 'updated_by', 'order', 'relative_products', 'url', 'service_id', 'thumb_description', 'is_home',
    ];
}
