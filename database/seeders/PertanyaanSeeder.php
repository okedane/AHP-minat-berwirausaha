<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pertanyaans = [
        [
            'kriteria_id' => 1,
            'pertanyaan' => 'Apakah anda pernah membuat laporan penjualan dalam 1 bulan terakhir?',
        ],
        [
            'kriteria_id' => 1,
            'pertanyaan' => 'Apakah anda pernah membuat laporan inventaris dalam 1 bulan terakhir?',
        ],
        ];

        DB::table('pertanyaans')->insert($pertanyaans);
    }
}
