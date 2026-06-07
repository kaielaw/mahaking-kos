{{-- resources/views/kos/index.blade.php --}}
@extends('layouts.app')

@section('content')

{{-- =====================================================
     NAVBAR SOLID — halaman non-homepage
     ===================================================== --}}
@include('layouts.navbar', ['solid' => true])

{{-- =====================================================
     MAIN WRAPPER
     ===================================================== --}}
<div class="min-h-screen bg-[#F0EDE8]">

    {{-- -----------------------------------------------
         BREADCRUMB
         ----------------------------------------------- --}}
    <div class="max-w-[1204px] mx-auto px-8 pt-5 pb-3">
        <p class="poppins-font text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-[#D4AF37] transition">Beranda</a>
            <span class="mx-2 text-gray-300">›</span>
            <span class="font-semibold text-[#0F172A]">Cari Kos</span>
        </p>
    </div>

    {{-- -----------------------------------------------
         HERO SEARCH BANNER
         ----------------------------------------------- --}}
    <div class="max-w-[1204px] mx-auto px-8 mb-8">

        <div class="relative rounded-2xl overflow-hidden"
             style="background-image: url('{{ asset('images/hero-kos.png') }}');
                    background-size: cover;
                    background-position: center;">

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-[#0F172A]/82 rounded-2xl"></div>

            {{-- Content --}}
            <div class="relative z-10 flex flex-col items-center justify-center py-10 px-8">

                {{-- Search Bar --}}
                <form
                    action="{{ url('/kos') }}"
                    method="GET"
                    class="flex items-center
                           bg-white
                           rounded-full
                           overflow-hidden
                           w-full
                           max-w-[780px]
                           h-[58px]
                           shadow-xl">

                    {{-- Location Icon --}}
                    <div class="px-5 flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                             stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 2C8.686 2 6 4.686 6 8c0 5.25 6 13 6 13s6-7.75 6-13c0-3.314-2.686-6-6-6z"/>
                            <circle cx="12" cy="8" r="2.25" stroke-linecap="round"/>
                        </svg>
                    </div>

                    {{-- Input --}}
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Masukkan nama kos, daerah, kecamatan"
                        class="flex-1 h-full outline-none text-gray-600
                               text-[15px] poppins-font bg-transparent">

                    {{-- Button --}}
                    <button
                        type="submit"
                        class="mr-2
                               bg-[#D4AF37]
                               text-white
                               px-7 py-2.5
                               rounded-full
                               text-sm font-bold
                               poppins-font
                               hover:opacity-90
                               transition
                               flex-shrink-0">
                        Cari Sekarang
                    </button>

                </form>

                {{-- ── Filter Row ── --}}
                <div class="flex items-center gap-3 mt-5 flex-wrap justify-center">

                    {{-- Filter Icon Button --}}
                    <button class="flex items-center gap-2
                                   bg-white/10 border border-white/25
                                   text-white text-sm poppins-font
                                   px-4 py-[9px] rounded-xl
                                   hover:bg-white/20 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="4"  y1="6"  x2="20" y2="6"/>
                            <line x1="8"  y1="12" x2="16" y2="12"/>
                            <line x1="10" y1="18" x2="14" y2="18"/>
                        </svg>
                        Filter
                    </button>

                    {{-- Semua Jenis --}}
                    <div class="relative">
                        <select class="bg-white/10 border border-white/25
                                       text-white text-sm poppins-font
                                       pl-4 pr-9 py-[9px] rounded-xl
                                       outline-none cursor-pointer
                                       hover:bg-white/20 transition appearance-none">
                            <option class="text-[#0F172A] bg-white">Semua Jenis</option>
                            <option class="text-[#0F172A] bg-white">Putri</option>
                            <option class="text-[#0F172A] bg-white">Putra</option>
                            <option class="text-[#0F172A] bg-white">Campur</option>
                        </select>
                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-white text-xs">▾</span>
                    </div>

                    {{-- Harga Max --}}
                    <div class="relative">
                        <select class="bg-white/10 border border-white/25
                                       text-white text-sm poppins-font
                                       pl-4 pr-9 py-[9px] rounded-xl
                                       outline-none cursor-pointer
                                       hover:bg-white/20 transition appearance-none">
                            <option class="text-[#0F172A] bg-white">Harga Max</option>
                            <option class="text-[#0F172A] bg-white">Rp 1.000.000</option>
                            <option class="text-[#0F172A] bg-white">Rp 2.000.000</option>
                            <option class="text-[#0F172A] bg-white">Rp 3.000.000</option>
                            <option class="text-[#0F172A] bg-white">Rp 5.000.000</option>
                        </select>
                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-white text-xs">▾</span>
                    </div>

                    {{-- Fasilitas --}}
                    <div class="relative">
                        <select class="bg-white/10 border border-white/25
                                       text-white text-sm poppins-font
                                       pl-4 pr-9 py-[9px] rounded-xl
                                       outline-none cursor-pointer
                                       hover:bg-white/20 transition appearance-none">
                            <option class="text-[#0F172A] bg-white">Fasilitas</option>
                            <option class="text-[#0F172A] bg-white">WiFi</option>
                            <option class="text-[#0F172A] bg-white">AC</option>
                            <option class="text-[#0F172A] bg-white">Kamar Mandi Dalam</option>
                            <option class="text-[#0F172A] bg-white">Parkir</option>
                        </select>
                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-white text-xs">▾</span>
                    </div>

                    {{-- Urutkan --}}
                    <div class="relative">
                        <select class="bg-white/10 border border-white/25
                                       text-white text-sm poppins-font
                                       pl-4 pr-9 py-[9px] rounded-xl
                                       outline-none cursor-pointer
                                       hover:bg-white/20 transition appearance-none">
                            <option class="text-[#0F172A] bg-white">Urutkan</option>
                            <option class="text-[#0F172A] bg-white">Harga Terendah</option>
                            <option class="text-[#0F172A] bg-white">Harga Tertinggi</option>
                            <option class="text-[#0F172A] bg-white">Rating Terbaik</option>
                        </select>
                        <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-white text-xs">▾</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- -----------------------------------------------
         RESULTS
         ----------------------------------------------- --}}
    <div class="max-w-[1204px] mx-auto px-8 pb-16">

        {{-- Result Count --}}
        <p class="poppins-font text-[15px] text-gray-500 mb-6">
            Menampilkan <span class="font-bold text-[#0F172A]">9</span>
            dari <span class="font-bold text-[#0F172A]">72</span> kos tersedia
        </p>

        {{-- ── DUMMY DATA ── --}}
        @php
        $kosData = [
            ['id'=>1,'tag'=>'CAMPUR – HEGARMANAH','nama'=>'Kos JatiNewYork',             'rating'=>'5.0','review'=>'300','harga'=>'Rp 5.000.000','img'=>'images/hero-kos.png'],
            ['id'=>2,'tag'=>'PUTRI – CISEKE',     'nama'=>'Kos Putri Tidur',              'rating'=>'4.9','review'=>'250','harga'=>'Rp 2.500.000','img'=>'images/hero-kos.png'],
            ['id'=>3,'tag'=>'PUTRA – CIKUDA',     'nama'=>'Kos Putra Laut',               'rating'=>'4.8','review'=>'125','harga'=>'Rp 1.250.000','img'=>'images/hero-kos.png'],
            ['id'=>4,'tag'=>'PUTRI – HEGARMANAH', 'nama'=>'Kos Mahaking Putri Eksklusif','rating'=>'4.7','review'=>'210','harga'=>'Rp 1.500.000','img'=>'images/hero-kos.png'],
            ['id'=>5,'tag'=>'CAMPUR – JATINANGOR','nama'=>'Kos Grand Jatinangor',         'rating'=>'4.6','review'=>'180','harga'=>'Rp 3.000.000','img'=>'images/hero-kos.png'],
            ['id'=>6,'tag'=>'PUTRA – RANCAEKEK',  'nama'=>'Kos Bintang Putra',            'rating'=>'4.5','review'=>'90', 'harga'=>'Rp 950.000',  'img'=>'images/hero-kos.png'],
            ['id'=>7,'tag'=>'CAMPUR – CIBEUSI',   'nama'=>'Kos Harmony Cibeusi',          'rating'=>'4.4','review'=>'75', 'harga'=>'Rp 1.800.000','img'=>'images/hero-kos.png'],
            ['id'=>8,'tag'=>'PUTRI – SAYANG',     'nama'=>'Kos Melati Putri',             'rating'=>'4.3','review'=>'55', 'harga'=>'Rp 1.200.000','img'=>'images/hero-kos.png'],
            ['id'=>9,'tag'=>'PUTRA – CILELES',    'nama'=>'Kos Perkasa Putra',            'rating'=>'4.2','review'=>'40', 'harga'=>'Rp 800.000',  'img'=>'images/hero-kos.png'],
        ];
        @endphp

        {{-- ── Grid 3 Kolom ── --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($kosData as $kos)

            <a href="{{ url('/kos/' . $kos['id']) }}"
               class="bg-white rounded-2xl overflow-hidden shadow-sm
                      hover:shadow-xl hover:-translate-y-1
                      transition-all duration-300 group block">

                {{-- Gambar --}}
                <div class="relative overflow-hidden h-[200px] bg-[#0F172A]">

                    <img src="{{ asset($kos['img']) }}"
                         alt="{{ $kos['nama'] }}"
                         class="w-full h-full object-cover
                                group-hover:scale-105 transition-transform duration-500"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">

                    {{-- Fallback placeholder --}}
                    <div class="absolute inset-0
                                bg-gradient-to-br from-[#0F172A] to-[#1e3a5f]
                                hidden items-center justify-center">
                        <svg class="w-14 h-14 text-[#D4AF37]/30" fill="none"
                             stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9"/>
                        </svg>
                    </div>

                </div>

                {{-- Body --}}
                <div class="p-5">

                    {{-- Tag --}}
                    <span class="poppins-font text-[11px] font-semibold tracking-wide
                                 text-[#D4AF37] bg-[#D4AF37]/10 border border-[#D4AF37]/30
                                 px-3 py-1 rounded-full inline-block mb-3">
                        {{ $kos['tag'] }}
                    </span>

                    {{-- Nama --}}
                    <h3 class="hero-font text-[#0F172A] text-[19px] font-bold mb-2
                               leading-snug group-hover:text-[#D4AF37] transition">
                        {{ $kos['nama'] }}
                    </h3>

                    {{-- Rating --}}
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-4 h-4 fill-[#D4AF37]" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="poppins-font text-[#D4AF37] font-bold text-sm">{{ $kos['rating'] }}</span>
                        <span class="poppins-font text-gray-400 text-sm">({{ $kos['review'] }} Review)</span>
                    </div>

                    {{-- Harga --}}
                    <div class="flex items-baseline gap-1">
                        <span class="hero-font text-[#0F172A] text-[20px] font-bold">{{ $kos['harga'] }}</span>
                        <span class="poppins-font text-gray-400 text-sm">/bulan</span>
                    </div>

                </div>

            </a>

            @endforeach

        </div>

        {{-- ── PAGINATION ── --}}
        <div class="flex justify-center items-center gap-2 mt-12">

            {{-- Prev --}}
            <button class="w-10 h-10 rounded-xl border border-gray-200 bg-white
                           flex items-center justify-center text-gray-400
                           hover:border-[#D4AF37] hover:text-[#D4AF37] transition
                           poppins-font text-lg font-light">
                ‹
            </button>

            @foreach ([1, 2, 3] as $page)
            <button class="w-10 h-10 rounded-xl border poppins-font text-sm font-semibold transition
                           {{ $page === 1
                               ? 'bg-[#D4AF37] border-[#D4AF37] text-white'
                               : 'bg-white border-gray-200 text-[#0F172A] hover:border-[#D4AF37] hover:text-[#D4AF37]' }}">
                {{ $page }}
            </button>
            @endforeach

            <span class="poppins-font text-gray-400 text-sm px-1 select-none">...</span>

            <button class="w-10 h-10 rounded-xl border border-gray-200 bg-white
                           poppins-font text-sm font-semibold text-[#0F172A]
                           hover:border-[#D4AF37] hover:text-[#D4AF37] transition">
                8
            </button>

            {{-- Next --}}
            <button class="w-10 h-10 rounded-xl border border-gray-200 bg-white
                           flex items-center justify-center text-gray-400
                           hover:border-[#D4AF37] hover:text-[#D4AF37] transition
                           poppins-font text-lg font-light">
                ›
            </button>

        </div>

    </div>

</div>

@endsection