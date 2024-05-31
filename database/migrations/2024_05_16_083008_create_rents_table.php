<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kontrakan');
            $table->enum('tipe_kontrakan', ['Bulanan', 'Tahunan']);
            $table->integer('kapasitas_kontrakan');
            $table->integer('harga_kontrakan');
            $table->string('gambar_kontrakan');
            $table->enum('status_kontrakan', ['Kosong', 'Booking', 'Penuh', 'Diperbaiki']);
            $table->text('alamat_kontrakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
