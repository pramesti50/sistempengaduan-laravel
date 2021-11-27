<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

//MIDDLEWARE GUEST 
Route::middleware(['guest'])->group(function (){
// Registrasi PEMOHON
    Route::get('/pemohon/registrasi', 'App\Http\Controllers\RegisPemohonController@regisPemohon');
    Route::post('/pemohon/registrasi', 'App\Http\Controllers\RegisPemohonController@inputRegis');

//Login PEMOHON
    Route::get('/login', 'App\Http\Controllers\LoginController@indexlogin');
    Route::post('/login', 'App\Http\Controllers\LoginController@prosesLoginPemohon')->name('login');
    Route::post('/logout', 'App\Http\Controllers\LoginController@LogoutPemohon')->name('logoutpemohon');

//LOGIN VERIFIKATOR & ADMIN
    Route::get('/login-pegawai', 'App\Http\Controllers\AuthPegawaiController@indexLoginPegawai');
    Route::post('/login-pegawai', 'App\Http\Controllers\AuthPegawaiController@prosesLoginPegawai')->name('loginpegawai');
    Route::post('/logoutpegawai', 'App\Http\Controllers\AuthPegawaiController@logoutPegawai')->name('logoutpegawai');

});



//-----------------------AKSES PEMOHON--------------------------------------------
Route::group(['middleware' => ['auth:pemohon', 'revalidate']], function (){ 
    //dashboard pemohon
    Route::get('/pemohon/dashboard', 'App\Http\Controllers\LoginController@dashboardPemohon');
    
    //akun pemohon profil saya
    Route::get('/pemohon/profile-pemohon', 'App\Http\Controllers\LoginController@indexProfilePemohon');
    Route::patch('/pemohon/profile-pemohon', 'App\Http\Controllers\LoginController@updatePemohon')->name('updatepemohon');
    Route::get('/pemohon/updatepassword', 'App\Http\Controllers\LoginController@indexUpdatePassword');
    Route::patch('/pemohon/updatepassword', 'App\Http\Controllers\LoginController@updatePassword')->name('updatePassword');
    
    //tambah aspirasi pemohon
    Route::get('/pemohon/tambah_aspirasi', 'App\Http\Controllers\AspirasiController@indexTambahAspirasi');
    Route::post('/pemohon/tambah_aspirasi', 'App\Http\Controllers\AspirasiController@prosesTambahAspirasi')->name('tambahAspirasi');
    Route::get('/pemohon/riwayat-aspirasi', 'App\Http\Controllers\AspirasiController@indexRiwayatAspirasi');
    
    //tambah dan riwayat pengaduan pemohon
    Route::get('/pemohon/tambah-pengaduan', 'App\Http\Controllers\PengaduanController@tambahPengaduan');
    Route::post('/pemohon', 'App\Http\Controllers\PengaduanController@prosesTambahPengaduan')->name('tambahpengaduan');
    Route::get('/pemohon/riwayatpengaduan', 'App\Http\Controllers\PengaduanController@riwayatPengaduan');
    Route::get('/pemohon/detail-riwayatpengaduan/{id}', 'App\Http\Controllers\PengaduanController@detailRiwayatPengaduan'); 
});


    


    
//-----------AKSES VERIFIKATOR DAN ADMIN---------------------------------------------------------
Route::group(['middleware' => ['auth:pegawai','aksesverifikator', 'revalidate']], function (){
    //Dashboard Pegawai    
    Route::get('/pegawai/dashboard', 'App\Http\Controllers\AuthPegawaiController@indexDashboardPegawai');

    //Kelola Profile Pegawai
    Route::get('/pegawai/profile-pegawai', 'App\Http\Controllers\AuthPegawaiController@indexProfilePegawai');
    Route::patch('/pegawai/profile-pegawai', 'App\Http\Controllers\AuthPegawaiController@editProfilePegawai')->name('editprofilepegawai');
    
    //Update Password masing2 akun
    //pke modal Route::put('/pegawai/profile-pegawai/{profilpegawai}', 'App\Http\Controllers\AuthPegawaiController@editPasswordPegawai');
    Route::get('/pegawai/ubahpassword', 'App\Http\Controllers\AuthPegawaiController@indexEditPassword');
    Route::put('/pegawai/ubahpassword', 'App\Http\Controllers\AuthPegawaiController@editPasswordPegawai')->name('ubahpasspegawai');

    //Kelola Pengaduan
        //belum diproses
        Route::get('/pengaduan/belum-proses', 'App\Http\Controllers\PengaduanController@indexBelumProses');
        Route::put('/pengaduan/belum-proses/{pengaduanMasuk}', 'App\Http\Controllers\PengaduanController@editStatusBelumProses');
        
        //sedang diproses
        Route::get('/pengaduan/sedang-diproses', 'App\Http\Controllers\PengaduanController@indexSedangDiproses');
        Route::get('/pengaduan/detail-sedang-diproses/{id}', 'App\Http\Controllers\PengaduanController@indexVerifikasiPengaduan');
        Route::patch('/pengaduan/detail-sedang-diproses/{sedangproses}', 'App\Http\Controllers\PengaduanController@verifikasiPengaduan');
        
        //selesai
        Route::get('/pengaduan/selesai', 'App\Http\Controllers\PengaduanController@indexSelesai');
        Route::post('/pengaduan/selesai', 'App\Http\Controllers\PengaduanController@cariSelesai')->name('cariselesai');
        Route::get('/pengaduan/detail-selesai/{id}', 'App\Http\Controllers\PengaduanController@indexDetailSelesai');
        Route::patch('/pengaduan/detail-selesai/{selesai}', 'App\Http\Controllers\PengaduanController@editTanggapanSelesai');

        //Filter Data Pengaduan
        Route::get('/pengaduan/cetakpengaduan', 'App\Http\Controllers\PengaduanController@indexCetakPengaduan');
        Route::post('/pengaduan/cetakpengaduan', 'App\Http\Controllers\PengaduanController@cariCetakPengaduanTanggal')->name('caripengaduantgl');

    //Kelola Data Aspirasi
    Route::get('/aspirasi', 'App\Http\Controllers\AspirasiController@indexDataAspirasi')->name('indexAspirasi');
    Route::put('/aspirasi/{id}', 'App\Http\Controllers\AspirasiController@edit_StatusAspirasi');
    // Route::post('/aspirasi', 'App\Http\Controllers\AspirasiController@filterAspirasi')->name('filterAspirasi');

    Route::get('/aspirasi/laporan-PDFaspirasi/{tgl_awal}/{tgl_akhir}', 'App\Http\Controllers\AspirasiController@cetakpdfAspirasi')->name('laporan_aspirasipdf');



    //Cetak dan FIlter Data Aspirasi GAJADI DIPKE HALAMAN INI
    // Route::get('/aspirasi/cetakaspirasi', 'App\Http\Controllers\AspirasiController@indexcetakAspirasi');
    // Route::post('/aspirasi/cetakaspirasi', 'App\Http\Controllers\AspirasiController@cariDataCetak')->name('cariDataAspirasi');
    //Route::get('/aspirasi/laporan-PDFaspirasi/{tgl_awal}/{tgl_akhir}', 'App\Http\Controllers\AspirasiController@pdfAspirasi')->name('pdfAspirasi');

});





