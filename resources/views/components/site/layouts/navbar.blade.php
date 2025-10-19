<header id="mainNav" class="site-nav overlay {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}
      @if (Route::is('site.products.show') ||
        Route::is('site.products.index') ||
        Route::is('site.contact-us') ||
        Route::is('site.faq-questions') ||
        Route::is('site.about-us') ||
        Route::is('site.news.index') ||
        Route::is('site.news.show') ||
        Route::is('site.jobs.index') ||
        Route::is('site.jobs.show') ||
        Route::is('site.jobs.apply') ||
        Route::is('site.site.blogs.index') ||
        Route::is('site.site.blogs.show'))  othernav navbar-shadow @endif
    
    " data-overlay="true" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="nav-inner">
        <div class="logo">
            <a class="navImg-a" href="{{ route('site.home') }}">
                <img class="navImg"
                    src="{{ asset($settings->getItem(app()->getLocale() == 'en' ? 'logo_en' : 'logo_ar')) }}"
                    alt="Tetra Pharma">
            </a>
        </div>
        <nav class="links" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" id="mainNav">
            @php
                $items = Cache::get('menus');
                if ($items == null) {
                    $items = Cache::rememberForever('menus', function () {
                        return App\Models\Menue::with('trans')->orderBy('sort', 'ASC')->main()->active()->get();
                    });
                }
            @endphp
            @include('site.layouts.menuItem')
            <a class="career_btn" href="career.html" target="_blank"> {{ __(key: 'site.career') }} </a>
        </nav>
        <div class="right">
             <div class="dropdown"> 
                <a class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-globe main-color m-0 p-0 "></i>
                    {{ strtoupper(app()->getLocale()) }}
                </a>
                <ul class="dropdown-menu main-color-bg">
                    @foreach ($locals as $lang)
                        <li class="text-center ">
                            <a class="dropdown-item"
                                href=" {{ LaravelLocalization::getLocalizedURL($lang)}} ">  
                                {{ $lang == 'en' ? 'English' : 'العربية' }} 
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- Burger -->
            <button class="burger" aria-controls="offcanvas" aria-expanded="false" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>

    <aside id="offcanvas" class="offcanvas" aria-hidden="true">
        <nav class="mobile-links" aria-label="Mobile menu">
            @include('site.layouts.menuItem')
            <a class="career_btn" href="./career page/career.html" target="_blank"> {{ __(key: 'site.career') }} </a>
        </nav>

        <div class="mobile-actions">
            <a class="career_btn" href="career.html" target="_blank"> {{ __(key: 'site.career') }} </a>
        </div>
    </aside>

    <div class="backdrop" hidden></div>


</header>

<style>
    .offcanvas {
        position: fixed;
        bottom: 0;
        z-index: 2000 !important;
        display: flex;
        flex-direction: column;
        max-width: 100%;
        visibility: visible;
        background-color: #fff;
        background-clip: padding-box;
        outline: 0;
        transition: transform .3s ease-in-out;
    }
    li a {
        text-decoration: none;
        color: black !important;
        padding: 10px 15px;
        display: block;
    }
    #mainNav .links a {
        font-size: 17px !important;
    }
    #mainNav .links .career_btn{
        color: #fff !important;
        background: #0F5DA8 !important;
    
    }
    #mainNav .links a:hover , #mainNav .links a:focus-visible {
    color: #d6103d;
}

.site-nav .nav-inner {
    max-width: 1180px !;
    margin: 0 auto;
    height: 68px !important;
    padding: 0 16px;
    display: flex;
    align-items: center;
    gap: 16px !important;
    overflow: visible;
}
.navImg {
    height: 50px !important;
    width: auto !important;
}
.dropdown  {
    font-size: 22px !important;
}
@media (min-width: 960px) {
    #mainNav .navImg-a {
        margin: -60px !important;
}


}
.othernav{
    position: fixed !important;
  background:#FFFFFF !important;
  a{
        color: #1157a4 !important;
  }
  .links a{
    color: #1157a4 !important;
  }
  .site-nav.overlay:not(.scrolled) .links a {
    color: #1157a4 !important;
}
  
}


</style>
