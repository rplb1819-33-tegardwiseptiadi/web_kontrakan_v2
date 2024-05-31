<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Rent;

return new class extends Migration
{
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class); 
            $table->foreignIdFor(Rent::class); 
            $table->text('keluhan');
            $table->string('gambar_keluhan')->nullable();
            $table->enum('status_keluhan', ['Sudah Divalidasi', 'Belum Divalidasi'])->default('Belum Divalidasi');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
