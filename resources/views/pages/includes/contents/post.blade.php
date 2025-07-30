{{-- NAVIGATON (BREADCRUMBS) --}}
<div class="container pt-3 my-3">
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
            <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none" href="/{{ $selected_source }}/{{ $selected_category }}">{{ ucfirst($selected_category) }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
            Detail
            </li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="display-6 fw-bold text-body-emphasis lh-1 mb-3">{{ $jsonData['title'] }}</h1>
            <p>{{ ucfirst($selected_category) }} | {{ \Carbon\Carbon::parse(env($jsonData['pubDate']))->locale('id')->translatedFormat('d F Y') }}</p>
            <img src="{{ url($jsonData['thumbnail']) }}" class="d-block mx-lg-auto rounded img-fluid" alt="Bootstrap Themes" loading="lazy">
            <br/>
            <p>{{ html_entity_decode($jsonData['description']) }}</p>
            <a href="{{ url($jsonData['link']) }}" type="button" class="btn btn-secondary btn-sm">Kunjungi Sumber</a>
            <h2 class="pt-3 pb-2 border-bottom">Komentar</h2>
            <div class="row pt-3 pb-3">
                <div class="col-1">
                    <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                        <svg class="bi" width="1em" height="1em" aria-hidden="true"><use xlink:href="#toggles2"></use></svg>
                    </div>
                </div>
                <div class="col-11">
                    <div class="mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" style="resize: none"></textarea>
                    </div>
                    <a href="#" class="btn btn-primary">
                    Kirim
                    </a>
                </div>
            </div>
            <div class="row pt-3 pb-2 align-items-start border-bottom">
                <div class="col-8">
                    <h2>Berita Terkait</h2>
                </div>
                <div class="col-4">
                    <a href="/{{ $selected_source }}/{{ $selected_category }}" type="button" class="btn btn-primary float-end">Lihat Semua</a>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 pt-3 pb-3">
                @foreach ($related as $rel_key => $rel_value)
                <div class="col">
                    <div class="card h-100 border-0">
                        <img src="{{ url($rel_value['thumbnail']) }}" onerror="this.onerror=null; this.src='{{ asset('images/landing.png') }}'" class="card-img-top card-img-bottom" alt="...">
                        <div class="card-body">
                            <a href="/{{ $selected_source }}/{{ $selected_category }}/{{ $rel_key }}" class="stretched-link" style="text-decoration: none; color: black;">
                                <h5 class="card-title">{{ $rel_value['title'] }}</h5>
                            </a>
                            <p class="card-text">
                                {{ ucfirst($selected_category) }} | {{ \Carbon\Carbon::parse(env($rel_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-4">
            {{-- BERITA TERPOPULER (CARDS) --}}
            <h2 class="pb-2 border-bottom">Berita Terpopuler</h2>
                @foreach ($populars as $pop_key => $pop_value)
                    <div class="card mb-3 border-0 {{ $loop->first ? 'pt-3' : '' }} position-relative">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ url($pop_value['thumbnail']) }}" class="img-fluid rounded pt-1" alt="...">
                                <span class="position-absolute {{ $loop->first ? 'top-20' : '' }} start-0 translate-middle badge rounded-pill bg-black">
                                    {{ $loop->index + 1 }}
                                </span>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body py-0">
                                    <a href="/{{ $selected_source }}/{{ $selected_category }}/{{ $pop_key }}" class="stretched-link" style="text-decoration: none; color: black;">
                                        <h6 class="card-title">{{ $pop_value['title'] }}</h6>
                                    </a>
                                    <p class="card-text">
                                        {{ ucfirst($selected_category) }} | {{ \Carbon\Carbon::parse(env($pop_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!$loop->last)
                    <hr/>
                    @endif
                @endforeach
        </div>
    </div>
</div>
