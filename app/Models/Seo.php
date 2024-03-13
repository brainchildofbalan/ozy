<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'keywords',
        'author',
        'image',
        'url',
        'canonical_url',
        'type',
        'locale',
        'site_name',
        'twitter_site',
        'twitter_creator',
        'og_type',
        'og_title',
        'og_description',
        'og_image',
        'og_url',
        'og_locale',
        'og_site_name',
    ];
}
