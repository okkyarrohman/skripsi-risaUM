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
        for ($i = 1; $i <= 1000; $i++) {
            Collection::create([
                'judul_tugas_akhir' => "Sistem Informasi Perpustakaan Vol. $i",
                'nama_penulis' => "Ahmad Fauzi $i",
                'nama_pembimbing' => "Dr. Budi Santoso",
                'program_studi' => 'Teknik Informatika',
                'fakultas' => 'Fakultas Teknik',
                'tahun_terbit' => 2023,
                'abstrak_indo' => "Penelitian ini membahas tentang topik ke-$i ...",
                'abstrak_eng' => "This research discusses topic number $i ...",
                'nomer_reg' => "TI-2023-" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'kata_kunci' => 'perpustakaan, sistem informasi, database',
                'tanggal_unggah' => Carbon::createFromTimestamp(
                    rand(
                        Carbon::now()->subYears(2)->timestamp,
                        Carbon::now()->timestamp
                    )
                )->toDateString(),
                'status' => 'Belum Tersedia',
            ]);
        }
    }
}
