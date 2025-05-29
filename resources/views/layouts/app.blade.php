<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="VoiceLib adalah layanan perpustakaan inklusif Universitas Negeri Malang untuk mahasiswa disabilitas netra, menyediakan abstrak tugas akhir dalam bentuk audio.">
    <title>@yield('title')</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-900 ">

    @include('partials.navbar')

    <main class="">
        @yield('content')
    </main>

    @include('partials.footer')

    @yield('script')

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#090445',
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
    @endif

</body>
</html>
