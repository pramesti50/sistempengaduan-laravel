@extends('layout.main')
@section('title', 'Cetak Laporan Pengaduan | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')

@if(auth('pegawai')->user()->level == "Admin")
    @section('header', 'Cetak Laporan Pengaduan')
@else
    @section('header', 'Data Laporan Pengaduan')
@endif

@section('content')

<section class="section">
  <div class="card">
    
        <div class="col-12">
            <div class="card-header">
                <h6>Filter Pengaduan Berdasarkan Tanggal</h6>
            </div>

            <div class="card-body"> 
                <form class="{{ route('indexCetakPengaduan') }}" method="GET">
                    <div class="row">
                        <div class="col-sm-4 col-12">
                            <div class="form-group">
                                <label for="tgl_awalpengaduan">Dari Tanggal</label>
                                <input type="date" id="tgl_awalpengaduan" name="tgl_awalpengaduan" class="form-control" value="{{ request()->input('tgl_awalpengaduan') }}">
                            </div>
                        </div>
                                
                        <div class="col-sm-4 col-12">
                            <div class="form-group">
                                <label for="tgl_akhirpengaduan">Sampai Tanggal</label>
                                <input type="date" id="tgl_akhirpengaduan" name="tgl_akhirpengaduan" class="form-control" value="{{ request()->input('tgl_akhirpengaduan') }}">
                            </div>
                        </div>

                        <div class="col-sm-4 col-12" style="margin-top:25px;">
                            <div class="btn-group mb-3 btn-group" role="group" aria-label="Basic example">
                                <button type="submit" class="btn btn-primary btn-sm "><i class="bi bi-search"></i> Cari</button>
                                <button type="button" class="btn btn-light-secondary btn-sm " data-bs-toggle="modal" data-bs-target="#infopengaduan"><i class="bi bi-info-circle"></i> Info</button>
                                <a class="btn btn-primary btn-sm" href="{{ url('/pengaduan/cetakpengaduan') }}"><i class="bi bi-arrow-repeat"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    
  </div>
</section>