//-------------------------AKSES ADMIN----------------------------------------------
Route::group(['middleware' => ['auth:pegawai','aksesadmin', 'revalidate']], function (){
    //Kelola Verifikator
    Route::get('/pegawai/tambah-verifikator', 'App\Http\Controllers\KelolaAkunController@indexTambahVerifikator');
    Route::post('/pegawai/tambah-verifikator', 'App\Http\Controllers\KelolaAkunController@prosesTambahVerifikator')->name('tambahverifikator');
    
    Route::get('/pegawai/data-verifikator', 'App\Http\Controllers\KelolaAkunController@indexDataVerifikator')->name('carinamaverifikator');
    
    Route::put('/pegawai/data-verifikator/{dataverifikator}', 'App\Http\Controllers\KelolaAkunController@editDataVerifikator');
    Route::patch('/pegawai/data-verifikator/{dataverifikator}', 'App\Http\Controllers\KelolaAkunController@editPasswordVerifikator');

    //Kelola Pemohon
    Route::get('/pegawai/data-pemohon', 'App\Http\Controllers\KelolaAkunController@indexDataPemohon')->name('cariusernamepemohon');
    Route::patch('/pegawai/data-pemohon/{datapemohon}', 'App\Http\Controllers\KelolaAkunController@editDataPemohon');
    Route::put('/pegawai/data-pemohon/{datapemohon}', 'App\Http\Controllers\KelolaAkunController@editPassword');
    
    //Cetak Pengaduan PDF
    Route::get('/pengaduan/pdfpengaduan/{tgl_awalpengaduan}/{tgl_akhirpengaduan}', 'App\Http\Controllers\PengaduanController@cetakPdfPengaduan')->name('laporanpengaduanpdf');

    //Pengaduan Tidak Aktif
    Route::get('/pengaduan/tidak-aktif', 'App\Http\Controllers\PengaduanController@indexTidakAktif');
    Route::post('/pengaduan/tidak-aktif', 'App\Http\Controllers\PengaduanController@cariTidakAktif')->name('caritdkaktif');
    Route::get('/pengaduan/detail-tidakaktif/{id}', 'App\Http\Controllers\PengaduanController@indexDetailTdkAktif');
    Route::patch('/pengaduan/detail-tidakaktif/{tdkaktif}', 'App\Http\Controllers\PengaduanController@editTidakAktif');
    
});