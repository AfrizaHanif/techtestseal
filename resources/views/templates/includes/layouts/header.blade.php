@for ($i = 1; $i <= 2; $i++)
    @if ($i == 1)
    <div class="bg-body text-body">
    @else
    <div id="scroll_header" class="fixed-top bg-body text-body">
    @endif
        @if ($i == 1)
        <nav class="py-2 bg-body-secondary border-bottom">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    @if ($navJson)
                    @foreach ($navJson as $nav_key => $nav_value)
                        <li class="nav-item">
                            <a href="/{{ $nav_value }}" class="nav-link link-body-emphasis px-2 show-preloader {{ (request()->is($nav_value.'*')) ? 'active' : '' }}" aria-current="{{ (request()->is($nav_value.'*')) ? 'page' : '' }}">
                                @if (strlen(ucfirst($nav_value)) > 4)
                                {{ ucfirst($nav_value) }}
                                @else
                                {{ strtoupper($nav_value) }}
                                @endif
                            </a>
                        </li>
                    @endforeach
                    @endif
                </ul>
                <ul class="nav">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" id="themeDropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-circle-half theme-icon-active"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="themeDropdown">
                            <li>
                                <button class="dropdown-item" type="button" data-bs-theme-value="light">
                                    <i class="bi bi-sun-fill theme-icon"></i> Light
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item" type="button" data-bs-theme-value="dark">
                                    <i class="bi bi-moon-stars-fill theme-icon"></i> Dark
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item active" type="button" data-bs-theme-value="auto">
                                    <i class="bi bi-circle-half theme-icon"></i> Auto
                                </button>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </nav>
        @endif
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 border-bottom">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none show-preloader">
                    <svg class="bi me-2" width="40" height="40" aria-hidden="true"><use xlink:href="#newspaper"></use></svg>
                    <span class="fs-4">Berita Kini</span>
                </a>
                <ul class="nav nav-pills">
                    @if (Request::is('/'))
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link disabled" aria-current="page">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle disabled" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu disabled">
                            <li>
                                <a class="dropdown-item disabled" href="#">
                                    Disabled
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    @else
                        @if ($sourceJson && $selected_source)
                        <li class="nav-item">
                            <a href="/{{ $selected_source }}" class="nav-link show-preloader {{ (request()->is($selected_source.'')) ? 'active' : '' }}" aria-current="page">
                                Beranda
                            </a>
                        </li>
                            {{-- NEW VERSION (BETA) --}}
                            @foreach ($sourceJson[0]['paths'] as $source_key => $source_value)
                                @if ($loop->iteration < 5)
                                <li class="nav-item">
                                    @if (isset($check_category[$source_value['name']]) && $check_category[$source_value['name']] > 0)
                                    <a href="{{ $source_value['path'] }}" class="nav-link show-preloader {{ (request()->is($selected_source.'/'.$source_value['name'].'*')) ? 'active' : '' }}" aria-current="{{ (request()->is($selected_source.'/'.$source_value['name'].'*')) ? 'page' : '' }}">
                                    @else
                                    <a href="#" class="nav-link disabled">
                                    @endif
                                        {{ ucfirst($source_value['name']) }}
                                    </a>
                                </li>
                                @endif
                            @endforeach
                            @if (count($sourceJson[0]['paths']) >= 5)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-list"></i>
                                </a>
                                <ul class="dropdown-menu" style="max-height: 300px; overflow-y: auto;">
                                    @foreach ($sourceJson[0]['paths'] as $source_key => $source_value)
                                    @if ($loop->iteration >= 5)
                                        @if (isset($check_category[$source_value['name']]) && $check_category[$source_value['name']] > 0)
                                        <li>
                                            <a class="dropdown-item show-preloader {{ (request()->is($selected_source.'/'.$source_value['name'].'*')) ? 'active' : '' }}" href="{{ $source_value['path'] }}">
                                            @else
                                            <a class="dropdown-item disabled" href="#">
                                            @endif
                                                {{-- {{ ucfirst($source_value['name']) }} --}}
                                                {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $source_value['name'])) }}
                                            </a>
                                        </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                        @endif
                    @endif
                </ul>
            </header>
        </div>
    </div>
@endfor