<!--content Modal -->
<div class="modal fade" id="infopengaduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title white">Rincian Info Data Pengaduan</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <i data-feather="x"></i>
            </button>
        </div>
                    
            <!-- isi modal -->
            <div class="modal-body">
                <table class="table table-hover table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th style="text-align:center;">Rincian Data</th>
                            <th style="text-align:center;">Jumlah</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Pengaduan Belum Diproses</td>
                            <td style="text-align:center;">{{ $blmproses }}</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Pengaduan Sedang Diproses</td>
                            <td style="text-align:center;">{{ $sedangproses }}</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Pengaduan Selesai</td>
                            <td style="text-align:center;">{{ $selesai }}</td>
                        </tr>

                        <tr>
                            <!-- <td>4.</td> -->
                            <td colspan="2">Total Pengaduan Aktif</td>
                            <td style="text-align:center;">{{ $aktif }}</td>
                        </tr>
                        <tr>
                            <!-- <td>5.</td> -->
                            <td colspan="2">Total Pengaduan Tidak Aktif</td>
                            <td style="text-align:center;">{{ $tdkaktif }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Total Semua Data Pengaduan</td>
                            <td style="text-align:center;">{{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
                <!-- @if(Auth::guard('pegawai')->user()->level == "Admin")
                <div class="mb-5">   
                    <a class="btn btn-outline-dark btn-sm" href="{{ url('/pengaduan/tidak-aktif') }}" type="button" style="float:right;">Pengaduan Non-Aktif</a>
                </div>
                @endif -->
            </div>
        </div>
    </div>
</div>
<!-- end modal -->





<section class="section">
    <div class="card">
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card-header">
                    <h6>Hasil Filter Data Pengaduan</h6>
                    @if($cetakTglPengaduan ?? '')
                    
                        @if(auth('pegawai')->user()->level == "Admin")
                        @php
                            if(empty($tgl_awalpengaduan) && empty($tgl_akhirpengaduan)) {
                                $tgl_awalpengaduan = 0;
                                $tgl_akhirpengaduan = 0;
                            }
                        @endphp
                        <div class="col-sm-12 d-flex justify-content-end">
                            <a href="{{ route('laporanpengaduanpdf', ['tgl_awalpengaduan' => $tgl_awalpengaduan, 'tgl_akhirpengaduan' => $tgl_akhirpengaduan ]) }}" target="_blank" class="btn btn-primary btn-sm me-1 mb-1"><i class="fa fa-print fa-3px"></i> Print</a>
                        </div>
                        @endif

                    @endif
                </div>
                
                <!-- mulai -->
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($cetakTglPengaduan ?? '')
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th scope="col">No.</th>
                                        <th scope="col">Tgl Pengaduan</th>
                                        <th scope="col">Nama Pemohon</th>
                                        <th scope="col">Kategori Pengaduan</th>
                                        <th scope="col">Judul Pengaduan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tgl <br>Verifikasi</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                    
                                <tbody>
                                    @foreach( $cetakTglPengaduan as $semuaPengaduan )
                                        <tr>
                                            <td scope="row" style="text-align:center;" width="20px">{{ ($cetakTglPengaduan ->currentpage()-1) * $cetakTglPengaduan ->perpage() + $loop->index + 1 }}.</td>
                                            <td style="text-align:center;" width="100px">{{ \Carbon\Carbon::parse($semuaPengaduan->tgl_pengaduan)->format('d/m/Y') }}</td>
                                            <td>{{ $semuaPengaduan->pemohon->nama }}</td>
                                            <td>{{ $semuaPengaduan->kategori }}</td>
                                            <td >{{ $semuaPengaduan->judul }}</td>
                                            <td width="150px" >
                                                @if ( $semuaPengaduan->status == 'Belum Diproses')
                                                    <p>Belum diproses</p>

                                                @elseif ($semuaPengaduan->status == 'Sedang diproses oleh Bidang Pengaduan & Pelaporan')
                                                    <p>Sedang diproses Bidang Pengaduan & Pelaporan</p>
                                                
                                                @elseif ($semuaPengaduan->status == 'Sedang diproses oleh Bidang Program & Informasi')
                                                    <p>Sedang diproses Bidang Program & Informasi</p>
                                                
                                                @elseif ($semuaPengaduan->status == 'Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan')
                                                    <p>Sedang diproses Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</p>
                                                
                                                @elseif ($semuaPengaduan->status == 'Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan')
                                                    <p>Sedang diproses Bidang Perizinan Pemerintahan & Pembangunan</p>
                                                
                                                @elseif ($semuaPengaduan->status == 'Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi')
                                                    <p>Sedang diproses Bidang Pelayanan Perizinan Ekonomi</p>

                                                @elseif ($semuaPengaduan->status == 'Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal')
                                                    <p>Sedang diproses Bidang Pelaksanaan Penanaman Modal</p>

                                                @elseif ($semuaPengaduan->status =='Selesai')
                                                    <p>Selesai</p>

                                                @else
                                                    <p>Tidak Aktif</p>

                                                @endif
                                            </td>
                                            <td style="text-align:center;" width="100px">{{ $semuaPengaduan->tgl_verifikasi ? \Carbon\Carbon::parse($semuaPengaduan->tgl_verifikasi)->format('d/m/Y') : null }}</td>
                                            <td>
                                                <button class="btn btn-light-secondary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detail{{ $semuaPengaduan->id}}">Detail</button>
                                            </td>
                                            <!--scrolling content Modal -->
                                            <div class="modal fade" id="detail{{ $semuaPengaduan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary">
                                                            <h5 class="modal-title white">Detail Laporan Pengaduan Pemohon</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                    
                                                        <!-- FORM EDIT STATUS -->
                                                        <div class="modal-body">
                                                        
                                                            <!--TAMPILKAN DATA PENGADUAN BERDASARKAN ID -->
                                                            <div class="form-group">
                                                                <label for="kategori" style="color:#000;">Kategori Pengaduan</label>
                                                                <p type="text" class="form-control-plaintext" id="kategori" name="kategori">{{ $semuaPengaduan->kategori }}</p>
                                                            </div>
            
                                                            <div class="form-group">
                                                                <label for="judul" style="color:#000;">Judul Pengaduan</label>
                                                                <p type="text" class="form-control-plaintext" id="judul" name="judul">{{ $semuaPengaduan->judul }}</p>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="deskripsi" style="color:#000;">Deskripsi</label>
                                                                <p type="text" class="form-control-plaintext" id="deskripsi" name="deskripsi" style="text-align:justify;">{{ $semuaPengaduan->deskripsi }}</p>
                                                            </div>
                                                        
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-12">
                                                                    <label for="tgl_pengaduan" style="color:#000;">Tanggal Pengaduan</label>
                                                                    <p type="text" class="form-control-plaintext" id="tgl_pengaduan" name="tgl_pengaduan" readonly value="">{{ \Carbon\Carbon::parse($semuaPengaduan->tgl_pengaduan)->format('d M Y') }}</p>
                                                                </div>
                                                    
                                                                <div class="form-group col-md-6 col-12">
                                                                    <label for="pemohon_id" style="color:#000;">Nama Pemohon</label>
                                                                    <p class="form-control-plaintext" id="pemohon_id" name="pemohon_id" value="" readonly>{{ $semuaPengaduan->pemohon->nama }}</p>
                                                                </div>
            
                                                                <div class="form-group col-md-6 col-12">
                                                                    <label for="tgl_verifikasi" style="color:#000;">Tanggal Verifikasi</label>
                                                                    <p class="form-control-plaintext" id="tgl_verifikasi" name="tgl_verifikasi" value="" readonly>{{ $semuaPengaduan->tgl_verifikasi ? \Carbon\Carbon::parse($semuaPengaduan->tgl_verifikasi)->format('d M Y') : null }}</p>
                                                                </div>
            
                                                                <div class="form-group col-md-6 col-12">
                                                                    <label for="pemohon_id" style="color:#000;">Username Pemohon</label>
                                                                    <input type="text" class="form-control-plaintext" id="pemohon_id" name="pemohon_id" value="{{ $semuaPengaduan->pemohon->username }}" readonly>
                                                                </div>
                                                            </div>
            
                                                            <div class="form-group">
                                                                <label for="tanggapan" style="color:#000;">Tindak Lanjut</label>
                                                                <p type="text" class="form-control-plaintext" id="tanggapan" name="tanggapan" style="text-align:justify;">{!! nl2br(e($semuaPengaduan->tanggapan)) !!}</p>
                                                            </div>
            
                                                            <div class="form-group">
                                                                <label for="pegawai_id" style="color:#403e3e; font-weight:bold;">Diverifikasi oleh</label>
                                                                @if (empty($semuaPengaduan->pegawai))
                                                                    <p type="text" class="form-control-plaintext" id="pegawai_id" name="pegawai_id">
                                                                        Menunggu Verifikasi
                                                                    </p>
                                                                @else
                                                                    <p type="text" class="form-control-plaintext" id="pegawai_id" name="pegawai_id">
                                                                        {{ $semuaPengaduan->pegawai->nama }} | <b>Username: {{ $semuaPengaduan->pegawai->username }}</b>
                                    
                                                                    </p>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="pegawai_id" style="color:#000;">Kategori Bidang</label>
                                                                <p type="text" class="form-control-plaintext" id="pegawai_id" name="pegawai_id" 
                                                                value="">{{ $semuaPengaduan->pegawai['namabidang'] }}</p>
                                                            </div>
            
                                                            <div class="form-group">
                                                                <label for="status" style="color:#000;">Status</label>
                                                                <p type="text" class="form-control-plaintext" id="status" name="status">{{ $semuaPengaduan->status }}</p>
                                                            </div> 
            
                                                            <!-- end tampil data -->     
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end modal scrolling -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> 

                        @else
                            <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th scope="col">No.</th>
                                            <th scope="col">Tgl <br>Pengaduan</th>
                                            <th scope="col">Nama Pemohon</th>
                                            <th scope="col">Kategori <br>Pengaduan</th>
                                            <th scope="col">Judul Pengaduan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tgl <br>Verifikasi</th>
                                            <th scope="col">Detail</th>
                                        </tr>
                                    </thead>
                            </table>
                        
                        @endif

                        @if ($cetakTglPengaduan ?? '')
                            <!-- PAGINATION -->
                            <div class="d-flex justify-content-end">
                                {{ $cetakTglPengaduan->appends(request()->input())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- selesai -->

            </div>
        </div>
    </div>
</section>

    

@endsection