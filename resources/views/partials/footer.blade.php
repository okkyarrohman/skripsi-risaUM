<footer class="bg-gray-100 text-gray-700 shadow-inner">
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-3 gap-6 p-6 items-center text-sm">

        {{-- Jam Layanan (Left Column - Fixed Text Alignment) --}}
        <div class="flex flex-col sm:items-start text-left">
            <h3 class="font-semibold mb-2">Jam Layanan</h3>
            <ul class="space-y-1">
                <li>Senin-Kamis 07.00-20.00</li>
                <li>Jumat 07.30-17.00</li>
                <li>Sabtu 08.00-16.00</li>
            </ul>
        </div>

        {{-- Logo & Copyright --}}
        <div class="flex flex-col items-center justify-center text-center">
            <img src="{{ asset('images/logoum.png') }}" alt="Logo" class="h-16 mb-2">
            <p class="text-xs">&copy; {{ date('Y') }} MySite. All rights reserved.</p>
            <p class="text-xs">&copy; {{ date('Y') }} MySite. All rights reserved.</p>
            <p class="text-xs">&copy; {{ date('Y') }} MySite. All rights reserved.</p>
        </div>

        {{-- Google Maps --}}
        <div class="flex flex-col sm:items-end text-left sm:text-right">
            <h3 class="font-semibold mb-2">Lokasi</h3>
            <div class="w-40 h-40">
                <iframe
                    class="w-full h-full rounded border"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.7591458438257!2d106.8283!3d-6.1754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTAnMzEuNCJTIDEwNsKwNDknNDIuMCJF!5e0!3m2!1sen!2sid!4v1610012345678"
                    frameborder="0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
</footer>
