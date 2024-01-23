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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable()->default("default");
            $table->string('nama');
            $table->string('slug')->unique();
            $table->double('berat')->nullable();
            $table->string('dimensi')->nullable();
            $table->string('bahan')->nullable();
            $table->text('deskripsi');
            $table->decimal('harga', 10, 0);
            $table->integer('stok');
            $table->integer('diskon')->nullable();
            $table->integer('dibeli')->default(0);
            $table->integer('suka')->default(0);
            $table->decimal('hargaTotal', 10, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
