@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="py-12 px-4 sm:px-6 flex flex-col">
    <!-- Centered Card -->
    <div class="bg-white shadow-md rounded-lg px-4 sm:px-6 py-6 w-full max-w-lg mx-auto">
        <form method="GET" action="{{ route('hasil.audio') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <input type="hidden" name="language" value="{{ $language }}">

            <div class="relative flex-grow">
                <input
                    type="text"
                    name="keyword"
                    value="{{ $keyword }}"
                    placeholder="Ketik kata kunci judul, atau penulis ..."
                    class="w-full border border-gray-400 rounded-md pl-3 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445]"
                    required
                >
            </div>

            <button
                type="submit"
                class="flex items-center justify-center gap-2 bg-[#090445] text-white px-4 py-2 rounded-md hover:bg-[#090445e0]"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                Cari
            </button>
        </form>
    </div>

    <div class="mt-8 w-full px-4 sm:px-6 md:px-16">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Hasil Pencarian</h2>

        @if($keyword)
            <p class="text-sm text-gray-600 mb-4">
                Menampilkan {{ $results->total() }} hasil untuk kata kunci <strong>“{{ $keyword }}”</strong>.
            </p>
        @endif

        <div class="bg-white shadow-md rounded-lg p-4 sm:p-6">
            @forelse ($results as $index => $audio)
                <div class="flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-6 py-4">
                    <!-- Metadata -->
                    <div class="flex-1">
                        <p class="text-base font-semibold break-words">
                            {{ \Illuminate\Support\Str::limit($audio->collection->judul_tugas_akhir, 100) }}
                        </p>
                        <p class="text-sm text-gray-600 mt-1 italic">
                            {{ $audio->collection->nama_penulis }} | {{ $audio->collection->tahun_terbit }} | {{ $audio->collection->program_studi ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Play Button -->
                    <div class="w-full md:w-64 flex-shrink-0 flex justify-end items-center gap-4">
                        <audio id="audio-{{ $index }}">
                            <source src="data:audio/{{ strtolower($audio->format) }};base64,{{ $audio->base64 }}" 
                                    type="audio/{{ $audio->format === 'LINEAR16' ? 'wav' : strtolower($audio->format) }}">
                            Your browser does not support the audio element.
                        </audio>

                        <button 
                            data-audio-id="audio-{{ $index }}" 
                            id="btn-{{ $index }}" 
                            class="w-13 h-13 rounded-full bg-[#090445] text-white flex items-center justify-center shadow-md transition duration-300 hover:bg-[#090445]"
                        >
                            <svg id="icon-{{ $index }}" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" /> <!-- Play Icon -->
                            </svg>
                        </button>
                    </div>

                    <!-- Request Text Button -->
                    <div class="w-full md:w-auto">
                        <a
                            href="{{ route('permintaan.teks.lengkap', ['audioId' => $audio->id, 'redirect' => request()->fullUrl()]) }}"
                            class="block text-center px-4 py-2 rounded-md bg-[#090445] text-white font-semibold hover:bg-[#090445e0] focus:outline-none"
                        >
                            Minta Teks Lengkap
                        </a>
                    </div>
                </div>

                <script>
                    (() => {
                        const audio = document.getElementById('audio-{{ $index }}');
                        const button = document.getElementById('btn-{{ $index }}');
                        const icon = document.getElementById('icon-{{ $index }}');
                        let isPlaying = false;

                        button.addEventListener('click', () => {
                            if (isPlaying) {
                                audio.pause();
                            } else {
                                audio.play();
                            }
                        });

                        audio.addEventListener('play', () => {
                            isPlaying = true;
                            icon.innerHTML = '<path d="M6 4h4v16H6zm8 0h4v16h-4z" />'; // Pause
                        });

                        audio.addEventListener('pause', () => {
                            isPlaying = false;
                            icon.innerHTML = '<path d="M8 5v14l11-7z" />'; // Play
                        });
                    })();
                </script>

                @if (!$loop->last)
                    <hr class="border-t border-gray-300" />
                @endif
            @empty
                <p class="mt-4 text-gray-600">Tidak ada hasil ditemukan.</p>
            @endforelse

        </div>

        <div class="mt-4 flex flex-col sm:flex-row items-start sm:items-center justify-between text-sm text-gray-700 gap-2">
            <div>
                Menampilkan <span class="font-semibold">{{ $results->firstItem() }}</span> -
                <span class="font-semibold">{{ $results->lastItem() }}</span> dari
                <span class="font-semibold">{{ $results->total() }}</span> data
            </div>

            <div>
                {{ $results->links('vendor.pagination.custom-tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection
