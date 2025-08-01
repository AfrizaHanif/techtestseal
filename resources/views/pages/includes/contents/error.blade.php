{{-- CONNECTION ERROR MESSAGE (HEROES) --}}
<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg bg-danger text-white">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fw-bold lh-1 text-white">Koneksi Error</h1>
            <p class="lead">{{ $error }}. Silahkan refresh halaman / situs ini beberapa saat lagi.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                <a href="{{ Request::url() }}" type="button" class="btn btn-light btn-lg px-4 me-md-2 fw-bold">
                    <i class="bi bi-arrow-clockwise"></i>
                    Refresh
                </a>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg" style="border-radius: 8px 0 8px 0">
            <img class="" src="{{ asset('images/landing.png') }}" alt="" width="800">
        </div>
    </div>
</div>
