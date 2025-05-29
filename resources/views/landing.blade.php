@extends('layouts.app')

@section('title', $title)

@section('content')
    {{-- Section: Hero / Jumbotron --}}
    <section class="bg-gray-50 pt-18 px-6">
        <div class="container mx-auto flex flex-col-reverse md:flex-row items-center gap-12 px-4 md:px-8">
            <div class="md:w-1/2 w-full text-center md:text-left">
                <h1 class="text-5xl font-bold text-[#06003F] leading-tight mb-6">
                    Selamat Datang di <span class="text-[#090445]">VoiceLib</span>
                </h1>
                <p class="text-lg text-gray-700 font-medium leading-relaxed mb-8 text-justify">
                    VoiceLib hadir untuk mendukung layanan perpustakaan yang inklusif bagi mahasiswa disabilitas netra di Universitas Negeri Malang. Situs VoiceLib menghadirkan pengalaman baru dengan menyediakan abstrak tugas akhir yang telah diubah menjadi audio. Jelajahi kemudahan dalam mengakses informasi perpustakaan, kapan pun dan di mana pun.
                </p>
                <a href="{{ route('landing.pilih.bahasa') }}" class="inline-block py-4 px-6 bg-[#090445] text-white text-lg font-semibold rounded-lg hover:bg-indigo-700 transition duration-300">
                    Mulai Sekarang
                </a>
            </div>
            <div class="md:w-1/2 w-full">
                <img src="{{ asset('images/hero.webp') }}" alt="VoiceLib Illustration" class="w-full rounded-xl shadow-lg">
            </div>
        </div>
        <div class="container mx-auto px-4 py-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#06003F] mb-6">
                Mulai Pencarian Referensi Sekarang
            </h2>
            <a href="{{ route('landing.pilih.bahasa') }}" class="inline-block py-4 px-6 bg-[#090445] text-white text-lg font-semibold rounded-lg hover:bg-indigo-700 transition duration-300">
                Mulai Sekarang
            </a>
        </div>
    </section>

    {{-- Section: About / Tentang Kami --}}
    <section class="py-8 md:py-12 bg-gray-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#06003F] mb-8">Tentang Kami</h2>
            <div class="max-w-3xl mx-auto">
                <p class="text-gray-800 text-lg leading-relaxed font-medium text-justify">
                    VoiceLib adalah platform “perpustakaan digital” yang mengonversi teks menjadi audio secara otomatis. Dikembangkan untuk mendukung mahasiswa disabilitas netra di Universitas Negeri Malang, VoiceLib diharapkan dapat menghadirkan akses informasi akademik yang lebih mudah, fleksibel, dan user-friendly.
                </p>
                <a href="{{ route('landing.about') }}" class="inline-block mt-10 py-4 px-6 bg-[#090445] text-white text-md font-semibold rounded-lg hover:bg-indigo-700 transition duration-300">
                    Simak lebih lanjut tentang kami
                </a>
            </div>
        </div>
    </section>
@endsection
