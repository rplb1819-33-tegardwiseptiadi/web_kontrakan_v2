<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // kalo ditulis tiap permission artinya ga diberi akses untuk si sidebarnya itu
        $adminPermissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($adminPermissions->pluck('id'));

        $penghuniPermission = $adminPermissions->filter(function ($permission) {
            return !str_starts_with($permission->title, 'user_') &&
                !str_starts_with($permission->title, 'role_') &&
                !str_starts_with($permission->title, 'permission_') &&
                !str_starts_with($permission->title, 'permission_role_') &&
                !str_starts_with($permission->title, 'penghuni_') &&
                !str_starts_with($permission->title, 'kontrakan_create') &&
                !str_starts_with($permission->title, 'kontrakan_edit') &&
                !str_starts_with($permission->title, 'kontrakan_delete') &&
                !str_starts_with($permission->title, 'keluhan_delete') &&
                !str_starts_with($permission->title, 'transaksi_edit') &&
                !str_starts_with($permission->title, 'activity_log_') &&
                !str_starts_with($permission->title, 'report_');
        });

        Role::findOrFail(2)->permissions()->sync($penghuniPermission);
    }
}
