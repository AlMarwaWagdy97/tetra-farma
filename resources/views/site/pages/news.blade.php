 <!-- news -->
 <section class="latestnews" id="latest-news" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
     <div class="news">
         <div class="newstitle">
             <h2 class="newsh2">@lang('site.latest_news')</h2>
             <div class="DivNews">
             </div>
         </div>
         <div class="news-grid gridNews">
             @forelse ($news as $new)
                 <article class="news-card newcard">
                     <a href="#" class="newA">
                         <img class="newImg" src="{{ asset($new->image) }}" alt="Selenium ACE new pack size">
                         <div class="new1">
                             <time class="newtime" datetime="2025-09-18">{{ $new->created_at }}</time>
                             <h3 class="newh3">
                                 {{ $new->title }}
                             </h3>
                             <a href="{{ route('site.news.show', $new->id) }}') }}" class="newbtn">
                                 <span class="NewBtn">
                                     @lang('site.read_more') </span>
                             </a>
                         </div>
                     </a>
                 </article>
             @empty
                 <h3>@lang('site.no_news')</h3>
             @endforelse

         </div>


         <div class="viewall" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'ltr' }}">
             <a class="viewnews" href="{{ route('site.news.index') }}">
                 <span class="viewnewstext">@lang('site.view_all_news')</span>
                 <span class="viewnewsspan">→</span>
             </a>
         </div>

     </div>


 </section>
