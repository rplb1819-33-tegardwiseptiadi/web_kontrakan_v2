<?php

namespace App\Observers;

use App\Models\Occupant;
use App\Models\ActivityLog;

class OccupantObserver
{
    /**
     * Handle the Occupant "created" event.
     */
    public function created(Occupant $occupant): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'occupant',
            'id_referensi' => $occupant->id,
            'deskripsi'=> 'Insert Data Penghuni',
            'created_at'=> now(),
        ]);
    }

    /**
     * Handle the Occupant "updated" event.
     */
    public function updated(Occupant $occupant): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'occupant',
            'id_referensi' => $occupant->id,
            'deskripsi'=> 'Update Data Penghuni',
            'created_at'=> null,
            'updated_at'=> now(),
        ]);
    }

    /**
     * Handle the Occupant "deleted" event.
     */
    public function deleted(Occupant $occupant): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'occupant',
            'id_referensi' => $occupant->id,
            'deskripsi'=> 'Delete Data Penghuni',
            'created_at'=> null,
            'updated_at'=> null,
            'deleted_at'=> now(),
        ]);
    }

    /**
     * Handle the Occupant "restored" event.
     */
    public function restored(Occupant $occupant): void
    {
        //
    }

    /**
     * Handle the Occupant "force deleted" event.
     */
    public function forceDeleted(Occupant $occupant): void
    {
        //
    }
}
