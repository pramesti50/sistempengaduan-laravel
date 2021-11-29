@extends('layout.main')
@section('title', 'Sedang Diproses | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Data Pengaduan Pemohon Sedang Diproses')
@section('content')



<section class="section">
  <div class="card">
    <div class="card-body">
    <h6 class="text-muted mb-2">Total Pengaduan Sedang Diproses : {{$sedangproses}}</h6>
          
  <!-- form cari status -->
      <form action="/pengaduan/sedang-diproses" method="GET">
      
        <div class="col-sm-7 col-12">
          <div class="input-group">
            <select name="caristatus" id="caristatus" class="form-select" value="{{ old('caristatus') }}">
              <option label="--Pilih Status Sedang Diproses oleh Bidang--"></option>
                  <option value="Sedang diproses oleh Bidang Pengaduan & Pelaporan">Bidang Pengaduan & Pelaporan</option>
                  <option value="Sedang diproses oleh Bidang Program & Informasi">Bidang Program & Informasi</option>
                  <option value="Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan">Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</option>
                  <option value="Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan">Bidang Perizinan Pemerintahan & Pembangunan</option>
                  <option value="Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi">Bidang Pelayanan Perizinan Ekonomi</option>
                  <option value="Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal">Bidang Pelaksanaan Penanaman Modal</option>
            </select>

              <button type="submit" class="btn btn-primary">Cari</button> 
              <a class="btn btn-light-secondary" type="button"  href="/pengaduan/sedang-diproses"><i class="bi bi-arrow-repeat"></i></a>
              
              
          
          </div>
        </div>
      </form>

    </div>   
  </div>     
<!-- end form cari status -->

<h5 class="text-muted font-bold mb-2">Pengaduan Sedang Diproses</h5>

<!-- NOTIFIKASI BERHASIL UPDATE -->
    @if (session('status'))
      <div class="alert alert-success alert-dismissible show fade">
        <i class="bi bi-check-circle"></i>
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
    @endif

     
<!-- TAMPILAN DATA PENGADUAN SEDANG DIPROSES -->
@foreach( $pengaduanMasuk as $sedangproses)
<div class="card">
    
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-12">
                <p style="font-size:14px;">No. Pengaduan: {{ ($pengaduanMasuk ->currentpage()-1) * $pengaduanMasuk ->perpage() + $loop->index + 1 }} - #{{ $sedangproses->id }}</p>
              </div>
            
                    <div class="col-md-6 col-12">
                    @if ( $sedangproses->status == 'Sedang diproses oleh Bidang Pengaduan & Pelaporan')
                        <span class="badge bg-light-primary" style="font-size: 12px;">Diproses Bidang Pengaduan & Pelaporan</span>
                        
                        @elseif ($sedangproses->status == 'Sedang diproses oleh Bidang Program & Informasi')
                        <span class="badge bg-info" style="font-size: 12px;">Diproses Bidang Program & Informasi</span>
                        
                        @elseif ($sedangproses->status == 'Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan')
                        <span class="badge bg-warning" style="font-size: 12px; color:#000;">Diproses Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</span>
                        
                        @elseif ($sedangproses->status == 'Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan')
                        <span class="badge bg-secondary" style="font-size: 12px;">Diproses Bidang Perizinan Pemerintahan & Pembangunan</span>
                        
                        @elseif ($sedangproses->status == 'Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi')
                        <span class="badge bg-light-success" style="font-size: 12px;">Diproses Bidang Pelayanan Perizinan Ekonomi</span>

                        @elseif ($sedangproses->status == 'Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal')
                        <span class="badge bg-primary" style="font-size: 12px;">Diproses Bidang Pelaksanaan Penanaman Modal</span>

                        @else ($sedangproses->status =='Selesai')
                        <span class="badge bg-success" style="font-size: 12px;">Selesai</span>
                    @endif
                    </div>
                    
                    <div class="col-md-6 col-12">
                            <label for="judul" style="color:#403e3e; font-weight:bold;">Judul Pengaduan</label>
                            <p type="text" id="judul" name="judul">{{ $sedangproses->judul }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="tgl_pengaduan" style="color:#403e3e; font-weight:bold;">Tanggal Pengaduan</label>
                            <p type="text" id="tgl_pengaduan" name="tgl_pengaduan">{{ \Carbon\Carbon::parse($sedangproses->tgl_pengaduan)->format('d M Y') }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="kategori" style="color:#403e3e; font-weight:bold;">Kategori</label>
                            <p type="text" id="kategori" name="kategori">{{ $sedangproses->kategori }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="pemohon_id" style="color:#403e3e; font-weight:bold;">Nama Pemohon</label>
                            <p type="text" id="pemohon_id" name="pemohon_id">{{ $sedangproses->pemohon->nama}}</p>
                    </div>
     
                    <div class="col-md-12">
                            <label for="deskripsi" style="color:#403e3e; font-weight:bold;">Deskripsi</label>
                            <p type="text" id="deskripsi" name="deskripsi">
                            {{ Str::limit( $sedangproses->deskripsi, 235, '....') }}
                            </p>
                    </div>
                          
                    <div class="col-sm-12 mt-3" >
                        <a href="/pengaduan/detail-sedang-diproses/{{ $sedangproses->id }}" class="btn btn-outline-primary btn-sm">Verifikasi</a>
                    </div>
                </div>
           
          </div>
 
</div>
@endforeach

    <!-- PAGINATION -->
    @if($pengaduanMasuk ?? '')
      <div class="d-flex justify-content-end" style="margin-top:13px; margin-right:20px;">
        {{ $pengaduanMasuk->appends(request()->input())->links() }}
      </div>
    @endif
  

</section>



@endsection