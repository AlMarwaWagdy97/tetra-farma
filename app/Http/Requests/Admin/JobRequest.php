<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function authorize()
     { 
        return true; 
    }

    public function rules()
    {
        $rules = [
            'employment_type' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:191',
            'image' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
            'sort' => 'nullable|integer',
        ];

        // per-locale fields
        foreach (config('translatable.locales') as $locale) {
            $rules["{$locale}.title"] = 'nullable|string|max:255';
            $rules["{$locale}.short_description"] = 'nullable|string|max:500';
            $rules["{$locale}.description"] = 'nullable|string';
            $rules["{$locale}.requirements"] = 'nullable|string';
        }

        // tags array optional
        $rules['tags'] = 'nullable|array';
        $rules['tags.*'] = 'nullable|integer|exists:tags,id';

        return $rules;
    }
}

