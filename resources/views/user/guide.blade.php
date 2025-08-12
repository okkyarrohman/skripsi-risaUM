@extends('layouts.app')

@section('title', $title)

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-10 text-[#06003F]">
        <div class="flex items-center justify-center gap-3 mb-10">
            <h1 class="text-center text-4xl font-bold">Panduan Pengguna</h1>
        <!-- Tombol Play -->
        <button id="playAudioBtn" class="bg-[#06003F] hover:bg-[#0a0560] text-white rounded-full p-3 shadow-md transition"
            title="Putar Panduan">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.752 11.168l-5.197-3.027A1 1 0 008 9.027v5.946a1 1 0 001.555.832l5.197-3.027a1 1 0 000-1.664z" />
            </svg>
        </button>
        </div>

        <!-- Audio Panduan -->
        <audio id="guideAudio" src="{{ asset('images/audio/guide.mp3') }}"></audio>

        <ol class="list-decimal list-inside space-y-4 prose prose-lg text-justify text-lg mx-auto max-w-3xl mb-4 leading-loose">
            <li>Buka situs VoiceLib melalui browser pada perangkat Anda.</li>
            <li>Klik tombol <strong>“Mulai Sekarang”</strong> di halaman utama (beranda).</li>
            <li>Pilih bahasa audio yang Anda inginkan untuk mendengarkan abstrak.</li>
            <li>Masukkan kata kunci, misalnya judul, subjek, atau nama penulis.</li>
            <li>Nikmati koleksi audio abstrak tugas akhir yang tersedia di UPT Perpustakaan UM.</li>
            <li>Jika ingin melihat dokumen lengkap, klik <strong>“Minta Teks Lengkap”</strong>, lalu isi data seperti nama, NIM, program studi/fakultas, dan nomor WhatsApp Anda.</li>
            <li>Selanjutnya, datang langsung ke UPT Perpustakaan UM untuk verifikasi sebagai mahasiswa tuna netra. Sampaikan kepada petugas bahwa Anda telah mengajukan permintaan akses teks lengkap melalui VoiceLib. Setelah verifikasi selesai, tautan teks lengkap akan dikirimkan ke WhatsApp Anda.</li>
        </ol>
    </section>

    <script>
    document.getElementById('playAudioBtn').addEventListener('click', function() {
        const audio = document.getElementById('guideAudio');
        const icon = this.querySelector('svg');

        if (audio.paused) {
            audio.play();
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 9v6m4-6v6" />`; // ikon pause
        } else {
            audio.pause();
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14.752 11.168l-5.197-3.027A1 1 0 008 9.027v5.946a1 1 0 001.555.832l5.197-3.027a1 1 0 000-1.664z" />`; // ikon play
        }
    });
    </script>
@endsection
