<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Pastikan roles sudah ada sebelum menjalankan seeder ini
        $adminRole = Role::find(1); // memastikan role admin ada
        $userRole = Role::find(2); // memastikan role user ada

        if ($adminRole && $userRole) {
            User::create([
                'name' => 'Tegar',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'),
                'remember_token' => Str::random(10),
                'umur' => $faker->numberBetween(20, 50),
                'jenis_kelamin' => 'Pria',
                'status_penghuni' => 'Sudah Menikah',
                'gambar_ktp' => $faker->imageUrl(),
                'role_id' => $adminRole->id,
            ]);

            User::create([
                'name' => 'Keisya',
                'email' => 'staff1@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'umur' => $faker->numberBetween(20, 50),
                'jenis_kelamin' => 'Wanita',
                'status_penghuni' => 'Belum Menikah',
                'gambar_ktp' => $faker->imageUrl(),
                'role_id' => $userRole->id,
            ]);

            User::factory(3)->create()->each(function ($user) use ($faker) {
                $user->update([
                    'umur' => $faker->numberBetween(20, 50),
                    'jenis_kelamin' => $faker->randomElement(['Pria', 'Wanita']),
                    'status_penghuni' => $faker->randomElement(['Belum Menikah', 'Sudah Menikah']),
                    'gambar_ktp' => $faker->imageUrl(),
                ]);
            });

        } else {
            // Role tidak ditemukan, tambahkan logika penanganan error jika diperlukan
            throw new \Exception('Roles not found. Please seed roles first.');
        }
    }
}
