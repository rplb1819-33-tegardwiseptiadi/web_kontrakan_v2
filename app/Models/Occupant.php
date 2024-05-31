<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 1. Menggunakan Soft Deletes
// Jika Anda ingin mempertahankan data transaksi 
// meskipun data penghuni dihapus, 
// salah satu solusi terbaik adalah menggunakan soft deletes. 
// Dengan soft deletes, data sebenarnya tidak dihapus dari database, 
// tetapi hanya ditandai sebagai dihapus. 
// Anda bisa mengaktifkan soft deletes untuk 
// model Occupant dan model lain yang terkait jika perlu.
use Illuminate\Database\Eloquent\SoftDeletes;


class Occupant extends Model
{
    protected $fillable = [
        'user_id',
        'nama_penghuni',
        'umur_penghuni',
        'jenis_kelamin',
        'status_penghuni',
        'gambar_ktp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // Relasi ke model lainnya
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }

}
