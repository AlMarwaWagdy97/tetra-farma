<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Locale;
class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
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
        $attr += ['news_ticker' =>'News Ticker'];
        $attr += ['status' =>'Status'];

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
        $req += ['news_ticker' =>'nullable'];
        $req += ['updated_by' =>'nullable'];
        $req += ['created_by' =>'nullable'];



        return $req;
    }

    
    public function getSanitized(){

        $data = $this->validated();
        
        $data['status'] = isset($data['status']) ? true : false;
        $data['feature'] = isset($data['feature']) ? true : false;
        $data['news_ticker'] = isset($data['news_ticker']) ? true : false;
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
