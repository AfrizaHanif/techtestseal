<div class="container pt-3 my-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
            {{-- HOME LINK --}}
            <li class="breadcrumb-item">
                <a class="link-body-emphasis show-preloader" href="/">
                    <svg class="bi" width="16" height="16" aria-hidden="true"><use xlink:href="#house-door-fill"></use></svg>
                    <span class="visually-hidden">Beranda</span>
                </a>
            </li>
            {{-- POST --}}
            @if (Request::is('*/*/*'))
            {{-- SELECTED SOURCE --}}
            <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none show-preloader" href="/{{ $selected_source }}">{{ ucfirst($selected_source) }}</a>
            </li>
            {{-- SELECTED CATEGORY --}}
            <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none show-preloader" href="/{{ $selected_source }}/{{ $selected_category }}">
                    {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $selected_category)) }}
                </a>
            </li>
            {{-- SELECTED POST --}}
            <li class="breadcrumb-item active" aria-current="page">
                Detail
            </li>
            {{-- CATEGORY --}}
            @elseif (Request::is('*/*'))
            {{-- SELECTED SOURCE --}}
            <li class="breadcrumb-item">
                <a class="link-body-emphasis fw-semibold text-decoration-none show-preloader" href="/{{ $selected_source }}">
                    @if (strlen(ucfirst($selected_source)) > 4)
                    {{ ucfirst($selected_source) }}
                    @else
                    {{ strtoupper($selected_source) }}
                    @endif
                </a>
            </li>
            {{-- SELECTED CATEGORY --}}
            <li class="breadcrumb-item active" aria-current="page">
                {{-- {{ ucfirst($selected_category) }} --}}
                {{ ucfirst(preg_replace('/(?<=[a-z])([A-Z])/', ' $1', $selected_category)) }}
            </li>
            {{-- SOURCE --}}
            @elseif (Request::is('*'))
            {{-- SELECTED SOURCE --}}
            <li class="breadcrumb-item active" aria-current="page">
                @if (strlen(ucfirst($selected_source)) > 4)
                {{ ucfirst($selected_source) }}
                @else
                {{ strtoupper($selected_source) }}
                @endif
            </li>
            @endif
        </ol>
    </nav>
</div>
