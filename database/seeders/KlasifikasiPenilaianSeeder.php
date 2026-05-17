<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KlasifikasiPenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $klasifikasiPenilaian = [
            ['nama_kategori' => 'Rendah', 'nilai_min' => 1.00, 'nilai_max' => 2.32, 'deskripsi' => 'Minat berwirausaha masih sangat rendah, memerlukan dorongan ekstra berupa edukasi kewirausahaan, pelatihan dasar bisnis, serta motivasi melalui seminat dan mentoring untuk meningkatkan minat dan kepercayaan diri.'],
            ['nama_kategori' => 'Sedang', 'nilai_min' => 2.33, 'nilai_max' => 3.67, 'deskripsi' => 'Minat sedang memerlukan pendampingan yang lebih intensif berupa bimbingan usaha, praktik langsung melalui kewirausahaan, serta pendampingan teknis seperti pelatihan pemasaran dan pengolaan usaha.'],
            ['nama_kategori' => 'Cukup', 'nilai_min' => 3.68, 'nilai_max' => 5.00, 'deskripsi' => 'Minat tinggi, kandidat cocok untuk program wirausaha.'],
        ];

        foreach ($klasifikasiPenilaian as $data) {
            \App\Models\KlasifikasiPenilaian::create($data);
        }
    }
}
