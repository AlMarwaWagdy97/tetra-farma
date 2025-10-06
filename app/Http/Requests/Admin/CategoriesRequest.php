<?php

namespace App\Http\Requests\Admin;

use Locale;
use App\Models\Categories;
use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        $attr = [];
        foreach (config('translatable.locales') as $locale) {
            $attr += [$locale . '.title' => 'Title ' . Locale::getDisplayName($locale) ];
            $attr += [$locale . '.slug' => 'Slug '. Locale::getDisplayName($locale) ];
            $attr += [$locale . '.description' => 'Description '. Locale::getDisplayName($locale) ];
            $attr += [$locale . '.content' => 'Content '. Locale::getDisplayName($locale) ];
            $attr += [$locale . '.meta_title' => 'Meta title '. Locale::getDisplayName($locale) ];
            $attr += [$locale . '.meta_description' => 'Meta description '. Locale::getDisplayName($locale) ];
            $attr += [$locale . '.meta_key' => 'Meta key '. Locale::getDisplayName($locale) ];
        }
        $attr += ['image' =>'Image'];
        $attr += ['sort' =>'Sort'];
        $attr += ['feature' =>'Fearure'];
        $attr += ['status' =>'Status'];
        $attr += ['parent_id' =>'Parent'];

        return $attr;

    }
 
    public function rules()
    {

        $req = [];
        foreach(config('translatable.locales') as $locale){
            $req += [$locale . '.title' => 'required'];
            $req += [$locale . '.slug' => 'required'];
            $req += [$locale . '.description' => 'nullable'];
            $req += [$locale . '.content' => 'nullable'];

            $req += [$locale . '.meta_title' => 'nullable'];
            $req += [$locale . '.meta_description' => 'nullable'];
            $req += [$locale . '.meta_key' => 'nullable'];
        }
        $req += ['image' =>'nullable|' . ImageValidate()];
        $req += ['status' =>'nullable'];
        $req += ['sort' =>'nullable'];
        $req += ['feature' =>'nullable'];
        $req += ['parent_id' =>'nullable'];



        return $req;
    }

    
    public function getSanitized(){

        $data = $this->validated();
        
        $data['status'] = isset($data['status']) ? true : false;
        $data['feature'] = isset($data['feature']) ? true : false;
        $data['level'] = updateLevel(@Categories::find($data['parent_id']));
        foreach(config('translatable.locales') as $locale){
            $data[$locale]['slug'] = slug($data[$locale]['slug']);
        }
        if (request()->isMethod('PUT')){
            $data['updated_by']  = @auth()->user()->id;
        }
        else{
            $data['created_by']  = @auth()->user()->id;
        }
        return $data;
    }

}
