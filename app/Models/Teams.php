<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teams extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'featured_img',
        'featured_img_alt',
        'meta_desc',
        'summernote',
        'header_scripts',
        'footer_scripts',
        'additional_tags',
        'category',
        'author',
        'extras',
    ];

}
