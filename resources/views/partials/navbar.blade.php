<nav class="bg-[#1E3A8A] text-white shadow">
    <div class="container mx-auto flex items-center justify-between px-4 py-3">
        {{-- Brand --}}
        <a href="{{ route('landing.index') }}" class="block no-underline text-inherit">
            <div class="leading-tight">
                <div class="flex items-center gap-1 text-2xl font-bold">
                    VoiceLib
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-6 text-white" viewBox="0 0 24 24">
                        <path d="M8.25 4.5a3.75 3.75 0 1 1 7.5 0v8.25a3.75 3.75 0 1 1-7.5 0V4.5Z" />
                        <path d="M6 10.5a.75.75 0 0 1 .75.75v1.5a5.25 5.25 0 1 0 10.5 0v-1.5a.75.75 0 0 1 1.5 0v1.5a6.751 6.751 0 0 1-6 6.709v2.291h3a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1 0-1.5h3v-2.291a6.751 6.751 0 0 1-6-6.709v-1.5A.75.75 0 0 1 6 10.5Z" />
                    </svg>
                </div>
                <div class="text-md font-bold">UPT Perpustakaan UM</div>
            </div>
        </a>

        {{-- Hamburger Button --}}
        <button id="mobileMenuToggle" class="lg:hidden focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- Desktop Menu --}}
        <div class="hidden lg:flex space-x-8 text-sm sm:text-base font-bold">
            <a href="{{ route('landing.index') }}" 
                class="relative pb-1 {{ request()->routeIs('landing.index') ? 'border-b-3 border-white' : 'hover:border-b-3 hover:border-white' }}">
                Beranda
            </a>
            <a href="{{ route('landing.guide') }}" 
                class="relative pb-1 {{ request()->routeIs('landing.guide') ? 'border-b-3 border-white' : 'hover:border-b-3 hover:border-white' }}">
                Panduan
            </a>
            <a href="{{ route('landing.about') }}" 
                class="relative pb-1 {{ request()->routeIs('landing.about') ? 'border-b-3 border-white' : 'hover:border-b-3 hover:border-white' }}">
                Tentang Kami
            </a>
            <a href="{{ route('login') }}" 
                class="relative pb-1 {{ request()->is('login') ? 'border-b-3 border-white' : 'hover:border-b-3 hover:border-white' }}">
                Masuk Admin
            </a>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="lg:hidden hidden px-4 pb-3 flex flex-col gap-2 bg-[#1E3A8A] text-sm font-bold">
    <a href="{{ route('landing.index') }}"
       class="relative pb-1 border-b-3 transition-all duration-200
              {{ request()->routeIs('landing.index') ? 'border-white' : 'border-transparent hover:border-white' }}">
        Beranda
    </a>
    <a href="{{ route('landing.guide') }}"
       class="relative pb-1 border-b-3 transition-all duration-200
              {{ request()->routeIs('landing.guide') ? 'border-white' : 'border-transparent hover:border-white' }}">
        Panduan
    </a>
    <a href="{{ route('landing.about') }}"
       class="relative pb-1 border-b-3 transition-all duration-200
              {{ request()->routeIs('landing.about') ? 'border-white' : 'border-transparent hover:border-white' }}">
        Tentang Kami
    </a>
    <a href="{{ route('login') }}"
       class="relative pb-1 border-b-3 transition-all duration-200
              {{ request()->is('login') ? 'border-white' : 'border-transparent hover:border-white' }}">
        Masuk Admin
    </a>
</div>

</nav>

<script>
    docu
    ent.getElementById('mobileMenuToggle').addEventListener('click', function () {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    });
</script>
