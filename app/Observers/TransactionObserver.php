<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\ActivityLog;

class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'transaction',
            'id_referensi' => $transaction->id,
            'deskripsi'=> 'Insert Data Transaksi',
            'created_at'=> now(),
        ]);
    }

    /**
     * Handle the transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'transaction',
            'id_referensi' => $transaction->id,
            'deskripsi'=> 'Update Data Transaksi',
            'created_at'=> null,
            'updated_at'=> now(),
        ]);
    }

    /**
     * Handle the transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        ActivityLog::create([
            'user_id'=> auth()->user()->id,
            'tabel_referensi' => 'transaction',
            'id_referensi' => $transaction->id,
            'deskripsi'=> 'Delete Data Transaksi',
            'created_at'=> null,
            'updated_at'=> null,
            'deleted_at'=> now(),
        ]);
    }


    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
