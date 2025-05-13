@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Section: Jumbotron --}}
    <section class="bg-gray-100 py-16 px-6">
        <div class="container mx-auto flex flex-col md:flex-row items-start md:flex-wrap px-4">
            <div class="md:w-1/2 w-full mb-8 md:mb-0">
                <h2 class="text-4xl font-bold mb-4">Selamat Datang di VoiceLib!</h2>
                <p class="text-gray-700 text-justify text-3xl font-semibold">
                    VoiceLib hadir untuk mendukung layanan perpustakaan yang inklusif bagi mahasiswa disabilitas netra di Universitas Negeri Malang. Situs VoiceLib menghadirkan pengalaman baru dengan menyediakan abstrak tugas akhir yang telah diubah menjadi audio. Jelajahi kemudahan dalam mengakses informasi perpustakaan, kapan pun dan di mana pun.
                </p>
                <!-- Button Added Here -->
                <a href="#mulai" class="inline-block mt-8 py-3 px-8 bg-[#090445] text-white text-2xl font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                    Mulai Sekarang
                </a>
            </div>
            <div class="md:w-1/2 w-full px-8 md:px-10">
                <img src="{{ asset('images/hero.png') }}" alt="Digital Solutions" class="w-full rounded-lg">
            </div>
        </div>
    </section>

    {{-- Section: Layanan --}}
    <section class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-6">Layanan Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-1">
            <div class="flex flex-col items-center">
                <p class="text-gray-600 text-justify w-1/2">
                    VoiceLib adalah platform “perpustakaan digital” yang mengonversi teks menjadi audio secara otomatis. Dikembangkan untuk mendukung mahasiswa disabilitas netra di Universitas Negeri Malang, VoiceLib diharapkan dapat menghadirkan akses informasi akademik yang lebih mudah, fleksibel, dan user-friendly.
                </p>
            </div>
        </div>
    </div>
</section>




@endsection
