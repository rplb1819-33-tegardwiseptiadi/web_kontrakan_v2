<?php

namespace App\Observers;

use App\Models\User;
use App\Models\ActivityLog;

class UserObserver
{
    public function created(User $user): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'user',
            'id_referensi' => $user->id,
            'deskripsi'=> 'Insert Data User',
            'created_at'=> now(),
        ]);
    }

    /**
     * Handle the user "updated" event.
     */
    public function updated(User $user): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'user',
            'id_referensi' => $user->id,
            'deskripsi'=> 'Update Data User',
            'created_at'=> null,
            'updated_at'=> now(),
        ]);
    }

    /**
     * Handle the user "deleted" event.
     */
    public function deleted(User $user): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'user',
            'id_referensi' => $user->id,
            'deskripsi'=> 'Delete Data User',
            'created_at'=> null,
            'updated_at'=> null,
            'deleted_at'=> now(),
        ]);
    }


    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
