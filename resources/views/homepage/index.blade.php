@extends('layouts.app')

@section('content')

<section
class="relative min-h-screen bg-cover bg-center"
style="background-image: url('{{ asset('images/hero-kos.png') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-[#0F172A]/75"></div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-24 pt-44">

        <!-- Hero Title -->
        <h1
        class="hero-font
               text-white
               text-[60px]
               font-bold
               leading-[1.05]">

            Temukan Kos
            <br>

            <span class="text-[#D4AF37]">
                Premium
            </span>

            di Jatinangor

        </h1>

        <!-- Search Bar -->
        <div
        class="mt-8
               flex items-center
               bg-white
               rounded-2xl
               overflow-hidden
               w-[620px]
               h-[64px]
               shadow-xl">

            <!-- Location Icon -->
            <div class="px-5">

                <img
                src="{{ asset('images/icons/location.svg') }}"
                alt="Location"
                class="w-5 h-5">

            </div>

            <!-- Input -->
            <input
            type="text"
            placeholder="Masukkan nama kos, daerah, kecamatan"
            class="flex-1
                   h-full
                   outline-none
                   text-gray-500
                   text-[15px]
                   poppins-font">

            <!-- Search Button -->
            <div
            class="mr-3
                   bg-[#D4AF37]
                   text-white
                   px-6
                   py-2
                   rounded-xl
                   text-sm
                   font-semibold
                   poppins-font
                   cursor-pointer
                   hover:opacity-90
                   transition">

                Cari Sekarang

            </div>

        </div>

        <!-- Features -->
        <div class="flex justify-center items-center gap-32 mt-20">

            <!-- Harga -->
            <div class="flex items-center gap-4">

                <img
                src="{{ asset('images/icons/money.svg') }}"
                alt="Harga"
                class="w-[76px] h-[76px]">

                <span
                class="hero-font
                       text-white
                       text-[16px]
                       font-bold">

                    Harga Terjangkau

                </span>

            </div>

            <!-- Fasilitas -->
            <div class="flex items-center justify-center gap-4 w-[320px]">

                <img
                src="{{ asset('images/icons/home.svg') }}"
                alt="Fasilitas"
                class="w-[76px] h-[76px]">

                <span
                class="hero-font
                       text-white
                       text-[16px]
                       font-bold">

                    Fasilitas Lengkap

                </span>

            </div>

            <!-- Lokasi -->
            <div class="flex items-center justify-center gap-4 w-[320px]">

                <img
                src="{{ asset('images/icons/map.svg') }}"
                alt="Lokasi"
                class="w-[76px] h-[76px]">

                <span
                class="hero-font
                       text-white
                       text-[16px]
                       font-bold">

                    Lokasi Strategis

                </span>

            </div>

        </div>

    </div>

</section>

@endsection