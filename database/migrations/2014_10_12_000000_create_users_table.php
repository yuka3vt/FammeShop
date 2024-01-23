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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable()->default("default");
            $table->string('nama');
            $table->string('username')->unique();
            $table->enum('jenis_kelamin', ['Laki-Laki','Perempuan'])->nullable();
            $table->enum('akun', ['aktif','tidak'])->default("tidak");
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kode_pos')->nullable();
            $table->text('detail_alamat')->nullable();
            $table->string('telepon');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('level')->default("pengguna");
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
