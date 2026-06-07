{{--
    resources/views/layouts/navbar.blade.php

    PENGGUNAAN:
    - Homepage  → @include('layouts.navbar')          → absolute, transparan, no rounded
    - Lain-lain → @include('layouts.navbar', ['solid' => true]) → sticky, solid, rounded pill
--}}

@if(isset($solid) && $solid)

    {{-- =====================================================
         NAVBAR SOLID — untuk halaman selain homepage
         sticky di atas, rounded pill, ada hamburger
         ===================================================== --}}
    <header class="sticky top-0 z-50 bg-[#0F172A] w-full px-8 py-4">

        <nav class="flex items-center
                    bg-[#0F172A]
                    border border-white/10
                    rounded-[20px]
                    h-[54px]
                    px-6
                    max-w-[1204px]
                    mx-auto">

            <div class="flex items-center h-full w-full">

                {{-- Hamburger --}}
                <button class="text-white mr-4 hover:text-[#D4AF37] transition flex-shrink-0"
                        aria-label="Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="3" y1="6"  x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>

                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center gap-2 flex-shrink-0">

                    <img src="{{ asset('images/icons/crown.svg') }}"
                         alt="Mahaking Crown"
                         class="w-7 h-7">

                    <span class="logo-font text-[#E2C17D] text-[20px] font-bold leading-none">
                        MAHAKING KOS
                    </span>

                </a>

                {{-- Menu --}}
                <div class="flex items-center gap-8 ml-auto">

                    <a href="{{ url('/') }}"
                       class="menu-font text-[15px] transition
                              {{ request()->is('/') ? 'text-[#D4AF37]' : 'text-white hover:text-[#D4AF37]' }}">
                        Home
                    </a>

                    <a href="{{ url('/wishlist') }}"
                       class="menu-font text-[15px] transition
                              {{ request()->is('wishlist*') ? 'text-[#D4AF37]' : 'text-white hover:text-[#D4AF37]' }}">
                        Wishlist
                    </a>

                    <a href="#"
                       class="menu-font text-[15px] text-white hover:text-[#D4AF37] transition">
                        Service
                    </a>

                    {{-- DAFTAR — solid gold --}}
                    <a href="{{ url('/register') }}"
                       class="poppins-font
                              text-[#0F172A]
                              text-[13px]
                              font-bold
                              bg-[#D4AF37]
                              px-5 py-2
                              rounded-full
                              hover:brightness-110
                              transition
                              flex-shrink-0">
                        DAFTAR
                    </a>

                    {{-- LOGIN — outline gold --}}
                    <a href="{{ url('/login') }}"
                       class="poppins-font
                              text-[#D4AF37]
                              text-[13px]
                              font-bold
                              border-2 border-[#D4AF37]
                              px-5 py-2
                              rounded-full
                              hover:bg-[#D4AF37]
                              hover:text-[#0F172A]
                              transition
                              flex-shrink-0">
                        LOGIN
                    </a>

                </div>

            </div>

        </nav>

    </header>

@else

    {{-- =====================================================
         NAVBAR HOMEPAGE — absolute overlay di atas hero
         transparan, no rounded, full-width
         ===================================================== --}}
    <nav class="absolute top-5 left-1/2 -translate-x-1/2
                w-[90%] max-w-[1204px]
                h-[50px]
                bg-[#0F172A]/95
                rounded-[20px]
                px-8
                z-50">

        <div class="flex items-center h-full">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3">

                <img src="{{ asset('images/icons/crown.svg') }}"
                     alt="Mahaking Crown"
                     class="w-8 h-8">

                <h1 class="logo-font text-[#E2C17D] text-[24px] font-bold leading-none">
                    MAHAKING KOS
                </h1>

            </a>

            {{-- Menu --}}
            <div class="flex items-center gap-10 ml-auto">

                {{-- Search → ke /kos --}}
                <a href="{{ url('/kos') }}"
                   class="menu-font text-white text-[16px] hover:text-[#D4AF37] transition">
                    Search
                </a>

                <a href="{{ url('/wishlist') }}"
                   class="menu-font text-white text-[16px] hover:text-[#D4AF37] transition">
                    Wishlist
                </a>

                <a href="#"
                   class="menu-font text-white text-[16px] hover:text-[#D4AF37] transition">
                    Service
                </a>

                {{-- DAFTAR — solid gold --}}
                <a href="{{ url('/register') }}"
                   class="poppins-font
                          text-[#0F172A]
                          text-[14px]
                          font-bold
                          bg-[#D4AF37]
                          px-5 py-2
                          rounded-full
                          hover:brightness-110
                          transition">
                    DAFTAR
                </a>

                {{-- LOGIN — outline gold --}}
                <a href="{{ url('/login') }}"
                   class="poppins-font
                          text-[#D4AF37]
                          text-[14px]
                          font-bold
                          border-2 border-[#D4AF37]
                          px-5 py-2
                          rounded-full
                          hover:bg-[#D4AF37]
                          hover:text-[#0F172A]
                          transition">
                    LOGIN
                </a>

            </div>

        </div>

    </nav>

@endif