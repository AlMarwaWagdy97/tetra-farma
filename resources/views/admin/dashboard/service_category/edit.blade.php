@extends('admin.app')

@section('title', trans('service_categories.edit_service_categories'))
@section('title_page', trans('service_categories.edit_service_categories', ['name' => $service_category->trans ?
    @$service_category->trans->where('locale', $current_lang)->first()->title : '']))

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="row">
                <div class="col-12 m-3">
                    <div class="row mb-3 text-end">
                        <div>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form class="row" method="post"
                                action="{{ route('admin.service.update', $service_category->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')


                                {{-- title and description --}}
                                <div class="col-md-8">
                                    @foreach ($languages as $key => $locale)
                                        @php $trans = $service_category->trans()->where('locale' , $locale)->first() @endphp
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
                                                                    {{-- <input class="form-control" type="text" name="{{ $locale }}[title]" value="{{ @$service_category->trans->where('locale',$locale)->first()->title}}" id="title{{ $key }}"> --}}
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[title]"
                                                                        value="{{ $trans->title }}"
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
                                                                        value="{{ $trans->slug }}"
                                                                        id="slug{{ $key }}"
                                                                        class="form-control slug" required>
                                                                </div>
                                                                @if ($errors->has($locale . '.slug'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.slug') }}</span>
                                                                @endif

                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $("#title" + {
                                                                            {
                                                                                $key
                                                                            }
                                                                        }).
                                                                        on('keyup', function() {
                                                                            var Text = $(this).val();
                                                                            Text = Text.toLowerCase();
                                                                            Text = Text.replace(/[^a-zA-Z0-9ء-ي]+/g, '-');
                                                                            $("#slug" + {
                                                                                {
                                                                                    $key
                                                                                }
                                                                            }).
                                                                            val(Text);
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


                                                                    <textarea id="description{{ $key }}" name="{{ $locale }}[description]"> {{ $trans->description }} </textarea>


                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('description{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>


                                                                    {{-- {!!  $service_category->transNow->description  !!} --}}


                                                                    @if ($errors->has($locale . '.description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                                    @endif
                                                                </div>

                                                            </div>



                                                            <br>
                                                            <br>
                                                            <br>
                                                            <!--------------------------start middle page ------------------------>
                                                            {{-- middle_title ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('service_categories.middle_title') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">

                                                                    <input class="form-control"
                                                                        value="{{ $trans->middle_title ?? old($locale . '.middle_title') }}"
                                                                        name="{{ $locale }}[middle_title]">
                                                                </div>
                                                                @if ($errors->has($locale . '.middle_title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.middle_title') }}</span>
                                                                @endif
                                                            </div>


                                                            {{-- middle_content ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('service_categories.middle_content') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">

                                                                    <textarea class="form-control" id="middle_content{{ $key }}" name="{{ $locale }}[middle_content]">
                                                                {{ $trans->middle_content ?? old($locale . '.middle_content') }}
                                                                </textarea>


                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('middle_content{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>


                                                                </div>
                                                                @if ($errors->has($locale . '.middle_content'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.middle_content') }}</span>
                                                                @endif
                                                            </div>
                                                            <!----------end middle page ------------------------------------------>

                                                            {{-- info --}}
                                                            <div class="row mb-3">
                                                                <label
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.info_title_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[info_title]"
                                                                        value="{{ $trans->info_title ?? '' }}" />
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.info_description_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <textarea class="form-control" name="{{ $locale }}[info_description]">{{ $trans->info_description ?? '' }}</textarea>
                                                                </div>
                                                            </div>

                                                            {{-- end info --}}


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
                                                                    {{-- <input class="form-control" type="text" name="{{ $locale }}[title]" value="{{ @$service_category->trans->where('locale',$locale)->first()->title}}" id="title{{ $key }}"> --}}
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[title]" value=" "
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
                                                                    <input type="text"
                                                                        name="{{ $locale }}[slug]"
                                                                        value="{{ old('slug') }}"
                                                                        id="slug{{ $key }}"
                                                                        class="form-control slug" required>
                                                                </div>
                                                                @if ($errors->has($locale . '.slug'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.slug') }}</span>
                                                                @endif

                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $("#title" + {
                                                                            {
                                                                                $key
                                                                            }
                                                                        }).
                                                                        on('keyup', function() {
                                                                            var Text = $(this).val();
                                                                            Text = Text.toLowerCase();
                                                                            Text = Text.replace(/[^a-zA-Z0-9ء-ي]+/g, '-');
                                                                            $("#slug" + {
                                                                                {
                                                                                    $key
                                                                                }
                                                                            }).
                                                                            val(Text);
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
                                                                    <textarea id="description{{ $key }}" name="{{ $locale }}[description]">   </textarea>


                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('description{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>


                                                                    {{-- {!!  $service_category->transNow->description  !!} --}}


                                                                    @if ($errors->has($locale . '.description'))
                                                                        <span
                                                                            class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                                    @endif
                                                                </div>

                                                            </div>






                                                            <br>
                                                            <br>
                                                            <br>
                                                            <!--------------------------start middle page ------------------------>
                                                            {{-- middle_title ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('service_categories.middle_title') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">

                                                                    <input class="form-control"
                                                                        value="{{ old($locale . '.middle_title') }}"
                                                                        name="{{ $locale }}[middle_title]">
                                                                </div>
                                                                @if ($errors->has($locale . '.middle_title'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.middle_title') }}</span>
                                                                @endif
                                                            </div>


                                                            {{-- middle_content ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('service_categories.middle_content') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">

                                                                    <textarea class="form-control" id="middle_content{{ $key }}" name="{{ $locale }}[middle_content]">
                                                                {{ old($locale . '.middle_content') }}
                                                                </textarea>


                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('middle_content{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>


                                                                </div>
                                                                @if ($errors->has($locale . '.middle_content'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.middle_content') }}</span>
                                                                @endif
                                                            </div>
                                                            <!----------end middle page ------------------------------------------>



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
                                                        @php $trans_title = $service_category->trans()->where('locale' , $locale)->first() @endphp
                                                        @if ($trans_title)
                                                            {{-- meta info  ------------------------------------------------------------------------------------- --}}


                                                            {{-- meta_title_ ------------------------------------------------------------------------------------- --}}
                                                            <div class="row mb-3">
                                                                <label for="example-text-input"
                                                                    class="col-sm-2 col-form-label">{{ trans('admin.meta_title_in') . trans('lang.' . Locale::getDisplayName($locale)) }}</label>
                                                                <div class="col-sm-10">
                                                                    <input class="form-control" type="text"
                                                                        name="{{ $locale }}[meta_title]"
                                                                        value="{{ $trans_title->meta_title }}"
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
                                                                        class="form-control description"> {{ $trans_title->meta_desc }} </textarea>
                                                                    {{-- {!! $service_category->transNow->meta_desc !!} --}}

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
                                                                    <textarea name="{{ $locale }}[meta_key]" class="form-control description"> {{ $trans_title->meta_key }} </textarea>
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
                                                                        name="{{ $locale }}[slug]" value=""
                                                                        id="slug{{ $key }}"
                                                                        class="form-control slug" required>
                                                                </div>
                                                                @if ($errors->has($locale . '.slug'))
                                                                    <span
                                                                        class="missiong-spam">{{ $errors->first($locale . '.slug') }}</span>
                                                                @endif

                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $("#title" + {
                                                                            {
                                                                                $key
                                                                            }
                                                                        }).
                                                                        on('keyup', function() {
                                                                            var Text = $(this).val();
                                                                            Text = Text.toLowerCase();
                                                                            Text = Text.replace(/[^a-zA-Z0-9ء-ي]+/g, '-');
                                                                            $("#slug" + {
                                                                                {
                                                                                    $key
                                                                                }
                                                                            }).
                                                                            val(Text);
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
                                                                        value="" id="title{{ $key }}">
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
                                                                        class="form-control description">   </textarea>


                                                                    <script type="text/javascript">
                                                                        CKEDITOR.replace('meta_description{{ $key }}', {
                                                                            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                                            filebrowserUploadMethod: 'form'
                                                                        });
                                                                    </script>


                                                                    {{-- {!! $service_category->transNow->meta_desc !!} --}}

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
                                                                    <textarea name="{{ $locale }}[meta_key]" class="form-control description">   </textarea>
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




                                    {{-- <div class="accordion mt-4 mb-4 bg-danger" id="accordionExample_image_old">
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
                                                    <div class="container">
                                                        <div class="row">
                                                          @foreach ($imagesLandscape as $image)
                                                            <div class="col-6 col-md-4 col-lg-3 mb-4">
                                                              <div class="img_layer position-relative border p-2 rounded">
                                                                <img src="{{ asset($image->pathInView('service_category')) }}" class="img-fluid item rounded" alt="{{ __('messages.gallery_image') }}" />
                                                      
                                                                <div class="overlay"></div>
                                                      
                                                                <div class="text-center mt-2">
                                                                  <a class="btn btn-outline-danger btn-sm"
                                                                     href="{{ \LaravelLocalization::localizeURL(route('admin.service.gallery.delete', $image->id)) }}"
                                                                     onclick="return confirm('{{ __('messages.are_you_sure') }}')">
                                                                    <i class="fa fa-trash"></i> 
                                                                  </a>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          @endforeach
                                                        </div>
                                                      </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div> --}}

                                             <template id="following-template">
                                        <div class="following mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label>@lang('admin.following_image')</label>
                                                    <input type="file" name="new_following[__INDEX__][image]"
                                                        class="form-control" />
                                                </div>
                                                @foreach ($languages as $lang)
                                                    <div class="col-6">
                                                        <label>
                                                            @lang('admin.following_title_in') {{ trans('lang.' . $lang) }}
                                                        </label>
                                                        <input type="text"
                                                            name="new_following[__INDEX__][{{ $lang }}][title]"
                                                            class="form-control" />
                                                    </div>
                                                    <div class="col-6">
                                                        <label>
                                                            @lang('admin.following_description_in') {{ trans('lang.' . $lang) }}
                                                        </label>
                                                        <textarea name="new_following[__INDEX__][{{ $lang }}][description]" class="form-control"></textarea>
                                                    </div>
                                                @endforeach
                                                <div class="col-12 mt-2">
                                                    <button type="button"
                                                        class="btn btn-danger remove_following form-control">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </template>

                                    {{-- followings --}}
                                    <div class="accordion mt-4 mb-4" id="accordionFollowing">
                                        <div class="accordion-item border rounded">
                                            <h2 class="accordion-header" id="headingFollowing">
                                                <button class="accordion-button fw-medium" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFollowing"
                                                    aria-expanded="true" aria-controls="collapseFollowing">
                                                    @lang('admin.following')
                                                </button>
                                            </h2>
                                            <div id="collapseFollowing" class="accordion-collapse collapse show mt-3"
                                                aria-labelledby="headingFollowing" data-bs-parent="#accordionFollowing">
                                                <div class="accordion-body">
                                                    <div id="followings_section">
                                                        @foreach ($service_category->followings as $following)
                                                            <div class="following mb-3">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label>@lang('admin.following_image')</label>
                                                                        <img src="{{ asset($following->image) }}"
                                                                            style="width:100px;" />
                                                                        <input type="file"
                                                                            name="following[{{ $following->id }}][image]"
                                                                            class="form-control" />
                                                                    </div>
                                                                    @foreach ($languages as $lang)
                                                                        <div class="col-6">
                                                                            <label>
                                                                                @lang('admin.following_title_in')
                                                                                {{ trans('lang.' . $lang) }}
                                                                            </label>
                                                                            <input type="text"
                                                                                name="following[{{ $following->id }}][{{ $lang }}][title]"
                                                                                value="{{ $following->translate($lang)->title ?? '' }}"
                                                                                class="form-control" />
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label>
                                                                                @lang('admin.following_description_in')
                                                                                {{ trans('lang.' . $lang) }}
                                                                            </label>
                                                                            <textarea name="following[{{ $following->id }}][{{ $lang }}][description]]" class="form-control">{{ $following->translate($lang)->description ?? '' }}</textarea>
                                                                        </div>
                                                                    @endforeach
                                                                    <div class="col-12 mt-2">
                                                                        <a class="btn btn-outline-danger btn-sm"
                                                                            href="{{ route('admin.service.following.delete', $following->id) }}"
                                                                            onclick="return confirm('{{ __('messages.are_you_sure') }}')">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </div>
                                                        @endforeach

                                                        <div id="new_followings"></div>

                                                        <button type="button" class="btn btn-success form-control mt-3"
                                                            id="add_following">
                                                            @lang('admin.add_following')
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    @if (
                                        $service_category->galleryGroup &&
                                            $service_category->galleryGroup->images &&
                                            $service_category->galleryGroup->images->count())
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
                                                                @forelse($service_category->galleryGroup->images as $image)
                                                                    <div class="col-2">
                                                                        <img style="width: 100px; height:100px"
                                                                            src="{{ $image->pathInView('service_category') }}">
                                                                        <h4>{{ $image->title }} </h4>


                                                                        <h6> @lang('service_categories.sort')
                                                                            : {{ $image->sort }} </h6>
                                                                        <a class="btn btn-outline-danger btn-sm"
                                                                            href="{{ \LaravelLocalization::localizeURL(route('admin.service.gallery.delete', $image->id)) }}">

                                                                            <i class="fa fa-trash"></i></a>
                                                                        <br>


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
                                                        {{--                                                        <label>@lang('admin.group_title_ar')</label> --}}
                                                        {{--                                                        <input type="text" --}}
                                                        {{--                                                               value="{{$service_category->galleryGroup->trans->title ?? ''}}" --}}
                                                        {{--                                                               name="group_title"> --}}
                                                        {{--                                                        <label>@lang('admin.group_title_en')</label> --}}
                                                        {{--                                                        <input type="text" --}}
                                                        {{--                                                               value="{{$service_category->galleryGroup->title_en ?? ''}}" --}}
                                                        {{--                                                               name="group_title_en"> --}}
                                                        @foreach (config('translatable.locales') as $lang)
                                                            {{--                                                            @if ($service_category->galleryGroup?->translate($lang) && $service_category->galleryGroup?->translate($lang)->id) --}}
                                                            @if (
                                                                $service_category->galleryGroup &&
                                                                    $service_category->galleryGroup->translate($lang) &&
                                                                    $service_category->galleryGroup->translate($lang)->id)
                                                                <input type="hidden"
                                                                    value="{{ $service_category->galleryGroup->translate($lang)?->id }}"
                                                                    name="gallery[id]">

                                                                <div class=" mb-3 col-sm-2 col-form-label">

                                                                    <label>@lang('admin.group_title_' . $lang)</label>
                                                                </div>

                                                                <div class=" mb-3 col-sm-10 ">
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $service_category->galleryGroup->translate($lang)?->title }}"
                                                                        name="gallery[{{ $lang }}][title]">
                                                                </div>
                                                            @else
                                                                {{--                                                                <input type="hidden" --}}
                                                                {{--                                                                       value="{{$category->galleryGroup->translate($lang) ?->id  }}" --}}
                                                                {{--                                                                       name="gallery[id]"> --}}

                                                                <div class=" mb-3 col-sm-2 col-form-label">

                                                                    <label>@lang('admin.group_title_' . $lang)</label>
                                                                </div>

                                                                <div class=" mb-3 col-sm-10 ">
                                                                    <input type="text" class="form-control"
                                                                        value=""
                                                                        name="gallery[{{ $lang }}][title]">
                                                                </div>
                                                            @endif

                                                            {{--                                                            <div class=" mb-3 col-sm-2 col-form-label"> --}}
                                                            {{--                                                                <label>@lang('admin.group_title_' . $lang)</label> --}}
                                                            {{--                                                            </div> --}}

                                                            {{--                                                            <div class=" mb-3 col-sm-10 "> --}}
                                                            {{--                                                                <input type="text" --}}
                                                            {{--                                                                       class="form-control" --}}
                                                            {{--                                                                       value="{{$service_category->galleryGroup?->translate($lang) ?->title}}" --}}
                                                            {{--                                                                       name="gallery[{{ $lang }}][title]"> --}}
                                                            {{--                                                            </div> --}}
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

                                                    @if (@$service_category->image != null)
                                                        <div class="col-12">
                                                            <div class="row mb-3">
                                                                <div class="col-sm-12">
                                                                    <a href="{{ asset($service_category->pathInView()) }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset($service_category->pathInView()) }}"
                                                                            alt="" style="width:100%">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-specialty"
                                                                class="col-sm-4 col-form-label">
                                                                @lang('service_categories.image')</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="file"
                                                                    placeholder="@lang('service_categories.image')" name="image">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- info image --}}

                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label class="col-sm-4 col-form-label">
                                                                @lang('admin.info_image')
                                                            </label>
                                                            <div class="col-sm-8">
                                                                @if ($service_category->info_image)
                                                                    <img src="{{ asset($service_category->infoImageInView()) }}"
                                                                        style="width:100px;" />
                                                                @endif
                                                                <input class="form-control" type="file"
                                                                    name="info_image" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- info image --}}


                                                    {{-- sort ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <div class="row mb-3">
                                                            <label for="example-number-address"
                                                                class="col-sm-4 col-form-label">
                                                                @lang('admin.sort')</label>
                                                            <div class="col-sm-8">
                                                                <input class="form-control" type="number"
                                                                    placeholder="@lang('admin.sort')" name="sort"
                                                                    required value="{{ $service_category->sort ?? 0 }}">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- feature ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-4 col-form-label"
                                                            for="available">{{ trans('admin.feature') }}</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-check form-switch" name="feature"
                                                                type="checkbox" id="switch1" switch="success"
                                                                {{ $service_category->feature == 1 ? 'checked' : '' }}
                                                                value="1">
                                                            <label class="form-label" for="switch1"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                    </div>
                                                    {{-- Status ------------------------------------------------------------------------------------- --}}
                                                    <div class="col-12">
                                                        <label class="col-sm-4 col-form-label"
                                                            for="available">{{ trans('admin.status') }}</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-check form-switch" name="status"
                                                                type="checkbox" id="switch3" switch="success"
                                                                {{ $service_category->status == 1 ? 'checked' : '' }}
                                                                value="1">
                                                            <label class="form-label" for="switch3"
                                                                data-on-label=" @lang('admin.yes') "
                                                                data-off-label=" @lang('admin.no')"></label>
                                                        </div>
                                                    </div>



                                                    {{--                                                    <div class="row mb-3"> --}}
                                                    {{--                                                        <label for="example-text-input" --}}
                                                    {{--                                                               class="col-sm-2 col-form-label">{{ trans('service_categories.occasions')   }}</label> --}}
                                                    {{--                                                        <div class="col-sm-10"> --}}
                                                    {{--                                                            --}}{{--                                                            <input class="form-control" type="number" --}}
                                                    {{--                                                            --}}{{--                                                                   name="status" --}}
                                                    {{--                                                            --}}{{--                                                                   value="{{old('status')}}"> --}}


                                                    {{--                                                            <select multiple class="form-select form-select-sm select2" --}}
                                                    {{--                                                                    name="occasions[]"> --}}
                                                    {{--                                                                <option value="" selected --}}
                                                    {{--                                                                        disabled> {{ trans('service_categories.occasions') }}</option> --}}
                                                    {{--                                                                @forelse($occasions as $key1 => $val1) --}}


                                                    {{--                                                                    @forelse($service_category->occasions as $key2 => $val2) --}}
                                                    {{--                                                                        @if ($val1->id === $val2->id) --}}
                                                    {{--                                                                            <option --}}
                                                    {{--                                                                                value="{{$val1->id}}" selected> --}}
                                                    {{--                                                                                {{   isset($val1->transNow->title)  ?  $val1->transNow->title : ''}} --}}
                                                    {{--                                                                            </option> --}}
                                                    {{--                                                                        @else --}}
                                                    {{--                                                                            <option --}}
                                                    {{--                                                                                value="{{$val1->id}}" {{ old('occasions.' . $key1) == $val1->id   ? 'selected' : '' }}> --}}
                                                    {{--                                                                                {{   isset($val1->transNow->title)  ?  $val1->transNow->title : ''}} --}}
                                                    {{--                                                                            </option> --}}

                                                    {{--                                                                        @endif --}}
                                                    {{--                                                                            <option --}}
                                                    {{--                                                                                value="{{$val1->id}}" {{ old('occasions.' . $key1) == $val1->id   ? 'selected' : '' }}> --}}
                                                    {{--                                                                                {{   isset($val1->transNow->title)  ?  $val1->transNow->title : ''}} --}}
                                                    {{--                                                                            </option> --}}

                                                    {{--                                                                    @empty --}}
                                                    {{--                                                                        <option --}}
                                                    {{--                                                                            value="{{$val1->id}}" {{ old('occasions.' . $key1) == $val1->id   ? 'selected' : '' }}> --}}
                                                    {{--                                                                            {{   isset($val1->transNow->title)  ?  $val1->transNow->title : ''}} --}}
                                                    {{--                                                                        </option> --}}

                                                    {{--                                                                    @endforelse --}}
                                                    {{--                                                                @empty --}}
                                                    {{--                                                                    <option --}}
                                                    {{--                                                                        value="{{$val1->id}}" {{ old('occasions.' . $key1) == $val1->id   ? 'selected' : '' }}> --}}
                                                    {{--                                                                        {{   isset($val1->transNow->title)  ?  $val1->transNow->title : ''}} --}}
                                                    {{--                                                                    </option> --}}

                                                    {{--                                                                @endforelse --}}

                                                    {{--                                                            </select> --}}

                                                    {{--                                                        </div> --}}
                                                    {{--                                                        @if ($errors->has($locale . '.status')) --}}
                                                    {{--                                                            <span --}}
                                                    {{--                                                                class="missiong-spam">{{ $errors->first($locale . '.status') }}</span> --}}
                                                    {{--                                                        @endif --}}
                                                    {{--                                                    </div> --}}

                                                    {{--                                                    <a href="{{url('/admin/pages/' .  $service_category->page->id . '/' .'edit?service=123')}}">page</a> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-3 text-end">
                                    <div>
                                        <button type="submit"
                                            class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">@lang('button.submit')</button>

                                        {{--                                        <a href="{{ route('admin.service.index') }}" --}}
                                        {{--                                           class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a> --}}
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
            $('#add_images_section').on('click', function() {

                $('#images_section').append(
                    `
                    <div class="images ">
                        <div class="row">
                            <div class="col-12">
                                    <label for="example-number-input"  > @lang('admin.image'):</label>
                                <input type="file" name="gallery_image[]"   class="form-control" required>
                            </div>
                            <div class="col-3">
                                <label for="example-number-input"  > @lang('admin.sort'):</label>
                                <input type="number" name="gallery_sort[]" required value="0"  class="form-control"  >
                            </div>
                            {{--                            <div class="col-3"> --}}
                            {{--    <label for="example-number-input"  > @lang("admin.image_title_ar"):</label> --}}
                            {{--    <input type="text" name="gallery_title[]"  class="form-control"  > --}}
                            {{-- </div> --}}


                              {{-- <div class="col-3"> --}}
                              {{--  <label for="example-number-input"  > @lang("admin.image_title_en"):</label> --}}
                              {{--  <input type="text" name="gallery_title_en[]"  class="form-control"  > --}}
                              {{--  </div> --}}



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
            })
        });
    </script>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let followingIndex = 0;
                const container = document.getElementById('new_followings');
                const template = document.getElementById('following-template').innerHTML;

                document.getElementById('add_following').addEventListener('click', function() {
                    let html = template.replace(/__INDEX__/g, followingIndex);
                    container.insertAdjacentHTML('beforeend', html);
                    followingIndex++;
                });

                container.addEventListener('click', function(e) {
                    if (e.target.closest('.remove_following')) {
                        e.target.closest('.following').remove();
                    }
                });
            });
        </script>
    @endpush

    {{-- <script>
        $(document).ready(function() {
            var followingIndex = 0;
            $('#add_following').on('click', function() {
                var html = `
            <div class="following mb-3">
                <div class="row">
                    <div class="col-12">
                        <label>@extends('admin.app')</label>
                        <input type="file" name="new_following[${followingIndex}][image]" class="form-control" />
                    </div>
                    @foreach ($languages as $lang)
                        <div class="col-6">
                            <label>@method('PUT') {{ trans('lang.' . $lang) }}</label>
                            <input type="text" name="new_following[${followingIndex}][{{ $lang }}][title]" class="form-control" />
                        </div>
                        <div class="col-6">
                            <label>@lang('admin.description_in') {{ trans('lang.' . $lang) }}</label>
                            <textarea name="new_following[${followingIndex}][{{ $lang }}][description]" class="form-control"></textarea>
                        </div>
                    @endforeach
                    <div class="col-12 mt-2">
                        <button type="button" class="btn btn-danger remove_following form-control"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <hr>
            </div>
        `;
                $('#new_followings').append(html);
                followingIndex++;
            });

            $('#new_followings').on('click', '.remove_following', function() {
                $(this).closest('.following').remove();
            });
        });
    </script> --}}

    {{-- <script> --}}
    {{-- --}}{{-- $(document).ready(function () { --}}
    {{-- --}}{{-- $('#add_images_section').on('click', function () { --}}
    {{-- --}}
    {{-- --}}{{-- $('#images_section').append( --}}
    {{-- --}}{{-- ` --}}
    {{-- --}}{{-- <div class="images "> --}}
    {{-- --}}{{-- <div class="row"> --}}
    {{-- --}}{{-- <div class="col-12"> --}}
    {{-- --}}{{-- <label for="example-number-input"  > @lang("admin.image"):</label> --}}
    {{-- --}}{{-- <input type="file" name="gallery_image[]"   class="form-control" required> --}}
    {{-- --}}{{-- </div> --}}
    {{-- --}}{{-- <div class="col-3"> --}}
    {{-- --}}{{-- <label for="example-number-input"  > @lang("admin.sort"):</label> --}}
    {{-- --}}{{-- <input type="number" name="gallery_sort[]"  class="form-control"  > --}}
    {{-- --}}{{-- </div> --}}
    {{-- --}}{{-- <div class="col-3"> --}}
    {{-- --}}{{-- <label for="example-number-input"  > @lang("admin.image_title"):</label> --}}
    {{-- --}}{{-- <input type="number" name="gallery_title[]"  class="form-control"  > --}}
    {{-- --}}{{-- </div> --}}
    {{-- --}}
    {{-- --}}{{-- <div class="col-3"> --}}
    {{-- --}}{{-- <label for="example-number-input"  > @lang("admin.feature"):</label> --}}
    {{-- --}}{{-- <input type="number" name="gallery_feature[]"  class="form-control"  > --}}
    {{-- --}}{{-- </div> --}}
    {{-- --}}
    {{-- --}}{{-- <div class="col-12 mt-3"> --}}
    {{-- --}}{{-- <button class="btn btn-danger delete_img form-control"><i class="fa fa-trash"></i></button> --}}
    {{-- --}}{{-- </div> --}}
    {{-- --}}{{-- </div> --}}
    {{-- --}}{{-- <hr> --}}
    {{-- --}}{{-- </div> --}}
    {{-- --}}{{-- ` --}}
    {{-- --}}{{-- ) --}}
    {{-- --}}
    {{-- --}}{{-- }); --}}
    {{-- --}}
    {{-- --}}
    {{-- --}}{{-- $('#images_section').on('click', '.delete_img', function (e) { --}}
    {{-- --}}{{-- $(this).parent().parent().parent().remove(); --}}
    {{-- --}}{{-- }) --}}
    {{-- --}}{{-- }); --}}
    {{-- </script> --}}


@endsection
