<?php

namespace Database\Seeders;

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

            // C1 - Motivasi
            [
                'kriteria_id' => 1,
                'pertanyaan' => 'Saya tertarik untuk memiliki usaha sendiri',
            ],
            [
                'kriteria_id' => 1,
                'pertanyaan' => 'Saya lebih tertarik untuk menjadi wirausahawan daripada bekerja pada orang lain',
            ],
            [
                'kriteria_id' => 1,
                'pertanyaan' => 'Saya ingin mencapai kemandirian finansial melalui usaha sendiri',
            ],
            [
                'kriteria_id' => 1,
                'pertanyaan' => 'Saya termotivasi untuk menciptakan lapangan pekerjaan bagi orang lain',
            ],

            // C2 - Kepercayaan Diri
            [
                'kriteria_id' => 2,
                'pertanyaan' => 'Saya percaya diri memulai usaha',
            ],
            [
                'kriteria_id' => 2,
                'pertanyaan' => 'Saya siap menghadapi risiko dalam usaha',
            ],
            [
                'kriteria_id' => 2,
                'pertanyaan' => 'Saya yakin bisa mengelola usaha',
            ],
            [
                'kriteria_id' => 2,
                'pertanyaan' => 'Saya tidak takut gagal dalam berusaha',
            ],

            // C3 - Pengetahuan Kewirausahaan
            [
                'kriteria_id' => 3,
                'pertanyaan' => 'Saya paham cara memulai usaha',
            ],
            [
                'kriteria_id' => 3,
                'pertanyaan' => 'Saya tahu cara mengelola usaha',
            ],
            [
                'kriteria_id' => 3,
                'pertanyaan' => 'Saya paham dasar pemasaran',
            ],
            [
                'kriteria_id' => 3,
                'pertanyaan' => 'Saya pernah belajar kewirausahaan',
            ],

            // C4 - Dukungan Lingkungan
            [
                'kriteria_id' => 4,
                'pertanyaan' => 'Keluarga mendukung saya berwirausaha',
            ],
            [
                'kriteria_id' => 4,
                'pertanyaan' => 'Teman mendukung saya berwirausaha',
            ],
            [
                'kriteria_id' => 4,
                'pertanyaan' => 'Kampus mendorong mahasiswa berwirausaha',
            ],
            [
                'kriteria_id' => 4,
                'pertanyaan' => 'Saya memiliki contoh wirausaha di lingkungan sekitar',
            ],

            // C5 - Akses Modal
            [
                'kriteria_id' => 5,
                'pertanyaan' => 'Saya memiliki akses terhadap modal usaha',
            ],
            [
                'kriteria_id' => 5,
                'pertanyaan' => 'Saya mengetahui sumber pendanaan usaha',
            ],
            [
                'kriteria_id' => 5,
                'pertanyaan' => 'Saya merasa mudah dalam mencari modal usaha',
            ],
            [
                'kriteria_id' => 5,
                'pertanyaan' => 'Saya memiliki sumber daya yang mendukung usaha',
            ],

        ];

        DB::table('pertanyaans')->insert($pertanyaans);
    }
}