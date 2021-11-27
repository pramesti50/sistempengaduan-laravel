<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->nullable();
            $table->foreignId('pemohon_id');
            $table->string('judul');
            $table->string('kategori');
            $table->date('tgl_pengaduan');
            $table->text('deskripsi');
            $table->enum('status', 
                        ['Belum Diproses', 
                        'Sedang diproses oleh Bidang Pengaduan & Pelaporan',
                        'Sedang diproses oleh Bidang Program & Informasi',
                        'Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan',
                        'Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan',
                        'Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi',
                        'Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal',
                        'Selesai',
                        'Tidak Aktif']
                        )->default('Belum Diproses');
            $table->date('tgl_verifikasi')->nullable();
            $table->text('tanggapan')->nullable();
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
        Schema::dropIfExists('pengaduans');
    }
}
