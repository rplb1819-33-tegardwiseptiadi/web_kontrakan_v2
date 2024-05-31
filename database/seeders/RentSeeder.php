<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rents')->insert([
            [
                'nama_kontrakan' => 'Kontrakan A',
                'tipe_kontrakan' => 'Bulanan',
                'kapasitas_kontrakan' => 4,
                'harga_kontrakan' => 1500000,
                'gambar_kontrakan' => 'kontrakan_a.jpg',
                'status_kontrakan' => 'Kosong',
                'alamat_kontrakan' => 'Jl. Merpati No. 1, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kontrakan' => 'Kontrakan B',
                'tipe_kontrakan' => 'Tahunan',
                'kapasitas_kontrakan' => 6,
                'harga_kontrakan' => 15000000,
                'gambar_kontrakan' => 'kontrakan_b.jpg',
                'status_kontrakan' => 'Kosong',
                'alamat_kontrakan' => 'Jl. Kenari No. 2, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kontrakan' => 'Kontrakan C',
                'tipe_kontrakan' => 'Bulanan',
                'kapasitas_kontrakan' => 2,
                'harga_kontrakan' => 1000000,
                'gambar_kontrakan' => 'kontrakan_c.jpg',
                'status_kontrakan' => 'Kosong',
                'alamat_kontrakan' => 'Jl. Kaktus No. 3, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kontrakan' => 'Kontrakan D',
                'tipe_kontrakan' => 'Tahunan',
                'kapasitas_kontrakan' => 8,
                'harga_kontrakan' => 18000000,
                'gambar_kontrakan' => 'kontrakan_d.jpg',
                'status_kontrakan' => 'Kosong',
                'alamat_kontrakan' => 'Jl. Melati No. 4, Medan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
