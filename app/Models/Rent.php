<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'nama_kontrakan',
        'tipe_kontrakan',
        'kapasitas_kontrakan',
        'harga_kontrakan',
        'gambar_kontrakan',
        'status_kontrakan',
        'alamat_kontrakan',
    ];

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }

    public function occupant()
    {
        return $this->belongsTo(Occupant::class);
    }

    
}
