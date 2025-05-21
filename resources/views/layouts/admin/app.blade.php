<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-900">

    {{-- Navbar --}}
    @include('partials.admin.navbar')

    <div class="flex flex-1">
        {{-- Sidebar --}}
        <aside class="w-64 bg-[#06003F] p-4 border-r">
            @include('partials.admin.sidebar')
        </aside>

        {{-- Main content with footer inside --}}
        <div class="flex flex-col flex-1 justify-between">
            <main class="p-4 flex-grow">
                @yield('content')
            </main>

            <footer class="bg-gray-100 border-t border-gray-200 text-center">
                @include('partials.admin.footer')
            </footer>
        </div>
    </div>

</body>

</html>
