<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'image',
        'sort',
        'status',
        'feature',
        'news_ticker',
        'category_id',
        'created_by',
        'updated_by',
    ];

    protected $translationForeignKey = 'article_id';
    public $translatedAttributes = [
        'article_id',
        'locale',
        'title',
        'slug',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'meta_key',
    ];


    public function trans(){
        return $this->hasMany(ArticlesTranslation::class, 'article_id', 'id');
    }

    // Scopes ----------------------------
    public function scopeActive($query){
        return $query->where('status', 1);
    }
    public function scopeFeature($query){
        return $query->where('feature', 1);
    }
    public function scopeLang($query){
        return $query->trans->where('locale',  app()->getLocale())->first();
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'article_tags','article_id','tag_id')->with('trans');
    }

    public function categories(){
        return $this->belongsTo(Categories::class,'category_id')->with('trans');
    }
}
