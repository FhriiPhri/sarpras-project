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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('barang_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'dipinjam', 'dikembalikan', 'ditolak'])->default('menunggu');
            $table->integer('jumlah');
            $table->string('kondisi')->nullable(); // kondisi saat kembali
            $table->text('catatan')->nullable();
            $table->foreignId('approver_id')->nullable()->constrained('users');
            $table->timestamp('tanggal_dikembalikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_sarpras');
    }
};