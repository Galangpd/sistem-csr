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

            $table->json('core_factor');
            $table->json('secondary_factor');
            $table->json('bidang_usaha');
            $table->json('jenis_bantuan');

            $table->char('provinsi_id', 2);
            $table->char('kabupaten_id', 4);
            $table->char('kecamatan_id', 7);
            $table->char('kalurahan_id', 10);
            
            $table->timestamps();

            $table->foreign('provinsi_id')->references('code')->on('indonesia_provinces');
            $table->foreign('kabupaten_id')->references('code')->on('indonesia_cities');
            $table->foreign('kecamatan_id')->references('code')->on('indonesia_districts');
            $table->foreign('kalurahan_id')->references('code')->on('indonesia_villages');
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
