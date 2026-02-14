<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; min-height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Sistem Informasi Penjualan Obat</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ url('/obat') }}" class="nav-link text-white {{ request()->is('obat*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>
                Data Obat
            </a>
        </li>
        <li>
            <a href="{{ url('/penjualan') }}" class="nav-link text-white {{ request()->is('penjualan*') ? 'active' : '' }}">
                <i class="bi bi-person-video3 me-2"></i>
                Data Penjualan
            </a>
        </li>
        <li>
            <a href="{{ url('/pembelian') }}" class="nav-link text-white {{ request()->is('pembelian*') ? 'active' : '' }}">
                <i class="bi bi-book me-2"></i>
                Data Pembelian
            </a>
        </li>
        <li>
            <a href="{{ url('/pelanggan') }}" class="nav-link text-white {{ request()->is('pelanggan*') ? 'active' : '' }}">
                <i class="bi bi-calendar-week me-2"></i>
                Data Pelanggan
            </a>
        </li>
        <li>
            <a href="{{ url('/suplier') }}" class="nav-link text-white {{ request()->is('suplier*') ? 'active' : '' }}">
                <i class="bi bi-calendar-week me-2"></i>
                Data Suplier
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://ui-avatars.com/api/?name=Admin" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>Admin</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>