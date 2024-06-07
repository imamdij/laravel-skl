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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_barang')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->integer('qty')->default(1);
            $table->string('subtotal');
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('barang')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
