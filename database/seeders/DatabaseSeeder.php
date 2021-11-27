<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Pegawai::create([
            'nama' => 'Ni Kadek Putri Pramesti',
            'email' => 'adminpengaduan@gmail.com',
            'telp' => '081934360374',
            'nip' => '19961012 2987012 001',
            'jeniskelamin' => 'Perempuan',
            'alamat' => 'Jalan Antasura',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'namabidang' => 'Bidang Pengaduan & Pelaporan',
            'level' => 'Admin',
        ]);

    }
}
