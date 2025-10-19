@extends('admin.app')

@section('title', trans('products.create'))
@section('title_page', trans('products.create'))

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 m-3">
                <div class="row mb-3 text-end">
                    <div>
                        <a href="{{ route('admin.products.index') }}"
                            class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-8">


                                    @foreach ($languages as $key => $locale)
                                        <div class="accordion mt-4 mb-4 bg-primary"
                                            id="accordionExample{{ $locale }}">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingOne{{ $locale }}">
                                                    <button class="accordion-button fw-medium " type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne{{ $locale }}"
                                                        aria-expanded="true" aria-controls="collapseOne{{ $locale }}">
                                                        {{ __('products.' . $locale) }}
                                                    </button>
                                                </h2>
                                                <div id="collapseOne{{ $locale }}"
                                                    class="accordion-collapse collapse show mt-3"
                                                    aria-labelledby="headingOne{{ $locale }}"
                                                    data-bs-parent="#accordionExample{{ $locale }}">
                                                    <div class="accordion-body">


                                                        {{-- title ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                class="col-sm-2 col-form-label">{{ trans('admin.title_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text" required
                                                                    name="{{ $locale }}[title]"
                                                                    value="{{ old($locale . '.title') }}"
                                                                    id="title{{ $key }}">
                                                                @if ($errors->has($locale . '.title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.title') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- slug ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3 slug-section">
                                                            <label for="example-text-input"
                                                                class="col-sm-2 col-form-label">{{ trans('admin.slug_in') . trans('lang.' . Locale::getDisplayName($locale)) }}
                                                            </label>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="slug{{ $key }}"
                                                                    name="{{ $locale }}[slug]"
                                                                    value="{{ old($locale . '.slug') }}"
                                                                    class="form-control slug">
                                                                @if ($errors->has($locale . '.slug'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.slug') }}</span>
                                                                @endif
                                                            </div>
                                                            @include('admin.layouts.scriptSlug')
                                                        </div>

                                                        {{-- description ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                class="col-sm-2 col-form-label">{{ trans('products.description') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                            <div class="col-sm-10">

                                                                <textarea class="form-control" id="description{{ $key }}" name="{{ $locale }}[description]">
                                                        {{ old($locale . '.description') }}
                                                        </textarea>


                                                                <script type="text/javascript">
                                                                    CKEDITOR.replace('description{{ $key }}', {
                                                                        filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                        filebrowserUploadMethod: 'form'
                                                                    });
                                                                </script>


                                                            </div>
                                                            @if ($errors->has($locale . '.description'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                            @endif
                                                        </div>

                                                        {{-- care_tips ------------------------------------------------------------------------------------- --}}
                                                        {{-- <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                class="col-sm-2 col-form-label">{{ trans('products.care_tips') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                            <div class="col-sm-10">

                                                                <textarea class="form-control" id="care_tips{{ $key }}" name="{{ $locale }}[care_tips]">
                                                        {{ old($locale . '.care_tips') }}
                                                        </textarea>


                                                                <script type="text/javascript">
                                                                    CKEDITOR.replace('care_tips{{ $key }}', {
                                                                        filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                        filebrowserUploadMethod: 'form'
                                                                    });
                                                                </script>


                                                            </div>
                                                            @if ($errors->has($locale . '.care_tips'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first($locale . '.care_tips') }}</span>
                                                            @endif
                                                        </div> --}}


                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach


                                    <!-----start test ------>
                                    <div class="accordion mt-4 mb-4 bg-primary" id="accordionExampleSlugs">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingOneSlugs">
                                                <button class="accordion-button fw-medium " type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOneSlugs"
                                                    aria-expanded="true" aria-controls="collapseOneSlugs">
                                                    {{ __('products.meta_info') }}
                                                </button>
                                            </h2>
                                            <div id="collapseOneSlugs" class="accordion-collapse collapse show mt-3"
                                                aria-labelledby="headingOneSlugs" data-bs-parent="#accordionExampleSlugs">
                                                <div class="accordion-body">

                                                    @foreach ($languages as $key => $locale)
                                                        {{-- meta_title ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                class="col-sm-2 col-form-label">{{ trans('products.meta_title') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                            <div class="col-sm-10">

                                                                <input class="form-control"
                                                                    name="{{ $locale }}[meta_title]"
                                                                    value="{{ old($locale . '.meta_title') }} ">


                                                            </div>
                                                            @if ($errors->has($locale . '.meta_title'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first($locale . '.meta_title') }}</span>
                                                            @endif
                                                        </div>


                                                        {{-- meta_desc ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                class="col-sm-2 col-form-label">{{ trans('products.meta_desc') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                            <div class="col-sm-10">

                                                                <textarea class="form-control" id="meta_description{{ $key }}" name="{{ $locale }}[meta_desc]">
                                                        {{ old($locale . '.meta_desc') }}
                                                        </textarea>


                                                                <script type="text/javascript">
                                                                    CKEDITOR.replace('meta_description{{ $key }}', {
                                                                        filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                        filebrowserUploadMethod: 'form'
                                                                    });
                                                                </script>


                                                            </div>
                                                            @if ($errors->has($locale . '.meta_desc'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first($locale . '.meta_desc') }}</span>
                                                            @endif
                                                        </div>


                                                        {{-- meta_key ------------------------------------------------------------------------------------- --}}
                                                        <div class="row mb-3">
                                                            <label for="example-text-input"
                                                                class="col-sm-2 col-form-label">{{ trans('products.meta_key') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                            <div class="col-sm-10">

                                                                <textarea class="form-control" name="{{ $locale }}[meta_key]">
                                                        {{ old($locale . '.meta_key') }}
                                                        </textarea>

                                                            </div>
                                                            @if ($errors->has($locale . '.meta_key'))
                                                                <span
                                                                    class="missiong-spam">{{ $errors->first($locale . '.meta_key') }}</span>
                                                            @endif
                                                        </div>

                                                        <br>
                                                        <hr>
                                                        <br>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!----------end test ---------->


                                    {{-- images Gellary  --}}
                                    <div class="accordion mt-4 mb-4 bg-danger" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingImage">
                                                <button class="accordion-button fw-medium" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseImage"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    @lang('admin.gallerys')
                                                </button>
                                            </h2>
                                            <div id="collapseImage" class="accordion-collapse collapse show mt-3"
                                                aria-labelledby="headingImage" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">

                                                        <input type="hidden" class="form-control" value="0"
                                                            name="gallery[type]">

                                                        @foreach (config('translatable.locales') as $lang)
                                                            <div class=" mb-3 col-sm-2 col-form-label">
                                                                <label>@lang('admin.group_title_' . $lang)</label>
                                                            </div>

                                                            <div class=" mb-3 col-sm-10 ">
                                                                <input type="text" class="form-control" value=""
                                                                    name="gallery[{{ $lang }}][title]">
                                                            </div>
                                                        @endforeach

                                                        <br>
                                                        <br>
                                                        <br>

                                                        <div id="images_section"></div>
                                                        <button type="button" class="btn btn-success form-control mt-3"
                                                            id="add_images_section">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <div class="accordion mt-4 mb-4" id="accordionExample1">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingtwo">
                                                <button class="accordion-button fw-medium" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="true" aria-controls="collapseTwo">
                                                    {{ trans('admin.settings') }}
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse show"
                                                aria-labelledby="headingtwo" data-bs-parent="#accordionExample1">
                                                <div class="accordion-body">

                                                    {{-- cats --}}
                                                    {{-- <div class="row mb-3">
                                                        <label for="example-text-input"
                                                            class="col-sm-4 col-form-label">{{ trans('products.categories') }}</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-select form-select-sm select2" multiple
                                                                name="categories[]" required>
                                                                <option value="" disabled> </option>
                                                                @forelse($cats as $key2 => $cat)
                                                                    <option  value="{{ $cat->id }}" {{ in_array($cat->id ,  old('categories') ?? [] )  ? 'selected' : '' }} >
                                                                        {{ isset($cat->trans[0]) ? $cat->trans[0]->title : '' }}
                                                                    </option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        @if ($errors->has('categories'))
                                                            <span
                                                                class="missiong-spam">{{ $errors->first('categories') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="example-text-input"
                                                            class="col-sm-4 col-form-label">{{ trans('products.occasions') }}</label>
                                                        <div class="col-sm-8">
                                                            <select multiple class="form-select form-select-sm select2"
                                                                name="occasions[]" required >
                                                                <option value="" disabled> </option>
                                                        
                                                                @forelse($occasions as $key1 => $val1)
                                                                        <option value="{{ $val1->id }}" {{ in_array($val1->id, old('occasions', [])) ? 'selected' : '' }}>
                                                                        {{ isset($val1->trans[0]) ? $val1->trans[0]->title : '' }}
                                                                    </option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        @if ($errors->has('occasions'))
                                                            <span class="missiong-spam">{{ $errors->first('occasions') }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="filters" class="col-sm-4 col-form-label">{{ trans('products.filters') }}</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-select form-select-sm select2" multiple name="filters[]">
                                                                <option value="" disabled>{{ trans('products.choose_filters') }}</option>
                                                    
                                                                @forelse($filters as $filter)
                                                                    <option value="{{ $filter->id }}">{{ @$filter->translations[0]->name }}</option>
                                                                @empty
                                                                    <option disabled>{{ trans('products.no_filters_available') }}</option>
                                                                @endforelse
                                                    
                                                            </select>
                                                    
                                                            @if ($errors->has('filters'))
                                                                <span class="text-danger">{{ $errors->first('filters') }}</span>
                                                            @endif
                                                        </div>
                                                    </div> --}}

                                                    {{-- image --}}

                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4"><label for="example-number-input"
                                                                    class='col-form-label'>
                                                                    @lang('products.main_image'):</label></div>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="file"
                                                                    id="example-number-input" name="image"
                                                                    value="{{ old('image') }}">
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('image'))
                                                            <span
                                                                class="missiong-spam">{{ $errors->first('image') }}</span>
                                                        @endif
                                                    </div>

                                                    {{-- resources/views/livewire/admin/calculate-after-sale.blade.php --}}
                                                    {{-- //here --}}
                                                    @livewireStyles
                                                    @livewire('admin.calculate-after-sale')
                                                    @livewireScripts

                                                    {{-- code ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input"
                                                            class="col-sm-4 col-form-label">{{ trans('products.code') }}</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" type="text" name="code"
                                                                value="{{ old('code') }}">
                                                        </div>
                                                        @if ($errors->has('code'))
                                                            <span
                                                                class="missiong-spam">{{ $errors->first('code') }}</span>
                                                        @endif
                                                    </div>


                                                    {{-- sort ------------------------------------------------------------------------------------- --}}
                                                    <div class="row mb-3">
                                                        <label for="example-text-input"
                                                            class="col-sm-4 col-form-label">{{ trans('products.sort') }}</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" type="number" name="sort"
                                                                value="{{ old('sort') }}">
                                                        </div>
                                                        @if ($errors->has('sort'))
                                                            <span
                                                                class="missiong-spam">{{ $errors->first('sort') }}</span>
                                                        @endif
                                                    </div>

                                                    {{-- URL ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-input" col-form-label>
                                                                @lang('slider.url'):</label>
                                                            <div class="col-sm-12">
                                                                <input class="form-control" type="text"
                                                                    id="example-number-input" name="url"
                                                                    value="{{ old('url') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- feature ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label"
                                                            for="available">{{ trans('admin.feature') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="feature"
                                                                type="checkbox" id="switch1" switch="success"
                                                                {{ old('feature') == 'on' ? 'checked' : '' }}>
                                                            <label class="form-label" for="switch1"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('feature'))
                                                        <span class="missiong-spam">{{ $errors->first('feature') }}</span>
                                                    @endif
                                                    {{-- Status ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label"
                                                            for="available">{{ trans('admin.status') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="status"
                                                                type="checkbox" id="switch3" switch="success"
                                                                {{ old('status') == 'on' ? 'checked' : '' }}>
                                                            <label class="form-label" for="switch3"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                        @if ($errors->has('status'))
                                                            <span
                                                                class="missiong-spam">{{ $errors->first('status') }}</span>
                                                        @endif
                                                    </div>


                                                    {{-- in_stock ------------------------------------------------------------------------------------- --}}
                                                    {{-- <div class="col-12">
                                                        <label class="col-sm-12 col-form-label"
                                                            for="available">{{ trans('admin.in_stock') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="in_stock"
                                                                type="checkbox" id="switch3in_stock" switch="success"
                                                                {{ old('in_stock') == 'on' ? 'checked' : '' }}>
                                                            <label class="form-label" for="switch3in_stock"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                        @if ($errors->has('in_stock'))
                                                            <span class="missiong-spam">{{ $errors->first('in_stock') }}</span>
                                                        @endif
                                                    </div> --}}

                                                    {{-- show_text ------------------------------------------------------------------------------------- --}}
                                                    {{-- <div class="col-12">
                                                        <label class="col-sm-12 col-form-label"
                                                            for="available">{{ trans('admin.show_text') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="show_text"
                                                                type="checkbox" id="switch3show_text" switch="success"
                                                                {{ old('show_text') == 'on' ? 'checked' : '' }}>
                                                            <label class="form-label" for="switch3show_text"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                        @if ($errors->has('show_text'))
                                                            <span class="missiong-spam">{{ $errors->first('show_text') }}</span>
                                                        @endif
                                                    </div> --}}

                                                    {{-- show_in_slider ------------------------------------------------------------------------------------- --}}
                                                    {{-- <div class="col-12">
                                                        <label class="col-sm-12 col-form-label"
                                                            for="available">{{ trans('admin.show_in_slider') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="show_in_slider"
                                                                type="checkbox" id="switch9" switch="success"
                                                                {{ old('show_in_slider') == 'on' ? 'checked' : '' }}>
                                                            <label class="form-label" for="switch9"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                        @if ($errors->has('show_in_slider'))
                                                            <span class="missiong-spam">{{ $errors->first('show_in_slider') }}</span>
                                                        @endif
                                                    </div> --}}

                                                    {{-- user_input ------------------------------------------------------------------------------------- --}}

                                                    {{-- <div class="col-12">
                                                        <label class="col-sm-12 col-form-label"
                                                            for="available">{{ trans('admin.user_input') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="user_input"
                                                                type="checkbox" id="switch99" switch="success"
                                                                {{ old('user_input') == 'on' ? 'checked' : '' }}>
                                                            <label class="form-label" for="switch99"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                        @if ($errors->has('user_input'))
                                                            <span class="missiong-spam">{{ $errors->first('user_input') }}</span>
                                                        @endif
                                                    </div> --}}

                                                    {{-- product_cart ------------------------------------------------------------------------------------- --}}
                                                    {{-- <div class="col-12">
                                                        <label class="col-sm-12 col-form-label"
                                                            for="available">{{ trans('admin.product_cart') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="product_cart"
                                                                type="checkbox" id="switch100" switch="success"
                                                                {{ old('product_cart') == 'on' ? 'checked' : '' }}>
                                                            <label class="form-label" for="switch100"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                        @if ($errors->has('product_cart'))
                                                            <span class="missiong-spam">{{ $errors->first('product_cart') }}</span>
                                                        @endif
                                                    </div> --}}

                                                    {{-- has_pockets --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-12 col-form-label"
                                                            for="has_pockets">{{ trans('products.medicine_feature') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="has_pockets"
                                                                type="checkbox" id="switch_has_pockets" switch="success"
                                                                {{ old('has_pockets') == 'on' ? 'checked' : '' }}>
                                                            <label class="form-label" for="switch_has_pockets"
                                                                data-on-label="@lang('admin.yes')"
                                                                data-off-label="@lang('admin.no')"></label>
                                                        </div>
                                                        @if ($errors->has('has_pockets'))
                                                            <span
                                                                class="missiong-spam">{{ $errors->first('has_pockets') }}</span>
                                                        @endif
                                                    </div>

                                                    <div id="pockets_section" style="display: none;">
                                                        <h4>{{ trans('products.medicine_feature') }}</h4>
                                                        <div id="pockets_inputs"></div>
                                                        <button type="button" class="btn btn-success mt-3"
                                                            id="add_pocket">
                                                            <i class="fa fa-plus"></i> {{ trans('products.add_feature') }}
                                                        </button>
                                                    </div>
                                                    @foreach ($languages as $key => $locale)
                                                   
                                                            {{-- form ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-12 col-form-label">{{ trans('admin.form_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[form]"
                                                                        value="{{ old($locale . '.form') }}"
                                                                        id="form{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.form'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.form') }}</span>
                                                                @endif
                                                            </div>
                                                            {{-- category ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-12 col-form-label">{{ trans('admin.category_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[category]"
                                                                        value="{{ old($locale . '.category') }}"
                                                                        id="category{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.category'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.category') }}</span>
                                                                @endif
                                                            </div>
                                                            {{-- servings ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-12 col-form-label">{{ trans('admin.servings_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[servings]"
                                                                        value="{{ old($locale . '.servings') }}"
                                                                        id="servings{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.servings'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.servings') }}</span>
                                                                @endif
                                                            </div>
                                                            {{-- dispatch ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-12 col-form-label">{{ trans('admin.dispatch_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[dispatch]"
                                                                        value="{{ old($locale . '.dispatch') }}"
                                                                        id="dispatch{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.dispatch'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.dispatch') }}</span>
                                                                @endif
                                                            </div>
                                                        
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Butoooons ------------------------------------------------------------------------- --}}
                                <div class="row mb-3 text-end">
                                    <div>
                                        <a href="{{ route('admin.products.index') }}"
                                            class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                                        <button type="submit"
                                            class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">@lang('button.save')</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div> <!-- container-fluid -->

@endsection


@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#add_images_section').on('click', function() {
                $('#images_section').append(`
            <div class="images">
                <div class="row">
                    <div class="col-12">
                        <label>@lang('admin.image'):</label>
                        <input type="file" name="gallery_image[]" class="form-control" required>
                    </div>
                    <div class="col-3">
                        <label>@lang('admin.sort'):</label>
                        <input type="number" name="gallery_sort[]" class="form-control" required>
                    </div>
                    <div class="col-3">
                        <label>@lang('admin.feature'):</label>
                        <input type="checkbox" name="gallery_feature[]" value="1" style="margin-top:28px;">
                    </div>
                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-danger delete_img form-control">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                <hr>
            </div>
        `);
            });

            $('#images_section').on('click', '.delete_img', function() {
                $(this).closest('.images').remove();
            });
            let pocketIndex = 0;
            $('#switch_has_pockets').on('change', function() {
                $('#pockets_section').toggle(this.checked);
            });

            $('#add_pocket').on('click', function() {
                const currentIndex = pocketIndex++;
                $('#pockets_inputs').append(`
            <div class="pocket-row mb-3 p-3 border rounded">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input
                            type="text"
                            name="pockets[en][${currentIndex}]"
                            class="form-control col-md-12"
                            placeholder="{{ trans('products.feature_name_en') }}"
                            required
                        >
                    </div>
                    <div class="col-md-12 mb-2">
                        <input
                            type="text"
                            name="pockets[ar][${currentIndex}]"
                            class="form-control"
                            placeholder="{{ trans('products.feature_name_ar') }}"
                            required
                        >
                    </div>
                   
                   
                    <div class="col-md-12 text-end align-self-end mb-2">
                        <button type="button" class="btn btn-danger remove_pocket">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `);
            });

            $('#pockets_inputs').on('click', '.remove_pocket', function() {
                $(this).closest('.pocket-row').remove();
            });
        });
    </script>

@endsection
