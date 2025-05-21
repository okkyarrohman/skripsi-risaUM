<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

use App\Models\Collection;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Collection::create([
            'judul_tugas_akhir' => 'Sistem Informasi Perpustakaan',
            'nama_penulis' => 'Ahmad Fauzi',
            'nama_pembimbing' => 'Dr. Budi Santoso',
            'program_studi' => 'Teknik Informatika',
            'fakultas' => 'Fakultas Teknik',
            'tahun_terbit' => 2023,
            'abstrak_indo' => 'Penelitian ini membahas tentang ...',
            'abstrak_eng' => 'This research discusses ...',
            'nomer_reg' => 'TI-2023-001',
            'kata_kunci' => 'perpustakaan, sistem informasi, database',
            'tanggal_unggah' => Carbon::now()->toDateString(),
            'status' => 'Dipublikasikan',
        ]);
    }
}
