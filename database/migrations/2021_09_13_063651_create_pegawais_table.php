<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 35);
            $table->string('email', 30);
            $table->char('telp', 12);
            $table->char('nip', 20);
            $table->string('jeniskelamin',15);
            $table->string('alamat', 300);
            $table->string('username', 20)->unique();
            $table->string('password');
            $table->string('namabidang');
            $table->enum('level',['Admin', 'Verifikator']);
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
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
        Schema::dropIfExists('pegawais');
    }
}
