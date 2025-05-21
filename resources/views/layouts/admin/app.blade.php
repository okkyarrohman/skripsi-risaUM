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
<body class="flex flex-col min-h-screen bg-white text-gray-900 ">

    @include('partials.admin.navbar')

    <div class="flex flex-1">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-100 p-4 border-r border-gray-200">
            @include('partials.admin.sidebar')
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-4">
            @yield('content')
        </main>
    </div>

    @include('partials.admin.footer')

</body>
</html>
