<?php

namespace App\Models;

use App\Models\Portfolios;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioTags extends Model
{
    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = [
        'title',
        'slug',
        'locale',
        'tag_id'
    ];
    protected $translationForeignKey = 'tag_id';
    protected $fillable = [
        'sort',
        'feature',
        'status',
        'created_by',
        'updated_by',
    ];

    // relations ------------------------------------------------------------------------------
    public function trans()
    {
        return $this->hasMany(PortfolioTagsTranslation::class, 'tag_id');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolios::class, 'tag_id', 'id');
    }

    // Scopes ----------------------------
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeFeature($query)
    {
        return $query->where('feature', 1);
    }
}
