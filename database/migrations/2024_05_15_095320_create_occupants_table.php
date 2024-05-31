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
        Schema::create('occupants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('nama_penghuni');
            $table->integer('umur_penghuni');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->enum('status_penghuni', ['Sudah Menikah', 'Belum Menikah']);
            $table->string('gambar_ktp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupants');
    }
};
