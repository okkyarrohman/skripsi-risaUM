<footer class="bg-[#1E3A8A] text-gray-700 shadow-inner">
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-1 gap-6 p-6 items-center text-sm">

        {{-- Logo & Copyright --}}
        <div class="flex flex-col items-center justify-center text-center">
            <img src="{{ asset('images/logoum.png') }}" alt="Logo" class="h-36 mb-2">
            <p class="text-xl font-bold text-white">VoiceLibM</p>
            <p class="text-xs text-white">&copy; {{ date('Y') }}</p>
        </div>

    </div>
</footer>
