@extends('layout.main')
@section('title', 'Pengaduan Tidak Aktif | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Data Pengaduan Tidak Aktif')
@section('content')

<section class="section">
  <div class="card"> 
    <div class="card-body">
      <form class="{{ route('caritdkaktif') }}" method="POST">
        
        <div class="row">
        <div class="col-12">
          <h6>Filter Berdasarkan Tanggal Verifikasi</h6>
        </div>

          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="awal_tdkaktif">Dari Tanggal</label>
              <input type="date" id="awal_tdkaktif" name="awal_tdkaktif" class="form-control" value="{{ request()->input('awal_tdkaktif') }}">
            </div>
          </div>
                        
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="akhir_tdkaktif">Sampai Tanggal</label>
              <input type="date" id="akhir_tdkaktif" name="akhir_tdkaktif" class="form-control" value="{{ request()->input('akhir_tdkaktif') }}">
            </div>
          </div>

          <div class="col-md-6 col-12 d-flex ">
          <p class="text-muted font-bold mb-0">Total Pengaduan Tidak Aktif: {{ $total_tdkaktif }}</p>
          </div>

          <div class="col-md-6 col-12 d-flex justify-content-end">
            <a class="btn btn-light-secondary btn-sm me-1 mb-1" href="{{ url('/pengaduan/tidak-aktif') }}"><i class="bi bi-arrow-repeat"></i></a><pre></pre>
            <button type="submit" class="btn btn-secondary btn-sm me-1 mb-1">Cari Pengaduan</button>
          </div>
        </div>
      </form>
    </div>         
   
</div>
</section>








<!-- DATA PENGADUAN STATUS SELESAI -->
<section class="section">
  <h5 class="text-muted font-bold mb-2">Pengaduan Tidak Aktif</h5>

    <!-- NOTIFIKASI BERHASIL UPDATE -->
    @if (session('status'))
          <div class="alert alert-success alert-dismissible show fade">
            <i class="bi bi-check-circle"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
    @endif


@foreach( $tdkaktif as $hide)
<div class="card">
    <div class="row" id="table-responsive">
        <div class="col-12">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-12">
                <p style="font-size:14px;">No. Pengaduan: {{ ($tdkaktif ->currentpage()-1) * $tdkaktif ->perpage() + $loop->index + 1 }} - #{{ $hide->id }}</p>
              </div>
                    <div class="col-md-6 col-12" style="text-align:right;">
                    @if ( $hide->status == 'Belum Diproses')
                        <span class="badge rounded-pill bg-danger" style="font-size: 12px;">Belum diproses</span>

                        @elseif ($hide->status == 'Sedang diproses oleh Bidang Pengaduan & Pelaporan')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Pengaduan & Pelaporan</span>
                        
                        @elseif ($hide->status == 'Sedang diproses oleh Bidang Program & Informasi')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Program & Informasi</span>
                        
                        @elseif ($hide->status == 'Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</span>
                        
                        @elseif ($hide->status == 'Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Perizinan Pemerintahan & Pembangunan</span>
                        
                        @elseif ($hide->status == 'Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Pelayanan Perizinan Ekonomi</span>

                        @elseif ($hide->status == 'Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Pelaksanaan Penanaman Modal</span>

                        @elseif ($hide->status =='Selesai')
                        <span class="badge rounded-pill bg-success" style="font-size: 12px;">Selesai</span>

                        @else ($hide->status =='Tidak Aktif')
                        <span class="badge rounded-pill bg-dark" style="font-size: 12px;">Tidak Aktif</span>
                    @endif
                    </div>
                    
                    <div class="col-md-6 col-12">
                            <label for="judul" style="color:#403e3e; font-weight:bold;">Judul Pengaduan</label>
                            <p type="text" id="judul" name="judul">{{ $hide->judul }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="tgl_verifikasi" style="color:#403e3e; font-weight:bold;">Tanggal Verifikasi</label>
                            <p type="text" id="tgl_verifikasi" name="tgl_verifikasi">{{ \Carbon\Carbon::parse($hide->tgl_verifikasi)->format('d M Y') }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="kategori" style="color:#403e3e; font-weight:bold;">Kategori</label>
                            <p type="text" id="kategori" name="kategori">{{ $hide->kategori }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                      <label for="pegawai_id" style="color:#403e3e; font-weight:bold;">Diverifikasi oleh</label>
                        <p type="text" class="form-control-plaintext" id="pegawai_id" name="pegawai_id" 
                          value="">{{ $hide->pegawai['nama'] }} | <b>Username: {{ $hide->pegawai['username'] }}</b></p>
                    </div>
     
                    <div class="col-md-12">
                            <label for="deskripsi" style="color:#403e3e; font-weight:bold;">Deskripsi</label>
                            <p type="text" id="deskripsi" name="deskripsi">
                            {{ Str::limit( $hide->deskripsi, 235, '....') }}
                            </p>
                    </div>
                          
                    <div class="col-sm-12 " >
                        <a href="/pengaduan/detail-tidakaktif/{{ $hide->id }}" class="btn btn-outline-secondary btn-sm">Detail</a>
                    </div>
                </div>
           
          </div>
     
        </div>
    </div>
</div>
@endforeach

    <!-- PAGINATION -->
      <div class="d-flex justify-content-end" style="margin-top:13px; margin-right:20px;">
        {{ $tdkaktif->appends(request()->input())->links() }}
      </div>

</section>


@endsection