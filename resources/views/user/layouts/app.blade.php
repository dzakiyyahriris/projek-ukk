<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Penting untuk keamanan --}}
    
    <title>{{ $title ?? 'Tiket Asyik' }}</title>

    {{-- CDN Bootstrap & Fonts --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* --- LOGIKA STICKY FOOTER --- */
        /* Ini agar footer selalu di bawah meski konten sedikit */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
        }

        main {
            flex: 1; /* Konten akan mengisi ruang kosong */
        }
        /* --------------------------- */

        .navbar {
            background-color: rgba(35, 35, 35, 0.95); /* Sedikit dipergelap agar teks lebih terbaca */
            backdrop-filter: blur(10px);
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .status-badge {
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.8rem;
        }

        /* --- STYLING FOOTER --- */
        .main-footer {
            background-color: #00102f;
            color: #ffffff;
            padding: 60px 20px 30px 20px;
            font-family: Arial, sans-serif;
            margin-top: auto; /* Memastikan margin atas otomatis */
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 30px;
        }

        .footer-column {
            flex: 1;
            min-width: 200px;
        }

        .footer-column h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #63b3ed;
        }

        .footer-column h4 {
            font-size: 18px;
            margin-bottom: 20px;
            border-bottom: 2px solid #2d3748;
            padding-bottom: 10px;
            display: inline-block;
        }

        .footer-column p {
            font-size: 14px;
            line-height: 1.6;
            color: #a0aec0;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column ul li a {
            color: #a0aec0;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-column ul li a:hover {
            color: #ffffff;
        }

        .social-links {
            display: flex;
            gap: 10px;
        }

        .social-icon {
            background-color: #2d3748;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 12px;
            transition: background 0.3s;
        }

        .social-icon:hover {
            background-color: #3182ce;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 50px;
            border-top: 1px solid #2d70e2;
            padding-top: 20px;
            color: #718096;
            font-size: 14px;
        }

        .tagline {
            font-style: italic;
            margin-top: 5px;
        }

        .btn-tight {
            padding: 2px 12px !important;
            font-size: 13px;
            font-weight: 500;
            line-height: 1.5;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 70px;
            height: auto;
            transition: all 0.2s ease;
        }

        .btn-tight:focus {
            box-shadow: none !important;
        }

        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
            }
        }
    </style>

    {{-- Yield untuk CSS tambahan per halaman --}}
    @yield('css')
    @stack('styles')
</head>

<body>

    @include('user.layouts.header')

    {{-- Main Content --}}
    {{-- 'py-5' memberikan jarak atas dan bawah agar tidak nempel navbar/footer --}}
    {{-- 'mt-5' ditambahkan jaga-jaga jika navbar anda tipe fixed-top --}}
    <main class="py-5 mt-4">
        @yield('content')
    </main>

    @include('user.layouts.footer')

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Stack untuk JS tambahan per halaman (misal: JS untuk SweetAlert atau Chart) --}}
    @stack('scripts')
</body>

</html>