<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahaking Kos</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti:wght@400;500;700&family=Playfair+Display:wght@700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Hilangkan flicker Alpine.js --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    {{--
        ❌ JANGAN taruh @include('layouts.navbar') di sini
        ✅ Navbar di-include langsung di masing-masing halaman:

        Homepage (index.blade.php):
            → @include('layouts.navbar')              ← mode transparan/overlay

        Halaman lain (kos/index, detail, dll):
            → @include('layouts.navbar', ['solid' => true])  ← mode sticky solid

        Alasannya: tiap halaman butuh mode navbar berbeda.
    --}}

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    {{-- ✅ Alpine.js — wajib untuk hamburger drawer & tabs interaktif --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

</body>
</html>