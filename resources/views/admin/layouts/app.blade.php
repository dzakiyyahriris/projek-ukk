<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiket - {{ $tittle ?? 'Dashboard' }}</title>
    <link rel="shortcut icon" type="image/png"
        href="{{ asset('template-admin/src/assets/images/logos/tiketwisata.png') }}" />
    <link rel="stylesheet" href="{{ asset('template-admin/src/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="http://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
    <style>
        /* Warna Utama: Biru Cerah (Mirip KAI/Travel Modern) */
        :root {
            --primary-color: #0085db;
            /* Biru cerah */
            --primary-light: #e8f4fd;
            /* Biru sangat muda untuk hover */
            --sidebar-bg: #ffffff;
            --text-dark: #2a3547;
        }

        /* Header Style */
        .app-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e5eaef;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .app-header .navbar .nav-link i {
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            font-weight: 600;
        }

        /* Sidebar Style */
        .left-sidebar {
            background: var(--sidebar-bg) !important;
            border-right: 1px solid #e5eaef;
            transition: 0.3s ease;
        }

        /* Sidebar Links */
        .sidebar-nav ul .sidebar-item .sidebar-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            border-radius: 7px;
            margin-bottom: 4px;
            transition: 0.2s;
        }

        /* Sidebar Link: Hover */
        .sidebar-nav ul .sidebar-item .sidebar-link:hover {
            background-color: var(--primary-light) !important;
            color: var(--primary-color) !important;
        }

        .sidebar-nav ul .sidebar-item .sidebar-link:hover i {
            color: var(--primary-color) !important;
        }

        /* Sidebar Link: Active / Selected */
        .sidebar-nav ul .sidebar-item.selected>.sidebar-link,
        .sidebar-nav ul .sidebar-item .sidebar-link.active {
            background-color: var(--primary-color) !important;
            color: #ffffff !important;
        }

        .sidebar-nav ul .sidebar-item.selected>.sidebar-link i,
        .sidebar-nav ul .sidebar-item .sidebar-link.active i {
            color: #ffffff !important;
        }

        /* Judul Kategori (Home, Datamaster) */
        .nav-small-cap {
            color: #a1aab2 !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
    @yield('css')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('admin.layouts.sidebar')
        <!-- Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.layouts.header')
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('template-admin/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('template-admin/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    @yield('js')
    <script src="http://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    <script src="http://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        @if (session('status'))
            swal({
                title: '{{ session('title') }}',
                text: '{{ session('message') }}',
                icon: '{{ session('status') }}',
            });
        @endif
    </script>
</body>

</html>
