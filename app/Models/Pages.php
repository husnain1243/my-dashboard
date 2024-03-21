<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pages extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "slug",
        'siteslug',
        "category",
        "status",
        "seo_title",
        "meta_desc",
        "meta_tags",
        "html",
        "css",
        "project_data",
        "header_scripts",
        "footer_scripts",
    ];
}
