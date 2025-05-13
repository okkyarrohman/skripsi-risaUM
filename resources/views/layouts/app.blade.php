<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome')</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-900 ">

    @include('partials.navbar')

    <main class="flex-grow container mx-auto">
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>
