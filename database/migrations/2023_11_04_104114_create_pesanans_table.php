<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('image')->nullable();
            $table->string('no_pesanan')->unique();
            $table->enum('pembayaran', ['COD','BCA']);
            $table->enum('status', ['Belum dibayar','Sudah dibayar']);
            $table->text('alamat');
            $table->string('kurir');
            $table->string('layanan');
            $table->decimal('pengiriman', 10, 0);
            $table->decimal('subtotal', 10, 0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
