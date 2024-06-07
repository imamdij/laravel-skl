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
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->string('nomor_hp');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('foto-profile')->default('default.png');
            $table->text('alamat');
            $table->foreign('id_user')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
