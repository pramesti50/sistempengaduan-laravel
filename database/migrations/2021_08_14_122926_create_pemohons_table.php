<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemohonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemohons', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 35);
            $table->char('nik', 16);
            $table->string('email', 30);
            $table->char('telp', 12);
            $table->string('jeniskelamin',10);
            $table->string('alamat', 300);
            $table->string('username', 20)->unique();
            $table->string('password');
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
        Schema::dropIfExists('pemohons');
    }
}
