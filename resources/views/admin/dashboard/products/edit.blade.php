@extends('admin.app')

@section('title', trans('products.edit_product'))
@section('title_page', trans('products.edit_product', ['name' => $product->transNow?->title]))

@section('content')

    <div class="container-fluid">
        <div class="row">
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
                            <form class="row" method="post" action="{{ route('admin.products.update', $product->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- title and description --}}
                                <div class="col-md-8">
                                    @foreach ($languages as $key => $locale)
                                        @php  $trans =   $product->trans->where('locale', $locale)->first();  @endphp
                                        @if ($trans)
                                            <div class="accordion mt-4 mb-4" id="accordionExample">
                                                <div class="accordion-item border rounded">
                                                    <h2 class="accordion-header" id="headingOne{{ $key }}">
                                                        <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne{{ $key }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne{{ $key }}">
                                                            {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne{{ $key }}"
                                                        class="accordion-collapse collapse show mt-3"
                                                        aria-labelledby="headingOne{{ $key }}"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            {{-- title ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.title_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[title]"
                                                                        value="{{ old($locale . '.title') ?? $trans->title }}"
                                                                        id="title{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.title') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- slug ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3 slug-section">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.slug_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="{{ $locale }}[slug]"
                                                                        value="{{ old($locale . '.slug') ?? $trans->slug }}"
                                                                        id="slug{{ $key }}"
                                                                        class="form-control slug" required>
                                                                </div>
                                                                @if ($errors->has($locale . '.slug'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.slug') }}</span>
                                                                @endif
                                                            </div>

                                                            @include('admin.layouts.scriptSlug')

                                                            {{-- description ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label"> @lang('admin.description_in')
                                                                    {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea id="description{{ $key }}" name="{{ $locale }}[description]"> {{ old($locale . '.description') ?? $trans->description }} </textarea>
                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('description{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>
                                                                    @if ($errors->has($locale . '.description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- care_tips ------------------------------------------------------------------------------------- --}}
                                                            {{-- <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label"> @lang('admin.care_tips_in')
                                                                    {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea id="care_tips{{ $key }}" name="{{ $locale }}[care_tips]"> {{ old($locale . '.care_tips') ?? $trans->care_tips }} </textarea>
                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('care_tips{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>
                                                                    @if ($errors->has($locale . '.care_tips'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.care_tips') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="accordion mt-4 mb-4" id="accordionExample">
                                                <div class="accordion-item border rounded">
                                                    <h2 class="accordion-header" id="headingOne{{ $key }}">
                                                        <button class="accordion-button fw-medium" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne{{ $key }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapseOne{{ $key }}">
                                                            {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne{{ $key }}"
                                                        class="accordion-collapse collapse show mt-3"
                                                        aria-labelledby="headingOne{{ $key }}"
                                                        data-bs-parent="#accordionExample">
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
                                                                </div>
                                                                @if ($errors->has($locale . '.title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.title') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- slug ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3 slug-section">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.slug_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="{{ $locale }}[slug]"
                                                                        value="{{ old($locale . '.slug') }}"
                                                                        id="slug{{ $key }}"
                                                                        class="form-control slug" required>
                                                                </div>
                                                                @if ($errors->has($locale . '.slug'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.slug') }}</span>
                                                                @endif
                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $("#title" + {{ $key }}).on('keyup', function() {
                                                                            var Text = $(this).val();
                                                                            Text = Text.toLowerCase();
                                                                            Text = Text.replace(/[^a-zA-Z0-9ء-ي]+/g, '-');
                                                                            $("#slug" + {{ $key }}).val(Text);
                                                                        });
                                                                    });
                                                                </script>
                                                            </div>
                                                            @include('admin.layouts.scriptSlug')

                                                            {{-- description ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label"> @lang('admin.description_in')
                                                                    {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea id="description{{ $key }}" name="{{ $locale }}[description]">   {{ old($locale . '.description') }}  </textarea>
                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('description{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>
                                                                    @if ($errors->has($locale . '.description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    {{-- meta info --}}
                                    <div class="accordion mt-4 mb-4 bg-success" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingTwo{{ $key }}">
                                                <button class="accordion-button fw-medium" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo{{ $key }}" aria-expanded="true"
                                                    aria-controls="collapseTwo{{ $key }}">
                                                    @lang('admin.meta')
                                                </button>
                                            </h2>
                                            <div id="collapseTwo{{ $key }}"
                                                class="accordion-collapse collapse show mt-3"
                                                aria-labelledby="headingTwo{{ $key }}"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach ($languages as $key => $locale)
                                                        @php  $trans =   $product->trans->where('locale', $locale)->first();  @endphp
                                                        @if ($trans)
                                                            {{-- meta info  ------------------------------------------------------------------------------------- --}}
                                                            {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.meta_title_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[meta_title]"
                                                                        value="{{ old($locale . '.meta_title') ?? $trans->meta_title }}"
                                                                        id="title{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.meta_title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.meta_title') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label"> @lang('admin.meta_description_in')
                                                                    {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea id="meta_description{{ $key }}" name="{{ $locale }}[meta_desc]"
                                                                        class="form-control description">    {!! $trans->meta_desc !!} </textarea>
                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('meta_description{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>
                                                                    @if ($errors->has($locale . '.meta_description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.meta_description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label"> @lang('admin.meta_key_in')
                                                                    {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="{{ $locale }}[meta_key]" class="form-control description"> {!! $trans->meta_key !!}</textarea>
                                                                    @if ($errors->has($locale . '.meta_key'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.meta_key') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!----------end meta info ----------------->
                                                        @else
                                                            {{-- meta info  ------------------------------------------------------------------------------------- --}}
                                                            {{-- slug ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3 slug-section">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.slug_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text"
                                                                        name="{{ $locale }}[slug]"
                                                                        value="{{ old($locale . '.slug') }}"
                                                                        id="slug{{ $key }}"
                                                                        class="form-control slug" required>
                                                                </div>
                                                                @if ($errors->has($locale . '.slug'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.slug') }}</span>
                                                                @endif
                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $("#title" + {{ $key }}).on('keyup', function() {
                                                                            var Text = $(this).val();
                                                                            Text = Text.toLowerCase();
                                                                            Text = Text.replace(/[^a-zA-Z0-9ء-ي]+/g, '-');
                                                                            $("#slug" + {{ $key }}).val(Text);
                                                                        });
                                                                    });
                                                                </script>
                                                            </div>

                                                            {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.meta_title_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[meta_title]"
                                                                        value="{{ old($locale . '.meta_title') }}"
                                                                        id="title{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.meta_title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.meta_title') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- meta_description_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label"> @lang('admin.meta_description_in')
                                                                    {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea id="meta_description{{ $key }}" name="{{ $locale }}[meta_desc]"
                                                                        class="form-control description">   {{ old($locale . '.meta_desc') }} </textarea>
                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('meta_description{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>
                                                                    @if ($errors->has($locale . '.meta_description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.meta_description') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- meta_key_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label"> @lang('admin.meta_key_in')
                                                                    {{ trans('lang.' . Locale::getDisplayName($locale)) }}
                                                                </label>
                                                                <div class="col-sm-10 mb-2">
                                                                    <textarea name="{{ $locale }}[meta_key]" class="form-control description">   {{ old($locale . '.meta_key') }} </textarea>
                                                                    @if ($errors->has($locale . '.meta_key'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.meta_key') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!----------end meta info ----------------->
                                                        @endif
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($product->galleryGroup && $product->galleryGroup->images && $product->galleryGroup->images->count())
                                        {{-- images Gellary  --}}
                                        <div class="accordion mt-4 mb-4 bg-danger" id="accordionExample_image_old">
                                            <div class="accordion-item border rounded">
                                                <h2 class="accordion-header" id="headingImage2">
                                                    <button class="accordion-button fw-medium" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseImage2"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        @lang('admin.current_gallerys')
                                                    </button>
                                                </h2>
                                                <div id="collapseImage2" class="accordion-collapse collapse show mt-3"
                                                    aria-labelledby="headingImage2"
                                                    data-bs-parent="#accordionExample_image_old">
                                                    <div class="accordion-body">
                                                        <div class="row mb-3">
                                                            <div class="row">
                                                                @forelse($product->galleryGroup->images as $image)
                                                                    <div class="col-4 p-5">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <img style="width: 100%; height:100px"
                                                                                    src="{{ asset($image->pathInView('products')) }}">
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <h4>{{ $image->title }} </h4>
                                                                                <h6> @lang('products.sort')
                                                                                    : {{ $image->sort }} </h6>
                                                                                <br>
                                                                                <a class="btn btn-danger btn-sm"
                                                                                    href="{{ \LaravelLocalization::localizeURL(route('admin.products.destroy_product_gallery_image', $image->id)) }}">
                                                                                    <i class="fa fa-trash"></i> </a>
                                                                                <br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- images Gellary  --}}
                                    <div class="accordion mt-4 mb-4 bg-danger" id="accordionExample_image">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingImage">
                                                <button class="accordion-button fw-medium" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseImage"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    @lang('admin.update_gallerys')
                                                </button>
                                            </h2>
                                            <div id="collapseImage" class="accordion-collapse collapse show mt-3"
                                                aria-labelledby="headingImage" data-bs-parent="#accordionExample_image">
                                                <div class="accordion-body">
                                                    <div class="row mb-3">
                                                        <input type="hidden" class="form-control" value="0"
                                                            name="gallery[type]">
                                                        @foreach (config('translatable.locales') as $lang)
                                                            @if ($product->galleryGroup?->translate($lang) && $product->galleryGroup?->translate($lang)->id)
                                                                <input class="d-none" type="text"
                                                                    value="{{ $product->galleryGroup->translate($lang)->id }}"
                                                                    name="gallery[id]">
                                                            @endif
                                                            <div class=" mb-3 col-sm-2 col-form-label">
                                                                <label>@lang('admin.group_title_' . $lang)</label>
                                                            </div>
                                                            <div class=" mb-3 col-sm-10 ">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $product->galleryGroup?->translate($lang)?->title }}"
                                                                    name="gallery[{{ $lang }}][title]">
                                                            </div>
                                                        @endforeach
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

                                {{-- other info --}}
                                <div class="col-md-4">
                                    <div class="accordion mt-4 mb-4" id="accordionExample">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button fw-medium" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    {{ trans('admin.settings') }}
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">





                                                    @if (@$product->image != null)
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <div class="col-sm-12">
                                                                    <a href="{{ asset($product->pathInView('products')) }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset($product->pathInView('products')) }}"
                                                                            alt="" style="width:100%">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-specialty"
                                                                class="col-sm-2 col-form-label">
                                                                @lang('products.image')</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="file"
                                                                    placeholder="@lang('products.image')" name="image">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @livewireStyles
                                                    @livewire('admin.calculate-after-sale', ['model' => @$product])
                                                    @livewireScripts

                                                    {{-- code ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-email"
                                                                class="col-sm-2 col-form-label">
                                                                @lang('products.code')</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="text"
                                                                    placeholder="@lang('products.code')" name="code"
                                                                    value="{{ $product->code ?? old('code') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- sort ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-address"
                                                                class="col-sm-2 col-form-label">
                                                                @lang('admin.sort')</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" type="number"
                                                                    placeholder="@lang('admin.sort')" name="sort"
                                                                    value="{{ $product->sort ?? old('sort') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- URL ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-input" col-form-label>
                                                                @lang('slider.url'):</label>
                                                            <div class="col-sm-12">
                                                                <input class="form-control" type="text"
                                                                    id="example-number-input" name="url"
                                                                    value="{{ @$product->url == 'javascript:void(0)' ? '' : @$product->url }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- feature ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="available">{{ trans('admin.feature') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="feature"
                                                                type="checkbox" id="switch1" switch="success"
                                                                {{ $product->feature == 1 || old('feature') == 1 ? 'checked' : '' }}
                                                                value="1">
                                                            <label class="form-label" for="switch1"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                    </div>
                                                    {{-- Status ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="available">{{ trans('admin.status') }}</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-check form-switch" name="status"
                                                                type="checkbox" id="switch3" switch="success"
                                                                {{ $product->status == 1 || old('status') == 1 ? 'checked' : '' }}
                                                                value="1">
                                                            <label class="form-label" for="switch3"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                    </div>
                                                    {{-- Pockets Section --}}
                                                    <div class="accordion mt-4 mb-4" id="accordionPockets">
                                                        <div class="accordion-item border rounded">
                                                            <h2 class="accordion-header" id="headingPockets">
                                                                <button class="accordion-button fw-medium" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapsePockets" aria-expanded="true"
                                                                    aria-controls="collapsePockets">
                                                                    @lang('products.medicine_feature')
                                                                </button>
                                                            </h2>
                                                            <div id="collapsePockets"
                                                                class="accordion-collapse collapse show mt-3"
                                                                aria-labelledby="headingPockets"
                                                                data-bs-parent="#accordionPockets">
                                                                <div class="accordion-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-12 mb-3">
                                                                            <label>@lang('products.medicine_feature')</label>
                                                                            <input type="checkbox" name="has_pockets"
                                                                                id="has_pockets"
                                                                                {{ $product->has_pockets ? 'checked' : '' }}>
                                                                        </div>

                                                                        <div id="pockets_section"
                                                                            style="{{ $product->has_pockets ? '' : 'display:none;' }}">
                                                                            @if ($product->has_pockets && $product->pockets->count())
                                                                                @foreach ($product->pockets as $index => $pocket)
                                                                                    <div class="pocket mb-4 p-3 border rounded"
                                                                                        data-index="{{ $index }}">
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-2">
                                                                                                <label>@lang('products.feature_name_en')</label>
                                                                                                <input type="text"
                                                                                                    name="pockets[en][{{ $index }}]"
                                                                                                    value="{{ @$pocket->translate('en')->pocket_name }}"
                                                                                                    class="form-control"
                                                                                                    required>
                                                                                            </div>

                                                                                            <div class="col-md-12 mb-2">
                                                                                                <label>@lang('products.feature_name_ar')</label>
                                                                                                <input type="text"
                                                                                                    name="pockets[ar][{{ $index }}]"
                                                                                                    value="{{ @$pocket->translate('ar')->pocket_name }}"
                                                                                                    class="form-control"
                                                                                                    required>
                                                                                            </div>

                                                                                            <div class="col-md-12 mb-2">
                                                                                                {{-- <label>@lang('products.pocket_price')</label> --}}
                                                                                                <input hidden
                                                                                                    type="number"
                                                                                                    name="pockets[price][{{ $index }}]"
                                                                                                    value="{{ @$pocket->price }}"
                                                                                                    class="form-control"
                                                                                                    step="0.01">
                                                                                            </div>

                                                                                            {{-- @if ($pocket->image && ($images = json_decode($pocket->image)))
                                                                                                <div class="col-12 mb-2">
                                                                                                    <label>@lang('products.current_images')</label>
                                                                                                    <div
                                                                                                        class="d-flex flex-wrap">
                                                                                                        @foreach ($images as $img)
                                                                                                            <div class="position-relative me-2 mb-2"
                                                                                                                style="width: 80px;">
                                                                                                                <img src="{{ asset('attachments/pockets/' . $img) }}"
                                                                                                                    class="img-thumbnail"
                                                                                                                    style="max-width:80px; max-height:80px;">
                                                                                                             
                                                                                                            </div>
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif --}}


                                                                                            {{-- <div class="col-md-12 mb-2">
                                                                                                <label>@lang('products.new_pocket_images')</label>
                                                                                                <input type="file"
                                                                                                    name="pockets[image][{{ $index }}][]"
                                                                                                    class="form-control"
                                                                                                    accept="image/*"
                                                                                                    multiple>
                                                                                            </div> --}}


                                                                                            <input type="hidden"
                                                                                                name="pockets[id][{{ $index }}]"
                                                                                                value="{{ $pocket->id }}">


                                                                                            <div
                                                                                                class="col-md-4 text-end align-self-end mb-2">
                                                                                                <button type="button"
                                                                                                    class="btn btn-danger delete_pocket">
                                                                                                    <i
                                                                                                        class="fa fa-trash"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-12">
                                                                            {{-- <button type="button" id="add_pocket"
                                                                                class="btn btn-success"
                                                                                style="{{ $product->has_pockets ? '' : 'display:none;' }}">
                                                                                <i class="fa fa-plus"></i>
                                                                                @lang('products.add_pocket')
                                                                            </button> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @foreach ($languages as $key => $locale)
                                                        @php  $trans =   $product->trans->where('locale', $locale)->first();  @endphp
                                                        @if ($trans)
                                                            {{-- form ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-12 col-form-label">{{ trans('admin.form_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[form]"
                                                                        value="{{ old($locale . '.form') ?? $trans->form }}"
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
                                                                        value="{{ old($locale . '.category') ?? $trans->category }}"
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
                                                                        value="{{ old($locale . '.servings') ?? $trans->servings }}"
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
                                                                        value="{{ old($locale . '.dispatch') ?? $trans->dispatch }}"
                                                                        id="dispatch{{ $key }}">
                                                                </div>
                                                                @if ($errors->has($locale . '.dispatch'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.dispatch') }}</span>
                                                                @endif
                                                            </div>
                                                        @else
                                                            {{-- form ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-12 col-form-label">{{ trans('admin.form_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[form]"
                                                                        value="{{ old($locale . '.form')  }}"
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
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 text-end">
                                    <div>
                                        <button type="submit"
                                            class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">@lang('button.submit')</button>
                                        <a href="{{ route('admin.products.index') }}"
                                            class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div> <!-- end row-->
    </div> <!-- container-fluid -->

@endsection

@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(document).ready(function() {
            let pocketIndex = {{ $product->pockets->count() }};
            $('#add_images_section').on('click', function() {
                $('#images_section').append(
                    `
                    <div class="images ">
                        <div class="row">
                            <div class="col-12">
                                    <label for="example-number-input"  > @lang('admin.image'):</label>
                                <input type="file" name="gallery_image[]"   class="form-control" >
                            </div>
                            <div class="col-3">
                                <label for="example-number-input"  > @lang('admin.sort'):</label>
                                <input type="number" name="gallery_sort[]" required  class="form-control"  >
                            </div>
                            <div class="col-3">
                                <label for="example-number-input"  > @lang('admin.feature'):</label>
                                <input    style="margin-top: 28px;" type="checkbox" name="gallery_feature[]" value="1"     >
                            </div>
                          
                            <div class="col-12 mt-3">
                                <button class="btn btn-danger delete_img form-control"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <hr>
                    </div>
                    `
                )
            });

            $('#images_section').on('click', '.delete_img', function(e) {
                $(this).parent().parent().parent().remove();
            });

            // Toggle pockets section based on checkbox
            function togglePocketsSection() {
                if ($('#has_pockets').is(':checked')) {
                    $('#pockets_section').show();
                    $('#add_pocket').show();
                } else {
                    $('#pockets_section').hide();
                    $('#add_pocket').hide();
                }
            }

            togglePocketsSection();

            $('#has_pockets').on('change', function() {
                togglePocketsSection();
            });

            // Add new pocket section
            $('#add_pocket').on('click', function() {
                const currentIndex = pocketIndex++;
                $('#pockets_section').append(`
                <div class="pocket mb-4 p-3 border rounded" data-index="${currentIndex}">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label>@lang('products.pocket_name_en')</label>
                            <input type="text" name="pockets[en][${currentIndex}]" class="form-control" >
                        </div>
                        <div class="col-md-12 mb-2">
                            <label>@lang('products.pocket_name_ar')</label>
                            <input type="text" name="pockets[ar][${currentIndex}]" class="form-control" >
                        </div>
                        <input type="hidden" name="pockets[id][${currentIndex}]" value="new">
                        <div class="col-md-12 text-end align-self-end mb-2">
                            <button type="button" class="btn btn-danger delete_pocket">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
            });

            // Remove pocket section
            $('#pockets_section').on('click', '.delete_pocket', function() {
                $(this).closest('.pocket').remove();
            });
        });
    </script>
@endsection
