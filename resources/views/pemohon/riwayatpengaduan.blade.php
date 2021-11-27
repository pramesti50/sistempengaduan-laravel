@extends('layout.mainpemohon')
@section('title', 'Riwayat Pengaduan Pemohon| Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Riwayat Pengaduan Saya')
@section('content')


<section class="section">
  <div class="card">
  <div class="row" id="table-responsive">
    <div class="col-12">
    
    
    <div class="card-body">

      @if (session('status'))
        <div class="alert alert-success alert-dismissible show fade">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      @endif

      
      <div class="table-responsive">
      <a type="button" class="btn btn-primary btn-sm mb-3" style="float:right;" href="/pemohon/tambah-pengaduan">Tambah Pengaduan</a>

      <table class="table table-hover table-bordered">
        <thead>
          <tr class="judultengah" style="text-align:center;">
            <th scope="col" width="30px">No.</th>
            <th scope="col" width="300px">Judul Pengaduan</th>
            <th scope="col" width="255px">Kategori</th>
            <!-- <th scope="col" width="120px">Tanggal <br>Pengaduan</th> -->
            <th scope="col" width="120px">Status</th>
            <th scope="col" width="120px">Tanggal <br>Verifikasi</th>      
            <th scope="col" width="30px">Lihat <br>Detail</th>
          </tr>
        </thead>

        <tbody>
        @foreach($pengaduan as $riwayat)
          <tr>
            <td scope="row" style="text-align:center;">{{ $loop->iteration }}.</td>
            <td style="text-align:justify;" width="130px">{{ $riwayat->judul }}</td>
            <td width="335px">{{ $riwayat->kategori }}</td>
            <!-- <td style="text-align:center;" width="120px">{{ $riwayat->tgl_pengaduan }}</td> -->
            <td style="text-align:center;" width="120px">
              @if ( $riwayat->status == 'Belum Diproses')
                <span class="badge bg-danger" style="font-size: 12px;">Belum diproses</span>

                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Pengaduan & Pelaporan')
                  <span class="badge bg-warning" style="font-size: 12px;">Sedang diproses</span>
                
                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Program & Informasi')
                  <span class="badge bg-warning" style="font-size: 12px;">Sedang diproses</span>
                
                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan')
                  <span class="badge bg-warning" style="font-size: 12px;">Sedang diproses</span>
                
                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan')
                  <span class="badge bg-warning" style="font-size: 12px;">Sedang diproses</span>
                
                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi')
                  <span class="badge bg-warning" style="font-size: 12px;">Sedang diproses</span>

                @elseif ($riwayat->status == 'Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal')
                  <span class="badge bg-warning" style="font-size: 12px;">Sedang diproses</span>

                @elseif ($riwayat->status =='Selesai')
                  <span class="badge bg-success" style="font-size: 12px;">Selesai</span>
                
                @else ($riwayat->status =='Tidak Aktif')
                  <span class="badge bg-success" style="font-size: 12px;">Selesai</span>
              @endif

            </td>
            <td style="text-align:center;">{{ $riwayat->tgl_verifikasi ? \Carbon\Carbon::parse($riwayat->tgl_verifikasi)->format('d M Y') : null }}</td>
            <td style="text-align:center;">  
              <!-- <button class="btn btn-outline-dark rounded-pill btn-sm"> -->
                <a href="/pemohon/detail-riwayatpengaduan/{{ $riwayat->id }}" type="button" class="btn btn-light-secondary rounded-pill btn-sm"><i class="bi bi-info-lg"></i></a>
              <!-- </button>  -->
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>


      <!-- PAGINATION -->
    <div class="d-flex justify-content-end">
      {{ $pengaduan->links() }}
    </div>


      </div>
    </div>
    </div>
    
</div>



  </div>
</section>





@endsection