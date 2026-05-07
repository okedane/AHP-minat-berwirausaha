<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

            $kriteria = [
            [
                'kode' => 'C1',
                'nama' => 'Motivasi',
                'bobot' => 0.583,
            ],
            [
                'kode' => 'C2',
                'nama' => 'Kepercayaan Diri',
                'bobot' => 0.139,
            ],
            [
                'kode' => 'C3',
                'nama' => 'Pengetahuan Wirausaha',
                'bobot' => 0.126,
            ],
            [
                'kode' => 'C4',
                'nama' => 'Dukungan Lingkungan',
                'bobot' => 0.075,
            ],
            [
                'kode' => 'C5',
                'nama' => 'Akses Modal',
                'bobot' => 0.077,
            ],
        ];

         DB::table('kriterias')->insert($kriteria);
    }
}
