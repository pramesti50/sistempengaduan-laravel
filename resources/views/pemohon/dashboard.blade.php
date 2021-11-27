@extends('layout.mainpemohon')
@section('title', 'Dashboard Pemohon | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Dashboard')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h5 class="display-6">Selamat Datang, {{ Auth::guard('pemohon')->user()->nama }}</h5>
                        <p class="lead" style="font-size:16px;">Ajukan dan laporkan pengaduan serta aspirasi berupa kritik dan saran Anda kepada kami melalui 
                        Sistem Pengaduan dan Aspirasi Pada Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kabupaten Badung</p>
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
                        Jam Pelayanan: 08.30-15.30 WITA (Hari Senin-Kamis) dan 08.00-11.00 WITA (Hari Jumat) <br>
                        Alamat: Jl. Raya Sempidi, Badung, Bali
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </section>
            
@endsection