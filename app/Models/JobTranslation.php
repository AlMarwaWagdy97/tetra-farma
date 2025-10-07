<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['job_id','locale','title','short_description','description','requirements','seo_title','seo_description'];
}

