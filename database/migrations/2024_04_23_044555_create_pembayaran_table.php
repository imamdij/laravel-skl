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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_keranjang')->unsigned();
            $table->string('kode_pembayaran');
            $table->text('alamat_pengiriman');
            $table->string('ekspedisi');
            $table->enum('status_pembayaran', ['berhasil', 'gagal', 'dibatalkan'])->default('berhasil');
            $table->foreign('id_keranjang')->references('id')->on('keranjang')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
