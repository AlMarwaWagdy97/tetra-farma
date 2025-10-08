<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = [
        'title', 
        'short_description', 
        'description', 
        'requirements', 
        'seo_title',
         'seo_description'
    ];

    protected $fillable = [
        'slug','employment_type','location','image','status','sort','created_by','updated_by'
    ];

    
}

