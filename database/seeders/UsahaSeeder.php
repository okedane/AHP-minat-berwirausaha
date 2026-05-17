<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usaha = [
            ['nama_usaha' => 'Reseller online', 'deskripsi' =>'Jual produk tanpa produksi', 'klasifikasi_penilaian_id' => 1],
            ['nama_usaha' => 'Dropship', 'deskripsi' =>'Modal kecil, risiko rendah', 'klasifikasi_penilaian_id' => 1],
            ['nama_usaha' => 'Jasa titip (jastip)', 'deskripsi' =>'Mudah dimulai mahasiswa', 'klasifikasi_penilaian_id' => 1],
            ['nama_usaha' => 'Jualan makanan ringan', 'deskripsi' =>'Di lingkungan kampus', 'klasifikasi_penilaian_id' => 1],
            
            ['nama_usaha' => 'Usaha kuliner', 'deskripsi' => 'Katering, minuman, snack', 'klasifikasi_penilaian_id' => 2],
            ['nama_usaha' => 'Freelance desain/konten', 'deskripsi' => 'Poster, video, copywriting', 'klasifikasi_penilaian_id' => 2],
            ['nama_usaha' => 'Toko online (Shopee/Tokped)', 'deskripsi' => 'Produk Sendiri atau kurasi', 'klasifikasi_penilaian_id' => 2],
            ['nama_usaha' => 'Jasa les/bimbel', 'deskripsi' => 'Sesuai Bidang Studi', 'klasifikasi_penilaian_id' => 2],

            ['nama_usaha' => 'Startup Digital', 'deskripsi' => 'Aplikasi atau platform digital', 'klasifikasi_penilaian_id' => 3],
            ['nama_usaha' => 'Brand Produk sendiri', 'deskripsi' => 'Fashion, kosmetik, UMKM', 'klasifikasi_penilaian_id' => 3],
            ['nama_usaha' => 'Agensi Kreatif', 'deskripsi' => 'Marketing, design, content', 'klasifikasi_penilaian_id' => 3],
            ['nama_usaha' => 'Usaha Kuliner Skala Besar', 'deskripsi' => 'Franchise kuliner, cloud kitchen', 'klasifikasi_penilaian_id' => 3],
        ];

        foreach ($usaha as $data) {
            \App\Models\Usaha::create($data);
        }
    }
}
