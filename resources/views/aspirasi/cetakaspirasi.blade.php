@extends('layout.main')
@section('title', 'Cetak dan Filter Aspirasi | Sistem Pengaduan DPMPTSP Kabupaten BADUNG') 
@section('header', 'Cetak Laporan Aspirasi Pemohon')   
@section('content')

<section class="section">
  <div class="card">
    
        <div class="col-12">
            <div class="card-header">
                <h6>Filter Aspirasi Berdasarkan Tanggal</h6>
            </div>

            <div class="card-body">
                <form class="{{ route('cariDataAspirasi') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tgl_awal">Tanggal Awal</label>
                            <input type="date" id="tgl_awal" name="tgl_awal" class="form-control">
                        </div>
                    </div>
                       
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="tgl_akhir">Tanggal Akhir</label>
                            <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="reset" class="btn btn-light-secondary btn-sm me-1 mb-1">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm me-1 mb-1">Cari Data Aspirasi</button>
                    </div>
                </div>
                </form>
            </div>
    
        </div>
    
  </div>
</section>

<section class="section">
<div class="card">
    <div class="row" id="table-responsive">
        <div class="col-12">
            <div class="card-header">
                <h6>Hasil Filter Data Aspirasi Berdasarkan Tanggal</h6>
            @if($cetaktglAspirasi ?? '')
                @if(auth('pegawai')->user()->level == "Admin")
                <div class="col-sm-12 d-flex justify-content-end">
                    <a href="{{ route('laporan_aspirasipdf', ['tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir ]) }}" 
                    target="_blank" class="btn btn-primary"><i class="fa fa-print fa-3px"></i> Print</a>
                </div>
                @endif
            @endif
            </div>

            <div class="card-body">
            <div class="table-responsive">
                @if ($cetaktglAspirasi ?? '')
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr style="text-align:center;">
                                <th scope="col">No.</th>
                                <th scope="col">Judul Aspirasi</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Nama Pemohon</th>
                                <th scope="col">Tanggal<br>Aspirasi</th>
                            </tr>
                        </thead>
                            
                        <tbody>
                        @foreach( $cetaktglAspirasi as $semuaaspirasi )
                            <tr>
                                <td scope="row" style="text-align:center;"width="20px">{{ $loop->iteration }}.</td>
                                <td width="200px">{{ $semuaaspirasi->judul }}</td>
                                <td width="400px">{{ $semuaaspirasi->deskripsi }}</td>
                                <td width="150px">{{ $semuaaspirasi->pemohon->nama }}</td>
                                <td width="110px" style="text-align:center;" width="100px">{{ $semuaaspirasi->created_at->format('d-m-Y') }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>

                @else
                <table class="table table-striped table-bordered">
                        <thead>
                            <tr style="text-align:center;">
                                <th scope="col">No.</th>
                                <th scope="col">Judul Aspirasi</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Nama Pemohon</th>
                                <th scope="col">Tanggal<br>Aspirasi</th>
                            </tr>
                        </thead>
                </table>
                    <div class="text-center">
                        "Tidak Ada Data"
                    </div>
                @endif
                </div>
            </div>
    
        </div>
    </div>
  </div>
  </section>


@endsection