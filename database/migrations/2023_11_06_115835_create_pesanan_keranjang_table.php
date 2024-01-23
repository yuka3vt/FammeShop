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
        Schema::create('pesanan_keranjang', function (Blueprint $table) {
            $table->foreignId('pesanan_id')->constrained('pesanans');
            $table->foreignId('keranjang_id')->constrained('keranjangs');
            $table->primary(['pesanan_id', 'keranjang_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_keranjang');
    }
};
