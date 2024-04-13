<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'name',
        'description',
        'specifications',
        'category_id',
        'sub_category_id',
        'price',
        'quantity_in_stock',
        'images',
        'related_products',
        'is_featured',
        'is_valuable',
        'product_code',
        'category_id',
        'sub_category_id',
        'url',
        'star_rating',
        'sold_out_items'
    ];

    protected $casts = [
        'images' => 'array',
        'related_products' => 'json',
        'is_featured' => 'boolean',
        'is_valuable' => 'boolean',
    ];
}
