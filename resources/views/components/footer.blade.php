 <!-- =============== FOOTER =============== -->
 <footer class="footerClass" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
     <div class="footercard">
         <div class="footer">

             <!-- LEFT: brand + contact + socials + career -->
             <div>
                 <!-- Logo + name -->
                 <div class="logoContent">
                     <img class="LogoImg"
                         src="{{ asset($settings->getItem(app()->getLocale() == 'en' ? 'logo_en' : 'logo_ar')) }}"
                         alt="Tetra Pharma">
                 </div>

                 <!-- Contact blocks -->
                 <ul class="ContactDiv">
                     <li class="ContactLi">
                         <span class="color_blue">📍</span>
                         <span>{{ $address }}</span>
                     </li>
                     <li class="lispan">
                         <span class="color_blue">📞</span>
                         <a href="tel:{{ $mobile }}"
                             style="color:#334155; text-decoration:none;">{{ $mobile }}</a>
                     </li>
                     <li class="lispan">
                         <span class="color_blue">✉️</span>
                         <a href="mailto:info@tetrapharma.com" class="Email">{{ $email }}</a>
                     </li>
                 </ul>
                 <!-- Social -->
                 <div class="social">
                     <div class="socialDiv color_blue">@lang('home.social')</div>
                     <div class="socials">
                         <a class="Social1 color_blue" href="{{ $facebookLink }}">@lang('home.facebook')</a>
                         <a class="Social2 color_blue" href="{{ $instagramLink }}">@lang('home.instagram')</a>
                         <a class="Social3 color_blue" href="{{ $tiktokLink }}">@lang('home.tiktok')</a>
                         <a class="Social4 color_blue" href="{{ $linkedinLink }}">@lang('home.linkedin')</a>
                     </div>
                 </div>
                 <!-- Career CTA -->
                 <div class="career">
                     <div class="career1">@lang('job.we_are_hiring')</div>
                     <a href="{{ route('site.jobs.index') }}" class="btn-career">@lang('job.apply')</a>
                 </div>
             </div>
             <!-- RIGHT: Google map -->
             <div>
                 <div class="map">
                     <section class="map1">
                         <div class="map2">
                             <div class="map3">
                                 <iframe class="Iframe" title="Tetra pharma Ltd. location" src="{{ $maps }}"
                                     loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen>
                                 </iframe>
                             </div>
                             <div class="google">
                                 <a class="google_Link" href="{{ $maps }}" target="_blank">
                                     @lang('home.google_map')
                                 </a>
                             </div>
                         </div>
                     </section>
                 </div>
             </div>
         </div>
     </div>
     <!-- bottom bar -->
     <div class="bottomBar">
         <div class="bottom1">
             <span class="footerBottom">© <span id="y_foot">2025</span>@lang( 'home.all_rights_reserved')</span>
             <div class="Footerbtm"></div>
         </div>
     </div>
 </footer>
 <!-- ============ /FOOTER ============ -->
