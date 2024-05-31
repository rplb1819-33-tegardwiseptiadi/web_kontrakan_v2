<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'administrator',
                'created_at' => now()
            ],
            [
                'name' => 'penghuni',
                'created_at' => now()
            ], 
        ]);
    }
}
