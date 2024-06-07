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
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_toko')->unsigned();
            $table->integer('id_kategori')->unsigned();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('gambar');
            $table->string('harga');
            $table->text('deskripsi');
            $table->integer('stok');
            $table->string('warna')->nullable();
            $table->foreign('id_toko')->on('toko')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_kategori')->on('kategori')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
