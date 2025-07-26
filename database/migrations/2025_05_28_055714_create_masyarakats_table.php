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
        Schema::create('masyarakats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_masyarakat');
            $table->string('logo')->nullable();
            $table->foreignId('bidang_usaha_id')->constrained();
            $table->foreignId('jenis_bantuan_id')->constrained();
            $table->string('alamat');
            $table->string('email');
            $table->string('telepon');
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
        Schema::dropIfExists('masyarakats');
    }
};
