{{-- resources/views/homepage/index.blade.php --}}
@extends('layouts.app')

@section('content')

<section
    class="relative w-full min-h-screen bg-cover bg-center"
    style="background-image: url('{{ asset('images/hero-kos.png') }}');">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-[#0F172A]/75 z-0"></div>

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- ── CONTENT WRAPPER ── --}}
    <div class="relative z-10 flex flex-col items-start
                max-w-7xl mx-auto px-24 pt-44 pb-16">

        {{-- HERO TITLE --}}
        <h1 class="hero-font
                   text-white
                   text-[62px]
                   font-bold
                   leading-[1.08]">

            Temukan Kos
            <br>
            <span class="text-[#D4AF37]">Premium</span>
            di Jatinangor

        </h1>

        {{-- SEARCH BAR --}}
        <form
            action="{{ url('/kos') }}"
            method="GET"
            class="mt-8
                   flex items-center
                   bg-white
                   rounded-2xl
                   overflow-hidden
                   w-[620px]
                   h-[64px]
                   shadow-2xl">

            <div class="px-5 flex-shrink-0">
                <svg class="w-5 h-5 text-gray-400"
                     fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 2C8.686 2 6 4.686 6 8c0 5.25 6 13 6 13S18 13.25 18 8c0-3.314-2.686-6-6-6z"/>
                    <circle cx="12" cy="8" r="2.5" fill="currentColor" stroke="none"/>
                </svg>
            </div>

            <input
                type="text"
                name="q"
                placeholder="Masukkan nama kos, daerah, kecamatan"
                class="flex-1 h-full outline-none
                       text-gray-500 text-[15px] poppins-font bg-transparent">

            <button
                type="submit"
                class="mr-3
                       bg-[#D4AF37] text-white
                       px-6 py-2 rounded-xl
                       text-sm font-semibold poppins-font
                       hover:opacity-90 transition
                       flex items-center flex-shrink-0 whitespace-nowrap">
                Cari Sekarang
            </button>

        </form>

        {{-- ── FEATURE ICONS — di bawah search bar, center penuh ── --}}
        <div class="mt-20 grid w-full grid-cols-3">

            {{-- Harga Terjangkau --}}
            <div class="flex items-center justify-start gap-4">
                <img
                    src="{{ asset('images/icons/money.svg') }}"
                    alt="Harga terjangkau"
                    class="h-[76px] w-[79px] shrink-0 object-contain">

                <span class="hero-font text-left text-[14px] font-bold leading-snug text-[#D4AF37]">
                    Harga<br>Terjangkau
                </span>
            </div>

            {{-- Fasilitas Lengkap --}}
            <div class="flex items-center justify-center gap-4">
                <img
                    src="{{ asset('images/icons/home.svg') }}"
                    alt="Fasilitas lengkap"
                    class="h-[76px] w-[79px] shrink-0 object-contain">

                <span class="hero-font whitespace-nowrap text-left text-[14px] font-bold leading-snug text-white">
                    Fasilitas Lengkap
                </span>
            </div>

            {{-- Lokasi Strategis --}}
            <div class="flex items-center justify-end gap-4">
                <img
                    src="{{ asset('images/icons/map.svg') }}"
                    alt="Lokasi strategis"
                    class="h-[76px] w-[79px] shrink-0 object-contain">

                <span class="hero-font whitespace-nowrap text-left text-[14px] font-bold leading-snug text-white">
                    Lokasi Strategis
                </span>
            </div>

        </div>

    </div>

</section>

@endsection
