{{-- NAVIGATON (BREADCRUMBS) --}}
<div class="container pt-3 my-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
            <li class="breadcrumb-item">
                <a class="link-body-emphasis show-preloader" href="/">
                    <svg class="bi" width="16" height="16" aria-hidden="true"><use xlink:href="#house-door-fill"></use></svg>
                    <span class="visually-hidden">Beranda</span>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none show-preloader" href="/{{ $selected_source }}">
                    @if (strlen(ucfirst($selected_source)) > 4)
                    {{ ucfirst($selected_source) }}
                    @else
                    {{ strtoupper($selected_source) }}
                    @endif
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
            {{-- {{ ucfirst($selected_category) }} --}}
            {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $selected_category)) }}
            </li>
        </ol>
    </nav>
</div>

{{-- HEADLINES (CAROUSEL) --}}
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        @foreach ($headlines as $head_key => $head_value)
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : '' }}" aria-label="Slide 1"></button>
        @endforeach
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="carousel-inner">
        @foreach ($headlines as $head_key => $head_value)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <div class="container col-xxl-8 px-4 py-5">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="{{ url($head_value['thumbnail']) }}" onerror="this.onerror=null; this.src='{{ asset('images/nopic.png') }}'" class="d-block mx-lg-auto rounded img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                        <p><b>Headline</b></p>
                        <h1 class="display-6 fw-bold text-body-emphasis lh-1 mb-3">{{ html_entity_decode($head_value['title']) }}</h1>
                        <p class="lead">{{ html_entity_decode($head_value['description']) }}</p>
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            {{ \Carbon\Carbon::parse(env($head_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                        </p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="/{{ $selected_source }}/{{ $selected_category }}/{{ $head_value['id'] }}" type="button" class="btn btn-primary btn-lg px-4 me-md-2 show-preloader">
                                <i class="bi bi-arrow-up-right"></i>
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- BERITA TERPOPULER (FEATURES WITH CARDS) --}}
<div class="container px-4 pt-5" id="hanging-icons">
    <h2 class="pb-2 border-bottom">Berita Terpopuler</h2>
    <div class="row g-4 pt-3 pb-5 row-cols-1 row-cols-lg-3">
        @foreach ($populars as $pop_key => $pop_value)
        {{-- <div class="col position-relative">
            <div class="row">
                <div class="col-5">
                    <span class="position-absolute top-0 start-20 translate-middle badge rounded-pill bg-black">
                        {{ $loop->index + 1 }}
                    </span>
                    <img src="{{ url($pop_value['thumbnail']) }}" onerror="this.onerror=null; this.src='{{ asset('images/nopic.png') }}'" class="d-block mx-lg-auto rounded img-fluid" loading="lazy">
                </div>
                <div class="col-7">
                    <h3 class="fs-6 text-body-emphasis">{{ html_entity_decode($pop_value['title']) }}</h3>
                    <p>
                        {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $selected_category)) }} | {{ \Carbon\Carbon::parse(env($pop_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        </div> --}}
        <div class="card mb-3 border-0 position-relative {{ $loop->last ? '' : 'border-end' }} gx-5">
            <div class="row g-0">
                <div class="col-md-4">
                    <span class="position-absolute top-0 start-20 translate-middle badge rounded-pill bg-primary text-white">
                        {{ $loop->index + 1 }}
                    </span>
                    <img src="{{ url($pop_value['thumbnail']) }}" onerror="this.onerror=null; this.src='{{ asset('images/nopic.png') }}'" class="img-fluid rounded pt-1" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body py-0">
                        <a href="/{{ $selected_source }}/{{ $selected_category }}/{{ $pop_value['id'] }}" class="stretched-link text-body-emphasis show-preloader" style="text-decoration: none;">
                            <h6 class="card-title">{{ html_entity_decode($pop_value['title']) }}</h6>
                        </a>
                        <p class="card-text">
                            {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $selected_category)) }} | {{ \Carbon\Carbon::parse(env($pop_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- REKOMENDASI UNTUK ANDA (CARDS) --}}
<div class="container px-4 py-3">
    <div class="row align-items-start border-bottom">
        <div class="col-8">
            <h2 class="pb-2">Rekomendasi Untuk Anda</h2>
        </div>
        <div class="col-4">
            <form action="{{ route('source', ['source' => $selected_source, 'category' => $selected_category]) }}" method="GET">
                <div class="input-group mb-3">
                    <input id="search" name="search" type="text" class="form-control" placeholder="Cari disini..." aria-label="Search" aria-describedby="basic-addon1" value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="row row-cols-1 row-cols-md-4 g-4 pt-3"> --}}
    @if ($search && count($recommends) == 0)
    <br/>
    <div class="alert alert-danger" role="alert">
        Tidak ada post yang ditemukan.
    </div>
    @elseif ($search && count($recommends) != 0)
    <div class="row row-cols-1 row-cols-md-4 g-4 pt-3">
        @foreach ($recommends as $json_key => $json_value)
        <div class="col">
            <div class="card h-100 border-0">
                <img src="{{ url($json_value['thumbnail']) }}" onerror="this.onerror=null; this.src='{{ asset('images/nopic.png') }}'" class="card-img-top card-img-bottom" alt="...">
                <div class="card-body">
                    <a href="/{{ $selected_source }}/{{ $selected_category }}/{{ $json_value['id'] }}" class="stretched-link text-body-emphasis show-preloader" style="text-decoration: none;">
                        <h5 class="card-title">{{ html_entity_decode($json_value['title']) }}</h5>
                    </a>
                    <p class="card-text">
                        {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $selected_category)) }} | {{ \Carbon\Carbon::parse(env($json_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <div class="row row-cols-1 row-cols-md-4 g-4 pt-3">
            @foreach ($recommends as $json_key => $json_value)
            <div class="col">
                <div class="card h-100 border-0">
                    <img src="{{ url($json_value['thumbnail']) }}" onerror="this.onerror=null; this.src='{{ asset('images/nopic.png') }}'" class="card-img-top card-img-bottom" alt="...">
                    <div class="card-body">
                        <a href="/{{ $selected_source }}/{{ $selected_category }}/{{ $json_value['id'] }}" class="stretched-link text-body-emphasis show-preloader" style="text-decoration: none;">
                            <h5 class="card-title">{{ html_entity_decode($json_value['title']) }}</h5>
                        </a>
                        <p class="card-text">
                            {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $selected_category)) }} | {{ \Carbon\Carbon::parse(env($json_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    {{-- </div> --}}
    <br/>
    {{ $recommends->withQueryString()->links() }}
</div>
