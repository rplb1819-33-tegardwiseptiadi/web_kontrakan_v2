<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('occupants')->insert([
            [
                'user_id' => '2',
                'nama_penghuni' => 'Budi Santoso',
                'umur_penghuni' => 30,
                'jenis_kelamin' => 'Pria',
                'status_penghuni' => 'Sudah Menikah',
                'gambar_ktp' => 'budi_santoso_ktp.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '3',
                'nama_penghuni' => 'Siti Aminah',
                'umur_penghuni' => 28,
                'jenis_kelamin' => 'Wanita',
                'status_penghuni' => 'Belum Menikah',
                'gambar_ktp' => 'siti_aminah_ktp.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '4',
                'nama_penghuni' => 'Andi Wijaya',
                'umur_penghuni' => 35,
                'jenis_kelamin' => 'Pria',
                'status_penghuni' => 'Sudah Menikah',
                'gambar_ktp' => 'andi_wijaya_ktp.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '5',
                'nama_penghuni' => 'Rina Puspita',
                'umur_penghuni' => 25,
                'jenis_kelamin' => 'Wanita',
                'status_penghuni' => 'Belum Menikah',
                'gambar_ktp' => 'rina_puspita_ktp.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
