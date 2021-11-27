@extends('layout.mainpemohon')
@section('title', 'Detail Riwayat Pengaduan | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Detail Riwayat Pengaduan Saya')
@section('content')

<section class="section">
  <div class="card">
    <!-- <div class="card-header">
      <p class="text-subtitle text-muted">Detail Riwayat Pengaduan</p>
    </div> -->
    <div class="card-body">
    
          <div class="form-group">
            <label for="judul" style="color:#000;">Judul Pengaduan</label>
              <input type="text" class="form-control-plaintext" id="judul" name="judul" value="{{ $riwayat->judul}}" readonly>
          </div>
          
          <div class="form-group">
            <label for="kategori" style="color:#000;">Kategori</label>
              <input type="text" class="form-control-plaintext" id="kategori" name="kategori" value="{{ $riwayat->kategori}}" readonly>
          </div>

          <div class="form-group">
            <label for="deskripsi" style="color:#000;">Deskripsi</label>
              <p type="text" id="deskripsi" name="deskripsi" readonly style="text-align:justify;">{{ $riwayat->deskripsi}}</p>
          </div>

      <div class="row">
          <div class="form-group col-md-6 col-12">
            <label for="tgl_pengaduan" style="color:#000;">Tanggal Pengaduan</label>
              <input  type="text" class="form-control-plaintext" id="tgl_pengaduan" name="tgl_pengaduan" value="{{ \Carbon\Carbon::parse($riwayat->tgl_pengaduan)->format('d M Y')}}" readonly disabled>
          </div>

          <div class="form-group col-md-6 col-12">
            <label for="tgl_verifikasi" style="color:#000;">Tanggal Verifikasi</label>
              <input class="form-control-plaintext" id="tgl_verifikasi" name="tgl_verifikasi" value="{{ $riwayat->tgl_verifikasi ? \Carbon\Carbon::parse($riwayat->tgl_verifikasi)->format('d M Y') : null }}" readonly disabled>
          </div>
<hr>
          <div class="form-group col-md-6 col-12">
            <label for="pegawai_id" style="color:#000;">Diverifikasi oleh</label>
              <input type="text" class="form-control-plaintext" id="pegawai_id" name="pegawai_id" value="{{ $riwayat->pegawai['username'] }}" readonly>                   
          </div>

      
          <div class="form-group col-md-6 col-12">
            <label for="status" style="color:#000;">Status</label>
            <br>
            @if ( $riwayat->status == 'Belum Diproses')
                <span class="badge bg-danger">Belum diproses</span>

                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Pengaduan & Pelaporan')
                  <span class="badge bg-warning">Sedang diproses</span>
                
                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Program & Informasi')
                  <span class="badge bg-warning">Sedang diproses</span>
                
                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan')
                  <span class="badge bg-warning">Sedang diproses</span>
                
                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan')
                  <span class="badge bg-warning">Sedang diproses</span>
                
                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi')
                  <span class="badge bg-warning">Sedang diproses</span>

                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal')
                  <span class="badge bg-warning">Sedang diproses</span>

                @elseif ($riwayat->status =='Selesai')
                  <span class="badge bg-success">Selesai</span>

                @else ($riwayat->status =='Tidak Aktif')
                  <span class="badge bg-success">Selesai</span>
              @endif
          </div>  

      </div>

          <div class="form-group">
            <label for="tanggapan" style="color:#000;">Tindak Lanjut</label>
              <p type="text" id="tanggapan" name="tanggapan" readonly style="text-align:justify;">{!! nl2br(e($riwayat->tanggapan)) !!}</p>
          </div>

      <br><br>
      <div class="col-12 d-flex justify-content-end">
        <a href="{{ url('/pemohon/riwayatpengaduan') }}" class="btn btn-secondary btn-sm me-1 mb-1" style="text-decoration:none;">Kembali</a>
        <pre> </pre>
        <a href="{{ url('/pemohon/tambah-pengaduan') }}" class="btn btn-light-secondary btn-sm me-1 mb-1" style="text-decoration:none;">Buat Pengaduan</a>
      </div>


    </div>
  </div>
</section>
@endsection