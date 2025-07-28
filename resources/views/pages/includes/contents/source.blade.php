{{-- BREADCRUMBS --}}
<div class="container my-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
            <li class="breadcrumb-item">
                <a class="link-body-emphasis" href="#">
                    <svg class="bi" width="16" height="16" aria-hidden="true"><use xlink:href="#house-door-fill"></use></svg>
                    <span class="visually-hidden">Beranda</span>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none" href="/{{ $selected_source }}">{{ ucfirst($selected_source) }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
            {{ ucfirst($selected_category) }}
            </li>
        </ol>
    </nav>
</div>

{{-- HEADLINES (CAROUSEL) --}}
<div id="carouselExample" class="carousel slide">
    <div class="carousel-indicators" data-bs-theme="dark">
        @foreach ($headlines as $head_key => $head_value)
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : '' }}" aria-label="Slide 1"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($headlines as $head_key => $head_value)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <div class="container col-xxl-8 px-4 py-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="{{ url($head_value['thumbnail']) }}" class="d-block mx-lg-auto rounded img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                        <p><b>Headline</b></p>
                        <h1 class="display-6 fw-bold text-body-emphasis lh-1 mb-3">{{ $head_value['title'] }}</h1>
                        <p class="lead">{{ $head_value['description'] }}</p>
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse(env($head_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                        </p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">
                                <i class="bi bi-arrow-up-right"></i>
                                Baca Selengkapnya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" data-bs-theme="dark">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" data-bs-theme="dark">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

{{-- BERITA TERPOPULER (FEATURES) --}}
<div class="container px-4 pt-5" id="hanging-icons">
    <h2 class="pb-2 border-bottom">Berita Terpopuler</h2>
    <div class="row g-4 pt-3 pb-5 row-cols-1 row-cols-lg-3">
        @foreach ($populars as $pop_key => $pop_value)
        <div class="col">
            <div class="row">
                <div class="col-5">
                    <img src="{{ url($pop_value['thumbnail']) }}" class="d-block mx-lg-auto rounded img-fluid" loading="lazy">
                </div>
                <div class="col-7">
                    <h3 class="fs-6 text-body-emphasis">{{ $pop_value['title'] }}</h3>
                    <p>
                        {{ ucfirst($selected_category) }} | {{ \Carbon\Carbon::parse(env($pop_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- REKOMENDASI UNTUK ANDA (CARDS) --}}
<div class="container px-4 py-3">
    <h2 class="pb-2 border-bottom">Rekomendasi Untuk Anda</h2>
    <div class="row row-cols-1 row-cols-md-4 g-4 pt-3">
        @foreach ($recommends as $json_key => $json_value)
        <div class="col">
            <div class="card h-100">
                <img src="{{ url($json_value['thumbnail']) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="/{{ $selected_source }}/{{ $selected_category }}/{{ $json_key }}" class="stretched-link"><h5 class="card-title">{{ $json_value['title'] }}</h5></a>
                    <p class="card-text">
                        {{ ucfirst($selected_category) }} | {{ \Carbon\Carbon::parse(env($json_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <br/>
    {{ $recommends->withQueryString()->links() }}
</div>
