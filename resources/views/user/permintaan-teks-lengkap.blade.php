@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="py-8 md:py-24 p-6 flex flex-col justify-center items-center bg-[#06003F]">
    <h1 class="text-4xl text-white max-w-xl text-center font-bold mb-8">
        Permintaan Teks Lengkap
    </h1>

    <div class="bg-white shadow-md rounded-lg px-6 py-4 w-full max-w-2xl">
        <p id="deskripsiForm" class="text-gray-700 mb-6">
            Silakan isi Nama, NIM, Program Studi/Fakultas, dan Nomor WhatsApp Anda. Setelah data terkirim, harap datang ke Perpustakaan UM untuk verifikasi tunanetra. Tautan teks lengkap akan dikirimkan melalui WhatsApp setelah verifikasi selesai.
        </p>

        <form aria-describedby="deskripsiForm" method="POST" action="{{ route('kirim.permintaan.teks.lengkap', ['audioId' => $audio->id]) }}">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama</label>
                <input id="nama" name="nama" type="text" required
                       placeholder="Masukkan Nama"
                       autocomplete="name"
                       value="{{ old('nama') }}"
                       class="w-full border border-gray-400 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445] @error('nama') border-red-500 @enderror">
                @error('nama')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nim" class="block text-gray-700 font-semibold mb-1">NIM</label>
                <input id="nim" name="nim" type="text" required
                       placeholder="Masukkan NIM"
                       autocomplete="student-id"
                       value="{{ old('nim') }}"
                       class="w-full border border-gray-400 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445] @error('nim') border-red-500 @enderror">
                @error('nim')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="prodi" class="block text-gray-700 font-semibold mb-1">Program Studi / Fakultas</label>
                <input id="prodi" name="prodi" type="text" required
                       placeholder="Masukkan Program Studi"
                       autocomplete="organization"
                       value="{{ old('prodi') }}"
                       class="w-full border border-gray-400 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445] @error('prodi') border-red-500 @enderror">
                @error('prodi')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="whatsapp" class="block text-gray-700 font-semibold mb-1">No WhatsApp</label>
                <input id="whatsapp" name="whatsapp" type="text" required
                       placeholder="Masukkan Nomor WhatsApp"
                       autocomplete="tel"
                       value="{{ old('whatsapp') }}"
                       class="w-full border border-gray-400 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445] @error('whatsapp') border-red-500 @enderror">
                @error('whatsapp')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-1/2 mx-auto block bg-[#090445] text-white font-semibold px-4 py-2 rounded-md hover:bg-[#090445e0] focus:outline-none"
            >
                Kirim
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[method="POST"]');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Loading...';
    });
});
</script>
@endsection
