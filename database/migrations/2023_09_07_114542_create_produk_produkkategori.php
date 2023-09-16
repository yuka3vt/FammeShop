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
        Schema::create('produk_produkkategori', function (Blueprint $table) {
            $table->foreignId('produk_id')->constrained('produks');
            $table->foreignId('produkkategori_id')->constrained('produkkategoris');
            $table->primary(['produk_id', 'produkkategori_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_produkkategori');
    }
};
