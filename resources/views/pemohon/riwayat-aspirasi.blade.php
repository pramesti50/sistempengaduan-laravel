@extends('layout.mainpemohon')
@section('title', 'Riwayat Aspirasi Pemohon | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Riwayat Aspirasi Saya')
@section('content')

<section class="section">
    <div class="card">
        

        <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible show fade">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        
            <div class="table-responsive">
                <a type="button" class="btn btn-primary btn-sm mb-3" style="float:right;" href="/pemohon/tambah_aspirasi">Tambah Aspirasi</a>

            <table class="table table-hover table-bordered">
              <thead>
                <tr style="text-align:center;">
                  <th>No.</th>
                  <th>Judul Aspirasi</th>
                  <th>Deskripsi Aspirasi</th>
                  <th>Tanggal<br>Aspirasi</th>
                </tr>
              </thead>

              <tbody>
                @foreach( $dataaspirasi as $riwayataspirasi )
                <tr>
                  <td scope="row" style="text-align:center;" width="40px">{{ ($dataaspirasi ->currentpage()-1) * $dataaspirasi ->perpage() + $loop->index + 1 }}.</td>
                  <td width="200px">{{ $riwayataspirasi->judul }}</td>
                  <td width="500px">{{ $riwayataspirasi->deskripsi }}</td>
                  <!-- <td width="120px">{{ $riwayataspirasi->pemohon->nama }}</td> -->
                  <td style="text-align:center;" width="100px">{{ $riwayataspirasi->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <!-- PAGINATION -->
            <div class="d-flex justify-content-end">
                {{ $dataaspirasi->links() }}
            </div>

        </div>
    </div>
</section>
@endsection