<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('tanggalLahir')->nullable();
            $table->string('jenisKelamin')->nullable();
            $table->string('statusKtp')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('alamatAsli')->nullable();
            $table->string('alamatSekarang')->nullable();
            $table->string('fotoKtp')->nullable();
            $table->string('alasan')->nullable();
            $table->string('moto')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
}
