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
    <header class="w-full fixed top-0 z-50">
        @include('partials.admin.navbar')
    </header>

    <div class="flex flex-1 pt-18"> {{-- Adjust 'pt-16' based on navbar height (e.g., 64px = 16 * 4px) --}}
        {{-- Sidebar --}}
        <aside class="fixed top-18 left-0 w-64 h-[calc(100vh-4rem)] bg-[#06003F] p-4 border-r z-40 overflow-y-auto">
            @include('partials.admin.sidebar')
        </aside>

        {{-- Main content with footer inside --}}
        <div class="flex flex-col flex-1 ml-64">
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
