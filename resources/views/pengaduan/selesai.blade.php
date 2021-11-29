@extends('layout.main')
@section('title', 'Pengaduan Selesai | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Data Pengaduan Pemohon Selesai Diproses')
@section('content')

<section class="section">
  <div class="card"> 
    <div class="card-body">
      <form class="{{ route('indexselesai') }}" method="GET">
        <div class="row">
        <div class="col-md-6 col-12">
          <h6>Filter Berdasarkan Tanggal Verifikasi</h6>
        </div>
        
        <div class="col-md-6 col-12 justify-content-end">
          <div class="btn-group mb-3 btn-group" role="group" aria-label="Basic example" style="float:right;">
              <a class="btn btn-light-secondary btn-sm me-1 mb-1" href="{{ url('/pengaduan/sedang-diproses') }}">Sedang Proses</a>
          </div>
        </div>

          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="awalselesai">Dari Tanggal</label>
              <input type="date" id="awalselesai" name="awalselesai" class="form-control" value="{{ request()->input('awalselesai') }}">
            </div>
          </div>
                        
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="akhirselesai">Sampai Tanggal</label>
              <input type="date" id="akhirselesai" name="akhirselesai" class="form-control" value="{{ request()->input('akhirselesai') }}">
            </div>
          </div>

          <div class="col-md-4 col-12 d-flex ">
          <p class="text-muted font-bold mb-0">Total Pengaduan Selesai: {{ $selesai }}</p>
          </div>

          <div class="col-md-8 col-12 d-flex justify-content-end">
            <a class="btn btn-light-secondary btn-sm me-1 mb-1" href="{{ url('/pengaduan/selesai') }}"><i class="bi bi-arrow-repeat"></i></a>
            <button type="submit" class="btn btn-primary btn-sm me-1 mb-1">Cari Pengaduan</button>
          </div>
        </div>
      </form>
    </div>         
   
</div>
</section>







<!-- DATA PENGADUAN STATUS SELESAI -->
<section class="section">
  <h5 class="text-muted font-bold mb-2">Pengaduan Selesai</h5>

    <!-- NOTIFIKASI BERHASIL UPDATE -->
    @if (session('status'))
          <div class="alert alert-success alert-dismissible show fade">
            <i class="bi bi-check-circle"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
    @endif


@foreach( $pengaduanMasuk as $selesai)
<div class="card">
    <div class="row" id="table-responsive">
        <div class="col-12">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-12">
                <p style="font-size:14px;">No. Pengaduan: {{ ($pengaduanMasuk ->currentpage()-1) * $pengaduanMasuk ->perpage() + $loop->index + 1 }} - #{{ $selesai->id }}</p>
              </div>
                    <div class="col-md-6 col-12" style="text-align:right;">
                    @if ( $selesai->status == 'Belum Diproses')
                        <span class="badge rounded-pill bg-danger" style="font-size: 12px;">Belum diproses</span>

                        @elseif ($selesai->status == 'Sedang diproses oleh Bidang Pengaduan & Pelaporan')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Pengaduan & Pelaporan</span>
                        
                        @elseif ($selesai->status == 'Sedang diproses oleh Bidang Program & Informasi')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Program & Informasi</span>
                        
                        @elseif ($selesai->status == 'Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</span>
                        
                        @elseif ($selesai->status == 'Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Perizinan Pemerintahan & Pembangunan</span>
                        
                        @elseif ($selesai->status == 'Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Pelayanan Perizinan Ekonomi</span>

                        @elseif ($selesai->status == 'Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Pelaksanaan Penanaman Modal</span>

                        @elseif ($selesai->status =='Selesai')
                        <span class="badge rounded-pill bg-success" style="font-size: 12px;">Selesai</span>

                        @else ($selesai->status =='Tidak Aktif')
                        <span class="badge rounded-pill bg-danger" style="font-size: 12px;">Tidak Aktif</span>
                    @endif
                    </div>
                    
                    <div class="col-md-6 col-12">
                            <label for="judul" style="color:#403e3e; font-weight:bold;">Judul Pengaduan</label>
                            <p type="text" id="judul" name="judul">{{ $selesai->judul }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="tgl_verifikasi" style="color:#403e3e; font-weight:bold;">Tanggal Verifikasi</label>
                            <p type="text" id="tgl_verifikasi" name="tgl_verifikasi">{{ \Carbon\Carbon::parse($selesai->tgl_verifikasi)->format('d M Y') }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="kategori" style="color:#403e3e; font-weight:bold;">Kategori</label>
                            <p type="text" id="kategori" name="kategori">{{ $selesai->kategori }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                      <label for="pegawai_id" style="color:#403e3e; font-weight:bold;">Diverifikasi oleh</label>
                        <p type="text" class="form-control-plaintext" id="pegawai_id" name="pegawai_id" 
                          value="">{{ $selesai->pegawai['nama'] }} | <b>Username: {{ $selesai->pegawai['username'] }}</b></p>
                    </div>
     
                    <div class="col-md-12">
                            <label for="deskripsi" style="color:#403e3e; font-weight:bold;">Deskripsi</label>
                            <p type="text" id="deskripsi" name="deskripsi">
                            {{ Str::limit( $selesai->deskripsi, 235, '....') }}
                            </p>
                    </div>
                          
                    <div class="col-sm-12 " >
                        <a href="/pengaduan/detail-selesai/{{ $selesai->id }}" class="btn btn-outline-success text-black btn-sm"><i class="bi bi-check2-circle"></i> Detail</a>
                    </div>
                </div>
           
          </div>
     
        </div>
    </div>
</div>
@endforeach

    <!-- PAGINATION -->
      <div class="d-flex justify-content-end" style="margin-top:13px; margin-right:20px;">
        {{ $pengaduanMasuk->appends(request()->input())->links() }}
      </div>

</section>


@endsection