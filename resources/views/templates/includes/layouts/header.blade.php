@for ($i = 1; $i <= 2; $i++)
    @if ($i == 1)
    <div>
    @else
    <div id="scroll_header" class="fixed-top" style="background-color: white">
    @endif
        @if ($i == 1)
        <nav class="py-2 bg-body-tertiary border-bottom">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    @foreach ($navJson as $nav_key => $nav_value)
                        <li class="nav-item">
                            <a href="/{{ $nav_value }}" class="nav-link link-body-emphasis px-2 {{ (request()->is($nav_value.'*')) ? 'active' : '' }}" aria-current="{{ (request()->is($nav_value.'*')) ? 'page' : '' }}">
                                {{ ucfirst($nav_value) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <ul class="nav">

                </ul>
            </div>
        </nav>
        @endif
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 border-bottom" style="background-color: white">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
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
                    <li class="nav-item">
                        <a href="/{{ $selected_source }}" class="nav-link {{ (request()->is($selected_source.'')) ? 'active' : '' }}" aria-current="page">
                            Beranda
                        </a>
                    </li>
                        @if (count($sourceJson[0]['paths']) < 5)
                            @foreach ($sourceJson[0]['paths'] as $source_key => $source_value)
                            <li class="nav-item">
                                <a href="{{ $source_value['path'] }}" class="nav-link {{ (request()->is($selected_source.'/'.$source_value['name'].'*')) ? 'active' : '' }}" aria-current="{{ (request()->is($selected_source.'/'.$source_value['name'].'*')) ? 'page' : '' }}">
                                    {{ ucfirst($source_value['name']) }}
                                </a>
                            </li>
                            @endforeach
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ (request()->is($selected_source.'/*')) ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Kategori
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($sourceJson[0]['paths'] as $source_key => $source_value)
                                <li>
                                    <a class="dropdown-item {{ (request()->is($selected_source.'/'.$source_value['name'].'*')) ? 'active' : '' }}" href="{{ $source_value['path'] }}">
                                        {{ ucfirst($source_value['name']) }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    @endif
                </ul>
            </header>
        </div>
    </div>
@endfor


