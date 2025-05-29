@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="py-12 px-6 flex flex-col">
    <!-- Centered Card Only -->
    <div class="bg-white shadow-md rounded-lg px-6 py-6 w-full max-w-lg mx-auto">
        <form method="GET" action="{{ route('hasil.audio') }}" class="flex items-center gap-3">
            <input type="hidden" name="language" value="{{ $language }}">

            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 15a3 3 0 0 0 3-3V6a3 3 0 1 0-6 0v6a3 3 0 0 0 3 3Zm5.5-3a5.5 5.5 0 0 1-11 0H5a7 7 0 0 0 14 0h-1.5ZM11 19v2h2v-2h-2Z"/>
                    </svg>
                </div>
                <input
                    type="text"
                    name="keyword"
                    value={{ $keyword }}
                    placeholder="Ketik kata kunci judul, atau penulis ..."
                    class="w-full border border-gray-400 rounded-md pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445]"
                    required
                >
            </div>

            <button
                type="submit"
                class="flex items-center gap-2 bg-[#090445] text-white px-6 py-2 rounded-md hover:bg-[#090445e0] hover:cursor-pointer"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                Cari
            </button>
        </form>
    </div>

    <div class="mt-8 w-full px-16">
        <h2 class="text-3xl font-bold text-gray-800">Hasil Pencarian</h2>

        @if($keyword)
            <p class="text-sm text-gray-600 mb-4">
                Menampilkan {{ $results->total() }} hasil untuk kata kunci <strong>“{{ $keyword }}”</strong>.
            </p>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6">
            @forelse ($results as $audio)
                <div class="flex items-center gap-6 py-4">
                    <div class="flex-1">
                        <p class="text-base font-semibold break-words">
                            {{ \Illuminate\Support\Str::limit($audio->collection->judul_tugas_akhir, 100) }}
                        </p>
                        <p class="text-sm text-gray-600 mt-1 italic">
                            {{ $audio->collection->nama_penulis }} | {{ $audio->collection->tahun_terbit }} | {{ $audio->collection->program_studi ?? 'N/A' }}
                        </p>
                    </div>

                    <div>
                        <audio controls class="max-w-xs rounded-md">
                            <source src="data:audio/{{ strtolower($audio->format) }};base64,{{ $audio->base64 }}" 
                                    type="audio/{{ $audio->format === 'LINEAR16' ? 'wav' : strtolower($audio->format) }}">
                            Your browser does not support the audio element.
                        </audio>
                    </div>

                    <div>
                        <button
                            type="button"
                            class="px-4 py-2 rounded-md bg-[#090445] text-white font-semibold hover:bg-[#090445e0] focus:outline-none"
                        >
                            Minta Teks Lengkap
                        </button>
                    </div>
                </div>

                @if (!$loop->last)
                    <hr class="border-t border-gray-300" />
                @endif
            @empty
                <p class="mt-4 text-gray-600">Tidak ada hasil ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-4 flex items-center justify-between text-sm text-gray-700">
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
