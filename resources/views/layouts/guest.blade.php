<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@300;400;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-accent: #ffc107;
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f1012;
            color: #1e293b;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        /* Background halus */
        .main-bg {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -1;
            object-fit: cover;
            filter: brightness(0.3) grayscale(0.2); /* Lebih gelap & sinematik */
        }

        .glass-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -1;
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.4) 100%);
            backdrop-filter: blur(4px);
        }

        .guest-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* Animasi muncul */
        .fade-up {
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <img src="{{ asset('images/museum.jpg') }}" class="main-bg" alt="Background">
    <div class="glass-overlay"></div>

    <div class="guest-wrapper">
        <div class="fade-up w-100" style="max-width: 400px;">
            {{ $slot }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>