<?php
// app/Models/Blog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Blog extends Model
{
    use Translatable;

    public $translatedAttributes = ['title','description'];
    protected $fillable = ['image'];

    public function translations()
    {
        return $this->hasMany(BlogTranslation::class);
    }

    public function getTransNowAttribute()
    {
        return $this->translations()->where('locale', app()->getLocale())->first();
    }

        public static function staticPath(): string
    {
        return 'attachments/blogs/';
    }

    /**
     */
    public static function diskPath(): string
    {
        return public_path(self::staticPath());
    }

    /**
     */
    public function pathInView(): string
    {
        if ($this->image && file_exists(self::diskPath() . $this->image)) {
            return self::staticPath() . $this->image;
        }
        return 'attachments/no_image/no_image.png';
    }
}
