{{-- resources/views/kos/detail.blade.php --}}
@extends('layouts.app')

@section('content')

{{-- Navbar Solid --}}
<div class="bg-[#0F172A] w-full py-4 relative">
    @include('layouts.navbar')
</div>

<div class="min-h-screen bg-[#F0EDE8]">

    {{-- -----------------------------------------------
         BREADCRUMB
         ----------------------------------------------- --}}
    <div class="max-w-7xl mx-auto px-8 pt-5 pb-2">
        <p class="poppins-font text-sm text-gray-500">
            <a href="/" class="hover:text-[#D4AF37] transition">Beranda</a>
            <span class="mx-2 text-gray-400">›</span>
            <a href="{{ url('/kos') }}" class="hover:text-[#D4AF37] transition">Cari Kos</a>
            <span class="mx-2 text-gray-400">›</span>
            <span class="font-semibold text-[#0F172A]">Detail Kos</span>
        </p>
    </div>

    {{-- -----------------------------------------------
         DUMMY DATA
         ----------------------------------------------- --}}
    @php
    $kos = [
        'nama'        => 'Kos JatiNewYork',
        'alamat'      => 'Jl. Hegarmanah, Jatinangor, Sumedang',
        'rating'      => '5.0',
        'review'      => '500',
        'harga'       => 'Rp 1.250.000',
        'tersedia'    => 5,
        'tipe'        => 'Campur',
        'jumlah'      => '15 Kamar',
        'luas'        => '3 × 4 Meter',
        'km'          => 'Dalam',
        'parkir'      => 'Motor & Mobil',
        'keamanan'    => 'CCTV + Security',
        'deskripsi'   => 'Kos JatiNewYork adalah hunian premium yang dirancang untuk mahasiswa dan profesional muda yang menginginkan kenyamanan tinggi di kawasan strategis Jatinangor. Dikelilingi berbagai fasilitas umum dan berdekatan dengan kampus-kampus ternama, kos ini menawarkan pengalaman tinggal yang nyaman, aman, dan modern. Setiap kamar dilengkapi dengan furnitur berkualitas, pencahayaan yang baik, dan ventilasi memadai.',
        'fasilitas'   => ['WiFi 100 Mbps', 'AC', 'Kamar Mandi Dalam', 'Parkir Motor & Mobil', 'CCTV 24 Jam', 'Dapur Bersama', 'Laundry', 'Cleaning Service'],
        'lokasi'      => 'Jl. Hegarmanah No. 21, Hegarmanah, Jatinangor, Sumedang, Jawa Barat 45363. Dekat: UNPAD (500m), ITB Jatinangor (800m), Pasar Jatinangor (1km).',
        'aturan'      => ['Tamu tidak diizinkan menginap', 'Jam malam pukul 23.00 WIB', 'Dilarang membawa hewan peliharaan', 'Bayar sewa maksimal tanggal 5 setiap bulan', 'Jaga kebersihan bersama'],
        'img_utama'   => 'images/kos/kos1.jpg',
        'thumbnails'  => ['images/kos/kos1.jpg', 'images/kos/kos2.jpg', 'images/kos/kos3.jpg', 'images/kos/kos4.jpg'],
    ];
    @endphp

    {{-- -----------------------------------------------
         MAIN CONTENT — 2 KOLOM
         ----------------------------------------------- --}}
    <div class="max-w-7xl mx-auto px-8 pb-16 pt-4">

        <div class="flex gap-8 items-start">

            {{-- =========================================
                 KIRI — Galeri + Info
                 ========================================= --}}
            <div class="flex-1 min-w-0">

                {{-- GAMBAR UTAMA --}}
                <div class="rounded-2xl overflow-hidden bg-[#0F172A] h-[380px] mb-3">

                    <img
                        id="mainImg"
                        src="{{ asset($kos['img_utama']) }}"
                        alt="{{ $kos['nama'] }}"
                        class="w-full h-full object-cover"
                        onerror="this.style.display='none'; document.getElementById('imgPlaceholder').style.display='flex';">

                    <div
                        id="imgPlaceholder"
                        class="hidden w-full h-full
                               bg-gradient-to-br from-[#0F172A] to-[#1e3a5f]
                               items-center justify-center">
                        <svg class="w-24 h-24 text-[#D4AF37]/30" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9"/>
                        </svg>
                    </div>

                </div>

                {{-- THUMBNAILS --}}
                <div class="flex gap-3 mb-6">

                    @foreach ($kos['thumbnails'] as $i => $thumb)

                    <button
                        onclick="document.getElementById('mainImg').src='{{ asset($thumb) }}'"
                        class="w-[100px] h-[68px]
                               rounded-xl
                               overflow-hidden
                               border-2
                               {{ $i === 0 ? 'border-[#D4AF37]' : 'border-transparent hover:border-[#D4AF37]/60' }}
                               transition
                               flex-shrink-0
                               bg-[#0F172A]">

                        <img
                            src="{{ asset($thumb) }}"
                            alt="Thumbnail {{ $i + 1 }}"
                            class="w-full h-full object-cover"
                            onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-[#1e3a5f] flex items-center justify-center\'><span class=\'text-[#D4AF37]/50 text-xs\'>Foto</span></div>'">

                    </button>

                    @endforeach

                    {{-- More --}}
                    <button
                        class="w-[100px] h-[68px]
                               rounded-xl
                               flex-shrink-0
                               bg-black/60
                               border-2 border-white/20
                               flex items-center justify-center
                               text-white
                               text-lg
                               font-bold
                               poppins-font
                               hover:bg-black/75
                               transition">
                        +6
                    </button>

                </div>

                {{-- JUDUL & LOKASI --}}
                <h1 class="hero-font text-[#0F172A] text-[32px] font-black leading-tight mb-2">
                    {{ $kos['nama'] }}
                </h1>

                <div class="flex items-center gap-2 text-gray-500 poppins-font text-[15px] mb-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 2C8.686 2 6 4.686 6 8c0 5.25 6 13 6 13s6-7.75 6-13c0-3.314-2.686-6-6-6z"/>
                        <circle cx="12" cy="8" r="2" stroke-linecap="round"/>
                    </svg>
                    {{ $kos['alamat'] }}
                </div>

                <div class="flex items-center gap-2 mb-5 poppins-font text-[15px]">
                    <svg class="w-4 h-4 text-[#D4AF37] fill-[#D4AF37]" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="text-[#D4AF37] font-bold">{{ $kos['rating'] }}</span>
                    <span class="text-gray-400">({{ $kos['review'] }} Review)</span>
                </div>

                <hr class="border-gray-200 mb-5">

                {{-- TABS --}}
                <div x-data="{ activeTab: 'deskripsi' }">

                    {{-- Tab Buttons --}}
                    <div class="flex gap-0 border-b-2 border-gray-200 mb-6">

                        @foreach (['deskripsi' => 'Deskripsi', 'fasilitas' => 'Fasilitas', 'lokasi' => 'Lokasi', 'aturan' => 'Aturan Kos'] as $key => $label)

                        <button
                            @click="activeTab = '{{ $key }}'"
                            :class="activeTab === '{{ $key }}'
                                ? 'border-b-[3px] border-[#D4AF37] text-[#0F172A] font-semibold -mb-[2px]'
                                : 'text-gray-400 hover:text-[#0F172A]'"
                            class="poppins-font text-[15px] px-5 pb-3 transition">

                            {{ $label }}

                        </button>

                        @endforeach

                    </div>

                    {{-- Tab: Deskripsi --}}
                    <div x-show="activeTab === 'deskripsi'" class="poppins-font text-gray-500 text-[15px] leading-relaxed">
                        {{ $kos['deskripsi'] }}
                    </div>

                    {{-- Tab: Fasilitas --}}
                    <div x-show="activeTab === 'fasilitas'" class="grid grid-cols-2 gap-3">
                        @foreach ($kos['fasilitas'] as $f)
                        <div class="flex items-center gap-3 poppins-font text-gray-600 text-sm">
                            <span class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </span>
                            {{ $f }}
                        </div>
                        @endforeach
                    </div>

                    {{-- Tab: Lokasi --}}
                    <div x-show="activeTab === 'lokasi'" class="poppins-font text-gray-500 text-[15px] leading-relaxed">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#D4AF37] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.686 2 6 4.686 6 8c0 5.25 6 13 6 13s6-7.75 6-13c0-3.314-2.686-6-6-6z"/>
                                <circle cx="12" cy="8" r="2"/>
                            </svg>
                            {{ $kos['lokasi'] }}
                        </div>
                    </div>

                    {{-- Tab: Aturan Kos --}}
                    <div x-show="activeTab === 'aturan'" class="space-y-2">
                        @foreach ($kos['aturan'] as $i => $aturan)
                        <div class="flex items-start gap-3 poppins-font text-gray-600 text-[15px]">
                            <span class="text-[#D4AF37] font-bold flex-shrink-0">{{ $i + 1 }}.</span>
                            {{ $aturan }}
                        </div>
                        @endforeach
                    </div>

                </div>

            </div>
            {{-- end kiri --}}

            {{-- =========================================
                 KANAN — Price Card + Info Card
                 ========================================= --}}
            <div class="w-[360px] flex-shrink-0 space-y-4 sticky top-6">

                {{-- PRICE CARD --}}
                <div class="bg-white rounded-2xl p-6 shadow-md">

                    <p class="poppins-font text-xs tracking-widest text-gray-400 font-semibold uppercase mb-1">
                        MULAI DARI
                    </p>

                    <p class="hero-font text-[#0F172A] text-[32px] font-black leading-none mb-1">
                        {{ $kos['harga'] }}
                        <span class="poppins-font text-gray-400 text-[15px] font-normal">/bulan</span>
                    </p>

                    {{-- Tersedia Badge --}}
                    <div class="flex items-center gap-2
                                bg-green-50 text-green-700
                                rounded-xl px-4 py-3
                                poppins-font text-sm font-semibold
                                my-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        {{ $kos['tersedia'] }} Kamar Tersedia Sekarang
                    </div>

                    {{-- Fasilitas Ikon --}}
                    <div class="flex items-center gap-4
                                border border-gray-100 rounded-xl p-4 mb-5">

                        <div class="flex items-center gap-2 poppins-font text-sm text-gray-600">
                            <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" d="M5 12.55a11 11 0 0114.08 0M1.42 9a16 16 0 0121.16 0M8.53 16.11a6 6 0 016.95 0M12 20h.01"/>
                            </svg>
                            WiFi
                        </div>

                        <div class="flex items-center gap-2 poppins-font text-sm text-gray-600">
                            <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <path d="M3 9h18M9 21V9"/>
                            </svg>
                            KM Dalam
                        </div>

                        <div class="flex items-center gap-2 poppins-font text-sm text-gray-600">
                            <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 7h18M3 12h18M3 17h18"/>
                            </svg>
                            AC
                        </div>

                    </div>

                    {{-- Tombol Pilih Kamar --}}
                    <a
                        href="#"
                        class="block
                               w-full
                               bg-[#D4AF37]
                               text-white
                               text-center
                               poppins-font
                               text-[15px]
                               font-bold
                               py-4
                               rounded-xl
                               hover:opacity-90
                               transition
                               tracking-wide
                               mb-3">

                        PILIH KAMAR

                    </a>

                    {{-- Tombol Wishlist --}}
                    <button
                        class="w-full
                               flex items-center justify-center gap-2
                               border border-gray-200
                               text-gray-600
                               poppins-font
                               text-[15px]
                               font-medium
                               py-3.5
                               rounded-xl
                               hover:border-[#D4AF37]
                               hover:text-[#D4AF37]
                               transition">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                        </svg>

                        Tambah Ke Wishlist

                    </button>

                </div>

                {{-- INFO KOS CARD --}}
                <div class="bg-white rounded-2xl p-6 shadow-md">

                    <h4 class="poppins-font text-[#0F172A] font-bold text-[15px] mb-4">
                        Informasi Kost
                    </h4>

                    @php
                    $infoRows = [
                        'Tipe Kos'     => $kos['tipe'],
                        'Jumlah Kamar' => $kos['jumlah'],
                        'Luas Kamar'   => $kos['luas'],
                        'Kamar Mandi'  => $kos['km'],
                        'Parkir'       => $kos['parkir'],
                        'Keamanan'     => $kos['keamanan'],
                    ];
                    @endphp

                    @foreach ($infoRows as $label => $value)

                    <div class="flex justify-between items-center
                                py-3
                                border-b border-gray-50
                                last:border-0">

                        <span class="poppins-font text-gray-400 text-sm">{{ $label }}</span>
                        <span class="poppins-font text-[#0F172A] text-sm font-semibold text-right">{{ $value }}</span>

                    </div>

                    @endforeach

                </div>

            </div>
            {{-- end kanan --}}

        </div>

    </div>

</div>

{{-- Alpine.js untuk tab (jika belum di-include di app.blade.php) --}}
{{-- Pastikan Alpine.js sudah ada di layouts/app.blade.php --}}
{{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

@endsection