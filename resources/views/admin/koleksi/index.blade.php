@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold text-[#06003F]">Data Koleksi Abstrak</h1>
    <div class="flex space-x-4">
        <!-- Tambah Data Button -->
        <a href="{{ route('admin.koleksi.create') }}" class="px-4 py-2 text-white rounded-lg shadow hover:opacity-90 transition" style="background-color: #090445;">
            + Tambah Data
        </a>

        <!-- Import Data Button with Icon -->
        <a href="{{ route('admin.koleksi.import') }}" class="flex items-center px-4 py-2 bg-white border border-gray-400 text-black rounded-lg shadow hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 50 50">
                <path d="M 28.875 0 C 28.855469 0.0078125 28.832031 0.0195313 28.8125 0.03125 L 0.8125 5.34375 C 0.335938 5.433594 -0.0078125 5.855469 0 6.34375 L 0 43.65625 C -0.0078125 44.144531 0.335938 44.566406 0.8125 44.65625 L 28.8125 49.96875 C 29.101563 50.023438 29.402344 49.949219 29.632813 49.761719 C 29.859375 49.574219 29.996094 49.296875 30 49 L 30 44 L 47 44 C 48.09375 44 49 43.09375 49 42 L 49 8 C 49 6.90625 48.09375 6 47 6 L 30 6 L 30 1 C 30.003906 0.710938 29.878906 0.4375 29.664063 0.246094 C 29.449219 0.0546875 29.160156 -0.0351563 28.875 0 Z M 28 2.1875 L 28 6.53125 C 27.867188 6.808594 27.867188 7.128906 28 7.40625 L 28 42.8125 C 27.972656 42.945313 27.972656 43.085938 28 43.21875 L 28 47.8125 L 2 42.84375 L 2 7.15625 Z M 30 8 L 47 8 L 47 42 L 30 42 L 30 37 L 34 37 L 34 35 L 30 35 L 30 29 L 34 29 L 34 27 L 30 27 L 30 22 L 34 22 L 34 20 L 30 20 L 30 15 L 34 15 L 34 13 L 30 13 Z M 36 13 L 36 15 L 44 15 L 44 13 Z M 6.6875 15.6875 L 12.15625 25.03125 L 6.1875 34.375 L 11.1875 34.375 L 14.4375 28.34375 C 14.664063 27.761719 14.8125 27.316406 14.875 27.03125 L 14.90625 27.03125 C 15.035156 27.640625 15.160156 28.054688 15.28125 28.28125 L 18.53125 34.375 L 23.5 34.375 L 17.75 24.9375 L 23.34375 15.6875 L 18.65625 15.6875 L 15.6875 21.21875 C 15.402344 21.941406 15.199219 22.511719 15.09375 22.875 L 15.0625 22.875 C 14.898438 22.265625 14.710938 21.722656 14.5 21.28125 L 11.8125 15.6875 Z M 36 20 L 36 22 L 44 22 L 44 20 Z M 36 27 L 36 29 L 44 29 L 44 27 Z M 36 35 L 36 37 L 44 37 L 44 35 Z"></path>
            </svg>
            Import Data
        </a>
    </div>
</div>

<div class="flex items-center space-x-2">
    <!-- Search input with icon -->
    <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
        </span>
        <input
            type="text"
            name="search"
            placeholder="Cari..."
            class="pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>

    <!-- Sort select -->
    <select name="sort" class="px-2 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="terbaru">Urutkan: Terbaru</option>
        <option value="terlama">Urutkan: Terlama</option>
        <option value="judul_asc">Judul A-Z</option>
        <option value="judul_desc">Judul Z-A</option>
    </select>

    <!-- Button with plus-style icon -->
    <button class="p-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3 9h11M3 15h7M3 3h16m-.5 18V9m0 12c-.7 0-2.009-1.994-2.5-2.5m2.5 2.5c.7 0 2.009-1.994 2.5-2.5"
                color="currentColor" />
        </svg>
    </button>
</div>

{{-- Table --}}
<h1 class="text-2xl font-semibold text-[#06003F] py-4 pt-8">Kelola Data Koleksi</h1>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3">No.</th>
                <th scope="col" class="px-6 py-3">Judul Tugas Akhir</th>
                <th scope="col" class="px-6 py-3">Nama Penulis</th>
                <th scope="col" class="px-6 py-3">Nama Pembimbing</th>
                <th scope="col" class="px-6 py-3">Program Studi</th>
                <th scope="col" class="px-6 py-3">Fakultas</th>
                <th scope="col" class="px-6 py-3">Tahun Terbit</th>
                <th scope="col" class="px-6 py-3">Detail</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collections as $index => $collection)
            <tr class="bg-white border-b border-gray-200 hover:bg-gray-100">
                <td class="px-6 py-4">{{ $collections->firstItem() + $index }}</td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $collection->judul_tugas_akhir }}
                </th>
                <td class="px-6 py-4">{{ $collection->nama_penulis }}</td>
                <td class="px-6 py-4">{{ $collection->nama_pembimbing }}</td>
                <td class="px-6 py-4">{{ $collection->program_studi }}</td>
                <td class="px-6 py-4">{{ $collection->fakultas }}</td>
                <td class="px-6 py-4">{{ $collection->tahun_terbit }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.koleksi.show', $collection->id) }}" class="text-blue-600 hover:underline">Detail</a>
                </td>
                <td class="px-6 py-4">
                    <form action="{{ route('admin.koleksi.destroy', $collection->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4 flex items-center justify-between text-sm text-gray-700">
    <!-- Left: Showing items summary -->
    <div>
        Menampilkan <span class="font-semibold">{{ $collections->firstItem() }}</span> -
        <span class="font-semibold">{{ $collections->lastItem() }}</span> dari
        <span class="font-semibold">{{ $collections->total() }}</span> data
    </div>

    <!-- Right: Pagination links -->
    <div>
        {{ $collections->links('vendor.pagination.custom-tailwind') }}
    </div>
</div>


@endsection
