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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_bukus')->cascadeOnDelete();
            $table->string('judul');
            $table->string('penulis', 100)->nullable();
            $table->string('penerbit', 100)->nullable();
            $table->integer('tahun_terbit')->nullable();
            $table->string('isbn', 13)->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('tag')->nullable();
            $table->string('bahasa', 50)->nullable();
            $table->integer('jumlah_halaman')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
