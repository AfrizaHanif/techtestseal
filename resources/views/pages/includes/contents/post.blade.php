{{-- NAVIGATON (BREADCRUMBS) --}}
@include('pages.includes.components.breadcrumb')

<div class="container">
    <div class="row">
        {{-- MAIN CONTENT --}}
        <div class="col-8">
            {{-- SELECTED ARTICLE --}}
            <h1 class="display-6 fw-bold text-body-emphasis lh-1 mb-3">{{ html_entity_decode($jsonData['title']) }}</h1>
            <p>{{ ucfirst($selected_category) }} | {{ \Carbon\Carbon::parse(env($jsonData['pubDate']))->locale('id')->translatedFormat('d F Y') }}</p>
            <img src="{{ url($jsonData['thumbnail']) }}" onerror="this.onerror=null; this.src='{{ asset('images/nopic.png') }}'" class="d-block mx-lg-auto rounded img-fluid" alt="Bootstrap Themes" loading="lazy">
            <br/>
            <p>{{ html_entity_decode($jsonData['description']) }}</p>
            <a href="{{ url($jsonData['link']) }}" type="button" class="btn btn-secondary btn-sm show-preloader" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-box-arrow-up-right"></i>
                Kunjungi Sumber
            </a>

            {{-- COMMENT AREA --}}
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

            {{-- RELATED NEWS (CARDS) --}}
            <div class="row pt-3 pb-2 align-items-start border-bottom">
                <div class="col-8">
                    <h2>Berita Terkait</h2>
                </div>
                <div class="col-4">
                    <a href="/{{ $selected_source }}" type="button" class="btn btn-primary float-end show-preloader">Lihat Semua</a>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 pt-3 pb-3">
                @foreach ($related as $rel_key => $rel_value)
                <div class="col">
                    <div class="card h-100 border-0">
                        <img src="{{ url($rel_value['thumbnail']) }}" onerror="this.onerror=null; this.src='{{ asset('images/nopic.png') }}'" class="card-img-top card-img-bottom" alt="...">
                        <div class="card-body">
                            <a href="/{{ $selected_source }}/{{ $rel_value['category'] }}/{{ $rel_value['id'] }}" class="stretched-link text-body-emphasis show-preloader" style="text-decoration: none;">
                                <h5 class="card-title">{{ html_entity_decode($rel_value['title']) }}</h5>
                            </a>
                            <p class="card-text">
                                {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $rel_value['category'])) }} | {{ \Carbon\Carbon::parse(env($rel_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-4">
            {{-- MOST POPULAR NEWS (CARDS) --}}
            <h2 class="pb-2 border-bottom">Berita Terpopuler</h2>
            @foreach ($populars as $pop_key => $pop_value)
                <div class="card mb-3 border-0 {{ $loop->first ? 'pt-3' : '' }} position-relative">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ url($pop_value['thumbnail']) }}" onerror="this.onerror=null; this.src='{{ asset('images/nopic.png') }}'" class="img-fluid rounded pt-1" alt="...">
                            <span class="position-absolute {{ $loop->first ? 'top-20' : '' }} start-0 translate-middle badge rounded-pill bg-primary text-white">
                                {{ $loop->index + 1 }}
                            </span>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body py-0">
                                <a href="/{{ $selected_source }}/{{ $pop_value['category'] }}/{{ $pop_value['id'] }}" class="stretched-link text-body-emphasis show-preloader" style="text-decoration: none;">
                                    <h6 class="card-title">{{ html_entity_decode(html_entity_decode($pop_value['title'])) }}</h6>
                                </a>
                                <p class="card-text">
                                    {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $pop_value['category'])) }} | {{ \Carbon\Carbon::parse(env($pop_value['pubDate']))->locale('id')->translatedFormat('d F Y') }}
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
