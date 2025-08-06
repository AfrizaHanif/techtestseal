<nav class="py-2 bg-body-secondary border-bottom">
    <div class="container d-flex flex-wrap">
        {{-- SOURCE NAVIGATION (GLOBAL) --}}
        <ul class="nav me-auto">
            @if ($navJson = $navJson ?? [])
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
        {{-- COLOR MODE TOGGLE --}}
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


