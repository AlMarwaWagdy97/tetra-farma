<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model {
    use Translatable, SoftDeletes;

    public $translatedAttributes = ['question','answer'];
    protected $fillable = ['faq_category_id','slug','sort','status','created_by','updated_by'];
    protected $translationForeignKey = 'faq_id';

    public function category(){
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}
