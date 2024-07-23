<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{ 
    protected $fillable = [
        'user_id',
        'rent_id',
        'keluhan',
        'tgl_keluhan',
        'gambar_keluhan',
        'status_keluhan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rent()
    {
        return $this->belongsTo(Rent::class);
    }
}
