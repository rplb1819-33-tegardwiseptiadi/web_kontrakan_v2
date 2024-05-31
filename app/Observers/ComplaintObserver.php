<?php

namespace App\Observers;

use App\Models\Complaint;
use App\Models\ActivityLog;

class ComplaintObserver
{
    public function created(Complaint $complaint): void
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'complaints',
            'id_referensi' => $complaint->id,
            'deskripsi' => 'Insert Data Keluhan',
            'created_at' => now(),
        ]);
    }

    public function updated(Complaint $complaint): void
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'complaints',
            'id_referensi' => $complaint->id,
            'deskripsi' => 'Update Data Keluhan',
            'created_at' => null,
            'updated_at' => now(),
        ]);
    }

    public function deleted(Complaint $complaint): void
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'complaints',
            'id_referensi' => $complaint->id,
            'deskripsi' => 'Delete Data Keluhan',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => now(),
        ]);
    }

    public function restored(Complaint $complaint): void
    {
        //
    }

    public function forceDeleted(Complaint $complaint): void
    {
        //
    }
}
