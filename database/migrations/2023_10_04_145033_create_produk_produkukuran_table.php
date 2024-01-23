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
        Schema::create('produk_produkukuran', function (Blueprint $table) {
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->foreignId('produkukuran_id')->constrained('produkukurans')->onDelete('cascade');
            $table->primary(['produk_id', 'produkukuran_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_produkukuran');
    }
};
