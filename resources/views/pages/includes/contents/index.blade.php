{{-- WELCOME MESSAGE (HEROES) --}}
<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Selamat Datang di Berita Kini</h1>
            <p class="lead">Untuk melihat berita dari beberapa sumber yang anda inginkan, klik sumber yang anda inginkan melalui header di atas.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                <a href="/{{ $random[0] }}" type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold show-preloader">Acak Sumber</a>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg" style="border-radius: 8px 0 8px 0">
            <img class="" src="{{ asset('images/landing.png') }}" alt="" width="800">
        </div>
    </div>
</div>
