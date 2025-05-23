@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<section class="max-w-6xl mx-auto px-4 py-10 text-[#06003F]">
    <h1 class="text-center text-4xl font-bold mb-10">Panduan Admin</h1>

    <ol class="list-decimal list-inside space-y-4 prose prose-lg text-justify text-lg mx-auto max-w-3xl mb-4">
        <li>Masuk ke sistem VoiceLib melalui akun admin.</li>
        <li>Gunakan menu navigasi di sebelah kiri untuk memilih halaman yang ingin dikelola.</li>
        <li>Pada menu <strong>Dashboard</strong>, Anda dapat melihat ringkasan aktivitas sistem.</li>
        <li>Gunakan menu <strong>Kelola Data Koleksi</strong> untuk menambahkan, mengedit, atau menghapus data tugas akhir.</li>
        <li>Pada menu <strong>Data Audio</strong>, Anda dapat mengunggah atau mengelola file audio abstrak.</li>
        <li>Gunakan menu <strong>Data Mahasiswa</strong> untuk memverifikasi atau melihat informasi mahasiswa tuna netra yang telah terdaftar.</li>
        <li>Pada menu <strong>Permintaan Full Akses</strong>, tinjau permintaan teks lengkap dari mahasiswa dan verifikasi kelayakannya.</li>
        <li>Setelah verifikasi, kirim tautan dokumen lengkap ke WhatsApp mahasiswa sesuai permintaan.</li>
    </ol>
</section>
@endsection