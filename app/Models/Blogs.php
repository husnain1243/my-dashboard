<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blogs extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status',
        'title',
        'slug',
        'featured_img',
        'featured_img_alt',
        'meta_desc',
        'meta_tags',
        'summernote',
        'header_scripts',
        'footer_scripts',
        'additional_tags',
        'views',
        'comments_status',
        'featured',
        'is_category_feature',
        'cat_main',
        'category',
        'author',
        'extras',
    ];
}
