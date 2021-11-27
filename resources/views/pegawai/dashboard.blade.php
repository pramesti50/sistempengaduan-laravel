@extends('layout.main')
@section('title', 'Dashboard Pegawai | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')

@section('content')

<section class="section">        
    <h4>Selamat Datang, {{ Auth::guard('pegawai')->user()->level }} {{ Auth::guard('pegawai')->user()->nama}}</h4>
    <h6>{{ Auth::guard('pegawai')->user()->namabidang }}</h6>

    <div class="row">    
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon red">
                                <a href="/pengaduan/belum-proses"><i class="bi bi-arrow-down-circle-fill"></i></a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Pengaduan Belum Diproses</h6>
                            <h6 class="font-extrabold mb-0">{{ $belum }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                            
        <div class="col-8 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon blue">
                                <a href="/pengaduan/sedang-diproses"><i class="bi bi-arrow-repeat"></i></a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold" style="font-size:15px;">Pengaduan Sedang Diproses</h6>
                            <h6 class="font-extrabold mb-0">{{ $sedangproses }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-8 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon green">
                                <a href="/pengaduan/selesai"><i class="bi bi-check-circle-fill"></i></a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Pengaduan Selesai</h6>
                            <h6 class="font-extrabold mb-0">{{ $selesai }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                           
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon purple">
                                <a href="/aspirasi"><i class="iconly-boldBookmark"></i></a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Total <br>Aspirasi</h6>
                            <h6 class="font-extrabold mb-0">{{ $aspirasi }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
                       

    <div class="col-12 col-sm-12">
        <div class="card">
            <h6 class="mt-3" style="margin-left:30px;">Rincian Pengaduan Sedang Diproses</h6>
                                    
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table">
                        <thead>
                            <tr>
                                 <th>No.</th>
                                <th style="text-align:center;">Status Nama Bidang</th>
                                <th style="text-align:center;">Jumlah Pengaduan</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><p>Sedang Diproses oleh Bidang Pengaduan dan Pelaporan</p></td>
                                <td><p style="text-align:center;">{{ $aduan }}</p></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><p>Sedang Diproses oleh Bidang Program & Informasi</p></td>
                                <td><p style="text-align:center;">{{ $programinfo }}</p></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><p>Sedang Diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</p></td>
                                <td><p style="text-align:center;">{{ $non }}</p></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><p>Sedang Diproses oleh Bidang Perizinan Pemerintahan & Pembangunan</p></td>
                                <td><p style="text-align:center;">{{ $pemerintah }}</p></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><p>Sedang Diproses oleh Bidang Pelayanan Perizinan Ekonomi</p></td>
                                <td><p style="text-align:center;">{{ $ekonomi }}</p></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td><p>Sedang Diproses oleh Bidang Pelaksanaan Penanaman Modal</p></td>
                                <td><p style="text-align:center;">{{ $modal }}</p></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><a href="/pengaduan/cetakpengaduan" style="text-decoration:none;"><h6 class="font-semibold">Total Seluruh Data Pengaduan</h6></a></td>
                                <td><p style="text-align:center;">{{ $totalpengaduan }}</p></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
                        

           
        <div class="card">
            <div class="card-body">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                    <h6>Kontak Kami</h6>
                        <p>
                        Email: dpmptspbadungkab@gmail.com / dpmptsp@badungkab.go.id <br>
                        Telepon: (0361) 471-525-9 <br>
                        Whatsapp: +62 815-5803-1000 <br>
                        Call Center: 1500-273 <br>
                        Jam Pelayanan: 08.30-15.30 WITA (Hari Senin-Kamis) dan 08.00-11.00 WITA (Hari Jumat)
                        </p>
                    </div>
                </div>
            </div>
        </div>


</section>
            
@endsection