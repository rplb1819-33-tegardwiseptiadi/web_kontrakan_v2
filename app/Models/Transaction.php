<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // protected $with = ['rent', 'occupant']; 
    protected $fillable = [ 
        // "occupant_id",   
        "user_id",    
        "rent_id",    
        "tgl_transaksi",      
        "harga_perbulan",   
        "jml_sewa_bulan",   
        "total_harga",   
        "total_bayar",   
        "kembalian",   
        "status_transaksi",   
        "gambar_transaksi",   
    ];

      // Definisikan relasi ke model Rent
      public function rent()
      {
          return $this->belongsTo(Rent::class);
      }
  
      // Definisikan relasi ke model Occupant
    //   public function occupant()
    //   {
    //       return $this->belongsTo(Occupant::class);
    //   }
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}
