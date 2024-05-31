<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            // User Management
            ['title' => 'user_management_access'],
            ['title' => 'user_access'],
            ['title' => 'user_create'],
            ['title' => 'user_update'],
            ['title' => 'user_delete'],
            ['title' => 'user_edit'],
            ['title' => 'user_show'],

            // Peran User Management
            ['title' => 'role_management_access'],
            ['title' => 'role_access'],
            ['title' => 'role_create'],
            ['title' => 'role_update'],
            ['title' => 'role_delete'],
            ['title' => 'role_edit'],
            ['title' => 'role_show'],

            // Akses User Management
            ['title' => 'permission_management_access'],
            ['title' => 'permission_access'],
            ['title' => 'permission_create'],
            ['title' => 'permission_update'],
            ['title' => 'permission_delete'],
            ['title' => 'permission_edit'],
            ['title' => 'permission_show'],

            //Manajemen Data
            ['title' => 'data_management_access'],

            //Manajemen Penghuni
            ['title' => 'penghuni_access'],
            ['title' => 'penghuni_create'],
            ['title' => 'penghuni_update'],
            ['title' => 'penghuni_delete'],
            ['title' => 'penghuni_edit'],
            ['title' => 'penghuni_show'],

            //Manajemen Kontrakan
            ['title' => 'kontrakan_access'],
            ['title' => 'kontrakan_create'],
            ['title' => 'kontrakan_update'],
            ['title' => 'kontrakan_delete'],
            ['title' => 'kontrakan_edit'],
            ['title' => 'kontrakan_show'],

            //Manajemen Transaksi
            ['title' => 'transaksi_access'],
            ['title' => 'transaksi_create'],
            ['title' => 'transaksi_update'],
            ['title' => 'transaksi_edit'],
            ['title' => 'transaksi_show'],
            ['title' => 'transaksi_print'],

            //Manajemen Keluhan
            ['title' => 'keluhan_access'],
            ['title' => 'keluhan_create'],
            ['title' => 'keluhan_update'],
            ['title' => 'keluhan_delete'],
            ['title' => 'keluhan_edit'],
            ['title' => 'keluhan_show'],

            //Manajemen Laporan Transaksi
            ['title' => 'report_access'],
            // Report Management
            ['title' => 'report_create'],

            // Activity Log Management
            ['title' => 'activity_log_access'],

        ];

        Permission::insert($permissions);
    }
}
