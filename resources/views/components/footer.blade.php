<div class="Footer my-4 p-5">
    <div class="container">
        <div class="row cardss">
            @foreach ($cards as $key => $card)
               <div class="col-6 col-lg-3 mb-4 footer-card">
                    <div class="cards h-100">
                        <div class="card-body text-center card-trigger" style="cursor: pointer;" data-bs-toggle="modal"
                            data-bs-target="#cardModal" data-title="{{ $card['title'] }}"
                            data-description="{{ $card['description'] }}">
                            <img src="{{ asset($card['image']) }}" alt="{{ $card['title'] }}" class="img-fluid mb-2"
                                style="max-width: 80px;">
                            <h5 class="card-title mb-0">{{ $card['title'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr>







        <div class="secand-row row mt-3">
            <div class="col-12 col-lg-3 mt-5">
                <div class="content text-center mx-auto">
                    <h4>GET CONTENT</h4>
                    <a href="{{ $facebookLink }}" target="_blank" class="me-3 main-color">
                        <i class="fa-brands fa-square-facebook"></i>
                    </a>
                    <a href="{{ $instagramLink }}" target="_blank" class="me-3 main-color">
                        <i class="fa-brands fa-square-instagram"></i>
                    </a>
{{--                   
                    <a href="{{ $tiktokLink }}" target="_blank" class="me-3 main-color">
                        <i class="fa-brands fa-square-tiktok"></i>
                    </a> --}}
                </div>
            </div>
            <div class="col-12 col-lg-3 mt-5">
                <div class="Links text-center">
                    <ul>
                        <li>Links</li>
                        @foreach ($footerLinks as $link)
                            <li>
                                <a href="{{ $link->type === 'static' && $link->url ? url($link->url) : ($link->dynamic_url ? url($link->dynamic_url) : '#') }}"
                                    style="color: #000000;">
                                    {{ $link->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-3 mt-5 text-center">
                <h4>{{ $footerTitle }}</h4>
                <p>{{ $footerDescription }}</p>
            </div>
            <div class="col-12 col-lg-3 mt-5 text-center">
                <h4> {{ __('messages.subscribe') }} </h4>
                <form class="d-flex" role="search" method="POST" action="{{ route('site.subscribe.store') }}">
                    @csrf
                    <input class="form-control me-2" type="email" name="email" placeholder="Enter your email"
                        aria-label="Search" required />
                    <button class="btn btn-single me-3" type="submit">Search</button>
                    @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger mt-2">
                            {{ session('error') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cardModal" tabindex="-1" aria-labelledby="cardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardModalLabel">—</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="cardModalDescription">—</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('cardModal');
        modalEl.addEventListener('show.bs.modal', function(event) {
            // العنصر الذي نقر عليه
            const trigger = event.relatedTarget;
            // اقرأ البيانات المرسلة
            const title = trigger.getAttribute('data-title');
            const description = trigger.getAttribute('data-description');

            // حدّد العناصر داخل الـ Modal
            modalEl.querySelector('.modal-title').textContent = title;
            modalEl.querySelector('#cardModalDescription').textContent = description;
        });
    });
</script>
