<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\ActivityLog;

class RoleObserver
{
    public function created(Role $role): void
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'role',
            'id_referensi' => $role->id,
            'deskripsi' => 'Insert Data Role User',
            'created_at' => now(),
        ]);
    }

    /**
     * Handle the role "updated" event.
     */
    public function updated(Role $role): void
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'role',
            'id_referensi' => $role->id,
            'deskripsi' => 'Update Data Role User',
            'created_at' => null,
            'updated_at' => now(),
        ]);
    }

    /**
     * Handle the role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'role',
            'id_referensi' => $role->id,
            'deskripsi' => 'Delete Data Role User',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => now(),
        ]);
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        //
    }
}
