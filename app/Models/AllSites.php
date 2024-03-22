<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllSites extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "sitename",
        "siteslug",
        "seo_title",
        "meta_desc",
        "meta_tags",
        'header_scripts',
        'site_header',
        'site_footer',
        'footer_scripts',
        'site_css',
        'extras',
    ];
}
