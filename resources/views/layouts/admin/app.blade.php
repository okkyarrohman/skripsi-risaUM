<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>

    {{-- Fonts & Tailwind CSS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-900 font-sans">

    {{-- Navbar --}}
    <header class="fixed top-0 left-0 right-0 z-50 bg-[#1E3A8A]">
        @include('partials.admin.navbar')
    </header>


    <div class="flex flex-1 pt-16"> {{-- pt-16 = navbar height --}}
        {{-- Sidebar --}}
        <aside id="sidebar" class="fixed top-16 left-0 h-[calc(100vh-4rem)] w-64 bg-[#06003F] p-4 border-r border-gray-800 overflow-y-auto
                                   transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
            @include('partials.admin.sidebar')
        </aside>

        {{-- Main content --}}
        <main class="flex-1 ml-0 lg:ml-64 p-4 overflow-auto">
            @yield('content')
        </main>
    </div>

    <footer class="bg-gray-800 text-white">
            @include('partials.admin.footer')
        </div>
    </footer>

    @yield('script')
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

</body>
</html>
