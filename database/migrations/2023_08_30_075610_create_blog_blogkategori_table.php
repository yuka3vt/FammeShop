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
        Schema::create('blog_blogkategori', function (Blueprint $table) {
            $table->foreignId('blog_id')->constrained('blogs');
            $table->foreignId('blogkategori_id')->constrained('blogkategoris');
            $table->primary(['blog_id', 'blogkategori_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_blogkategori');
    }
};
