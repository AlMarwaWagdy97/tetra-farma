<?php

namespace App\Models;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory,Translatable, SoftDeletes;
    public $translatedAttributes = [
        'title',
        'description',
        'slug',
        'meta_title',
        'meta_description',
        'meta_key',
        'locale',
        'tag_id'
    ];
    protected $translationForeignKey = 'tag_id';
    protected $fillable=[
        'sort',
        'back_home',
        'image',
        'background_color',
        'background_image',
        'feature',
        'status',
        'created_by',
        'updated_by',
    ];

    // relations ------------------------------------------------------------------------------
    public function trans(){
        return $this->hasMany(TagTranslation::class ,'tag_id');
    }
    public function portfolios(){
        return $this->hasMany(Portfolios::class, 'tag_id', 'id')->active();
    }
    public function arttcile()
    {
        return $this->belongsToMany(Articles::class,'article_tags','tag_id','article_id');
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
    
}
