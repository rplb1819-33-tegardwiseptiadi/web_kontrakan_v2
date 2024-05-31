<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('occupant_id')->constrained();
            $table->foreignIdFor(User::class);
            $table->foreignId('rent_id')->constrained();
            $table->date('tgl_transaksi');
            $table->integer('harga_perbulan');
            $table->integer('jml_sewa_bulan');
            $table->integer('total_harga');
            $table->integer('total_bayar');
            $table->integer('kembalian');
            $table->enum('status_transaksi', ['Sudah Divalidasi', 'Belum Divalidasi']);
            $table->string('gambar_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
