  
@php
  $settings = \App\Settings\SettingSingleton::getInstance();
@endphp
  <!-- ========== CONTACT SECTION ========== -->
  <section class="section hero con-section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
      <div class="grid">

        <!-- left: details -->
        <div class="card contact-left">
          <div class="bigline">
          @lang('home.questions')
          </div>

          <ul class="contact-list">
            <li class="d-flex align-items-center"> <span class="icon">📍</span> <a class="nv-noninteractive fw-bold" href="#">{{ $settings->getItem('address') }}</a></li>
            <li class="d-flex align-items-center"><span class="icon">✉️</span> <a class="fw-bold" href="mailto:{{ $settings->getItem('email') }}">{{ $settings->getItem('email') }}</a></li>
            <li class="d-flex align-items-center"><span class="icon">📞</span> <a class="fw-bold" href="tel:{{ $settings->getItem('mobile') }}">{{ $settings->getItem('mobile') }}</a></li>
          </ul>

          <div class="contactDiv">@lang('home.social')</div>
          <div class="socials">
            <a class="chip" href="{{ $settings->getItem('facebook') }}"><i><i class="fa-brands fa-facebook"></i></i></a>
            <a class="chip" href="{{ $settings->getItem('instagram') }}"><i><i class="fa-brands fa-instagram"></i></i></a>
            <a class="chip" href="{{ $settings->getItem('tiktok') }}"><i><i class="fa-brands fa-tiktok"></i></i></a>
            <a class="chip" href="{{ $settings->getItem('linkedin') }}"><i><i class="fa-brands fa-linkedin"></i></i></a>
          </div>
           <!-- RIGHT: Google map -->
             <div class="pt-3">
                 <div class="map">
                     <section class="map1">
                         <div class="map2">
                             <div class="map3">
                                 <iframe class="Iframe" title="Tetra pharma Ltd. location" src="{{ $settings->getItem('maps') }}"
                                     loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen>
                                 </iframe>
                             </div>
                             <div class="google">
                                 <a class="google_Link" href="{{ $settings->getItem('maps') }}" target="_blank">
                                     @lang('home.google_map')
                                 </a>
                             </div>
                         </div>
                     </section>
                 </div>
             </div>
        </div>

        <!-- right: form -->
        <div class="card">
          <form class="form-wrap" action="{{ route('site.contact.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
         
            <div class="form-row">
              <label class="label">@lang('home.full_name')</label>
              <input class="input" type="text" name="name"  placeholder="@lang('home.full_name')" />
            </div>
            <div class="form-row">
              <label class="label">@lang('home.phone')</label>
              <input class="input" type="number" name="phone"  placeholder="@lang('home.phone')" />
            </div>
            <div class="form-row">
              <label class="label">@lang('home.email')</label>
              <input class="input" type="email" name="email" placeholder="@lang('home.email')" />
            </div>
               <div class="form-row">
              <label class="label">@lang('home.your_message')</label>
              <textarea class="textarea" name="message" placeholder="@lang('home.your_message')"></textarea>
            </div>
            <button class="btn" type="submit">@lang('home.send')</button>
          </form>
        </div>
      </div>
    </div>
  </section>

<style>

</style>
