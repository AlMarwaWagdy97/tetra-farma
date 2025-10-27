<section dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container faq-wrap">
        <!-- Sidebar -->
        <aside class="faq-side">
            <h3>@lang('home.faq-index_h3')</h3>
            <p class="mini">@lang('home.faq-index_pp')</p>
            <div class="faq-cta">
                <a class="btn primary blue_btn" href="{{ route('site.contact-us')}}">@lang('home.contact')</a>
                <a class="btn light blue_btn" href="{{ route('site.site.blogs.index')}}">@lang('home.read')</a>
            </div>
        </aside>

        <!-- Main -->
            <div class="category">
            <!-- Filter chips -->
            <div class="faq-controls controls">
                <span class="chip  {{ $selectedCategory == 0 ? 'active': '' }}" data-tag="@lang('All')" wire:click="changeCategory(0)"> @lang('All')</span>
                @forelse ($categories as $category)
                    <span class="chip {{ $selectedCategory == $category->id ? 'active': '' }}" data-tag="{{ @$category->transNow->title }}" wire:click="changeCategory({{ $category->id }})"> {{ @$category->transNow->title }} </span>
                @empty
                <p>@lang('home.no_faq')</p>
                @endforelse
                
            </div>

            <div class="faq">
                @forelse ($faq_questions as $question)
                    <details data-tags="science,quality" open>
                        <summary><span class="dot"></span> {{ $question->question }}</summary>
                        <div class="content">
                            <p> {!! $question->answer !!}
                            </p>
                        </div>
                    </details>
                @empty
                    <p>@lang('home.no_faq')</p>
                @endforelse
            </div>

            
        </div>
    </div>
</section>