<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkalaPenlaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        // Total pertanyaan = 20
        for ($pertanyaanId = 1; $pertanyaanId <= 20; $pertanyaanId++) {

            $skala = [
                [
                    'pertanyaan_id' => $pertanyaanId,
                    'label' => 'Sangat Tidak Setuju',
                    'skor' => 1,
                ],
                [
                    'pertanyaan_id' => $pertanyaanId,
                    'label' => 'Tidak Setuju',
                    'skor' => 2,
                ],
                [
                    'pertanyaan_id' => $pertanyaanId,
                    'label' => 'Netral',
                    'skor' => 3,
                ],
                [
                    'pertanyaan_id' => $pertanyaanId,
                    'label' => 'Setuju',
                    'skor' => 4,
                ],
                [
                    'pertanyaan_id' => $pertanyaanId,
                    'label' => 'Sangat Setuju',
                    'skor' => 5,
                ],
            ];

            $data = array_merge($data, $skala);
        }

        DB::table('skala_penilaians')->insert($data);
    }
}