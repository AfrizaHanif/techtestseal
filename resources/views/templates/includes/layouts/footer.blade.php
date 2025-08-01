<div class="container mt-auto">
    <footer class="d-flex flex-wrap row row-cols-1 row-cols-sm-2 row-cols-md-4 py-5 my-3 border-top">
        <div class="col mb-3">
            <a href="/" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none" aria-label="Bootstrap">
                <svg class="bi me-2" width="40" height="40" aria-hidden="true"><use xlink:href="#newspaper"></use></svg>
                <span class="fs-4">Berita Kini</span>
            </a>
            <p class="text-body-secondary">&copy; 2025 Berita Kini. All Rights Reserved.</p>
            <br/>
            <h6>Ikuti Kami</h6>
            <ul class="list-unstyled d-flex">
                <li class="">
                    <a class="link-body-emphasis" href="https://facebook.com" aria-label="Facebook">
                        <svg class="bi" width="24" height="24" aria-hidden="true"><use xlink:href="#facebook"></use></svg>
                    </a>
                </li>
                <li class="ms-3">
                    <a class="link-body-emphasis" href="https://instagram.com" aria-label="Instagram">
                        <svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col mb-3">
            @if (Request::is('/'))
            <h6>Telusuri Sumber</h6>
                @if ($explore)
                <ul class="nav flex-column">
                    @foreach ($explore as $exp_key => $exp_Value)
                    <li class="nav-item mb-2">
                        <a href="/{{ $exp_Value }}" class="nav-link p-0 text-body-secondary">
                            @if (strlen(ucfirst($exp_Value)) > 4)
                            {{ ucfirst($exp_Value) }}
                            @else
                            {{ strtoupper($exp_Value) }}
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endif
            @else
            <h6>Telusuri Kategori</h6>
                @if ($explore)
                <ul class="nav flex-column">
                    @foreach ($explore as $exp_key => $exp_Value)
                    <li class="nav-item mb-2"><a href="/{{ $selected_source }}/{{ $exp_Value }}" class="nav-link p-0 text-body-secondary">{{ ucfirst($exp_Value) }}</a></li>
                    @endforeach
                </ul>
                @endif
            @endif
        </div>
        <div class="col mb-3">
            <h6>Bantuan</h6>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Kontak Kami</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Laporkan Pembajakan</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Kebijakan</a></li>
            </ul>
        </div>
        <div class="col mb-3">
            <h6>Berlanggan Berita Baru</h6>
            <div class="input-group mb-3">
                <input type="mail" class="form-control" placeholder="Masukkan E-Mail" aria-label="Masukkan E-Mail" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
        </div>
    </footer>
</div>
