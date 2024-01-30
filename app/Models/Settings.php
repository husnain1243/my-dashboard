<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name',
        'title',
        'header_scripts',
        'footer_scripts',
        'nav_html',
        'nav_css',
        'footer_html',
        'extras',
    ];
}
