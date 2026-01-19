<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="text-nowrap logo-img">
                <img src="{{ asset('template-admin/src/assets/images/logos/tiketwisata.png') }}" width="180" alt="Logo" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar="" style="height: calc(100vh - 100px); overflow-y: auto;">
            <ul id="sidebarnav">
                <li class="nav-small-cap"><span class="hide-menu">Utama</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/dashboard">
                        <span><i class="ti ti-layout-dashboard"></i></span><span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap"><span class="hide-menu">Manajemen Data</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/users">
                        <span><i class="ti ti-user-circle"></i></span><span class="hide-menu">Data Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/acara">
                        <span><i class="ti ti-map-pin"></i></span><span class="hide-menu">Data Acara</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/tipe_tiket">
                        <span><i class="ti ti-ticket"></i></span><span class="hide-menu">Tipe Tiket</span>
                    </a>
                </li>
                <li class="nav-small-cap"><span class="hide-menu">Transaksi</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/pesanan">
                        <span><i class="ti ti-shopping-cart"></i></span><span class="hide-menu">Daftar Pesanan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/checkin">
                        <span><i class="ti ti-scan"></i></span><span class="hide-menu">Check-in Tiket</span>
                    </a>
                </li>
                <li class="sidebar-item" style="height: 100px;"></li>
            </ul>
        </nav>
    </div>
</aside>