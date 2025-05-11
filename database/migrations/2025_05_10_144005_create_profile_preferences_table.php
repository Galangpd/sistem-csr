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
        Schema::create('profile_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_perusahaan')->nullable()->constrained('perusahaans')->onDelete('cascade');

            $table->json('bidang_usaha');
            $table->json('jenis_bantuan');

            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('kalurahan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_preferences');
    }
};
