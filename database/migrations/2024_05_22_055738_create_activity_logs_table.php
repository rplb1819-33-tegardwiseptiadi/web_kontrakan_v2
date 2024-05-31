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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable(); //User mana yang melakukan suatu event
            $table->string('tabel_referensi'); //Tabel mana yang sedang di track aktivitasnya
            $table->unsignedBigInteger('id_referensi')->nullable(); //Record (baris) mana dari tabel yang di referensikan
            $table->text('deskripsi'); // Apa yang dilakukan oleh mereka
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
