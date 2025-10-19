  
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
            <li><span class="icon">📍</span> <a class="nv-noninteractive" href="#">{{ $settings->getItem('address') }}</a></li>
            <li><span class="icon">✉️</span> <a href="mailto:{{ $settings->getItem('email') }}">{{ $settings->getItem('email') }}</a></li>
            <li><span class="icon">📞</span> <a href="tel:{{ $settings->getItem('mobile') }}">{{ $settings->getItem('mobile') }}</a></li>
          </ul>

          <div class="contactDiv">@lang('home.social')</div>
          <div class="socials">
            <a class="chip" href="{{ $settings->getItem('facebook') }}">@lang('home.facebook')</a>
            <a class="chip" href="{{ $settings->getItem('instagram') }}">@lang('home.instagram')</a>
            <a class="chip" href="{{ $settings->getItem('tiktok') }}">@lang('home.tiktok')</a>
            <a class="chip" href="{{ $settings->getItem('linkedin') }}">@lang('home.linkedin')</a>
          </div>
        </div>

        <!-- right: form -->
        <div class="card">
          <form class="form-wrap" action="{{ route('site.contact.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-row">
              <label class="label">@lang('home.your_message')</label>
              <textarea class="textarea" name="message" placeholder="@lang('home.your_message')"></textarea>
            </div>
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
            <button class="btn" type="submit">@lang('home.send')</button>
          </form>
        </div>
      </div>
    </div>
  </section>


