<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabarugisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labarugis', function (Blueprint $table) {
            $table->id();
            $table->integer('totalPemasukkan')->nullable();
            $table->integer('totalPengeluaran')->nullable();
            $table->integer('totalGaji')->nullable();
            $table->integer('totalPembayaran')->nullable();
            $table->string('nama')->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('labarugis');
    }
}
