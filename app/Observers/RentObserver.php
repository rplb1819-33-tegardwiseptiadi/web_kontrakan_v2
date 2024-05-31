<?php

namespace App\Observers;

use App\Models\Rent;
use App\Models\ActivityLog;

class RentObserver
{
    public function created(Rent $rent): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'rent',
            'id_referensi' => $rent->id,
            'deskripsi'=> 'Insert Data Kontrakan',
            'created_at'=> now(),
        ]);
    }

    /**
     * Handle the rent "updated" event.
     */
    public function updated(Rent $rent): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'rent',
            'id_referensi' => $rent->id,
            'deskripsi'=> 'Update Data Kontrakan',
            'created_at'=> null,
            'updated_at'=> now(),
        ]);
    }

    /**
     * Handle the rent "deleted" event.
     */
    public function deleted(Rent $rent): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'rent',
            'id_referensi' => $rent->id,
            'deskripsi'=> 'Delete Data Kontrakan',
            'created_at'=> null,
            'updated_at'=> null,
            'deleted_at'=> now(),
        ]);
    }


    /**
     * Handle the Rent "restored" event.
     */
    public function restored(Rent $rent): void
    {
        //
    }

    /**
     * Handle the Rent "force deleted" event.
     */
    public function forceDeleted(Rent $rent): void
    {
        //
    }
}
