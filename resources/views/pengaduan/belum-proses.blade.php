@extends('layout.main')
@section('title', 'Belum Diproses | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Data Pengaduan Pemohon Belum Diproses')
@section('content')


<section class="section">
    <!-- NOTIFIKASI BERHASIL UPDATE -->
<div class="card">
<div class="col-12">
  <div class="card-body">
  <div class="row">
  <div class="col-md-6 col-12">
    <h6 class="text-muted mt-1">Jumlah Pengaduan Masuk : {{ $blmproses }}</h6>
  </div>

  <div class="col-md-6 col-12">
    <div class="btn-group" role="group" aria-label="Basic example" style="float:right;">
      <a type="button" class="btn btn-light-secondary btn-sm me-1 mb-1" href="/pengaduan/sedang-diproses">Sedang Diproses</a>
    </div>
  </div>
  
  </div>
  
  </div>
  </div>
</div>

<h5 class="text-muted font-bold mb-2">Pengaduan Masuk</h5>

@if (session('status'))
      <div class="alert alert-success alert-dismissible show fade">
        <i class="bi bi-check-circle"></i>
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
     @endif

@foreach( $pengaduanMasuk as $blmproses)
<div class="card">
    <div class="row" id="table-responsive">
        <div class="col-12">
        

          <div class="card-body">
          

            <div class="row">
            <div class="col-md-6 col-12">
              <p style="font-size:14px;">No. Pengaduan: {{ ($pengaduanMasuk ->currentpage()-1) * $pengaduanMasuk ->perpage() + $loop->index + 1 }} - #{{ $blmproses->id }}</p>
              </div>
                
                    <div class="col-md-6 col-12" style="text-align:right;">
                    @if ( $blmproses->status == 'Belum Diproses')
                        <span class="badge rounded-pill bg-danger" style="font-size: 12px;">Belum diproses</span>

                        @elseif ($blmproses->status == 'Sedang diproses oleh Bidang Pengaduan & Pelaporan')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Pengaduan & Pelaporan</span>
                        
                        @elseif ($blmproses->status == 'Sedang diproses oleh Bidang Program & Informasi')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Program & Informasi</span>
                        
                        @elseif ($blmproses->status == 'Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</span>
                        
                        @elseif ($blmproses->status == 'Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Perizinan Pemerintahan & Pembangunan</span>
                        
                        @elseif ($blmproses->status == 'Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Pelayanan Perizinan Ekonomi</span>

                        @elseif ($blmproses->status == 'Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal')
                        <span class="badge rounded-pill bg-warning" style="font-size: 12px;">Diproses Bidang Pelaksanaan Penanaman Modal</span>

                        @else ($blmproses->status =='Selesai')
                        <span class="badge rounded-pill bg-success" style="font-size: 12px;">Selesai</span>
                    @endif
                    </div>
                    
                    <div class="col-md-6 col-12">
                            <label for="judul" style="color:#403e3e; font-weight:bold;">Judul Pengaduan</label>
                            <p type="text" id="judul" name="judul">{{ $blmproses->judul }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="tgl_pengaduan" style="color:#403e3e; font-weight:bold;">Tanggal Pengaduan</label>
                            <p type="text" id="tgl_pengaduan" name="tgl_pengaduan">{{ \Carbon\Carbon::parse($blmproses->tgl_pengaduan)->format('d M Y') }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="kategori" style="color:#403e3e; font-weight:bold;">Kategori</label>
                            <p type="text" id="kategori" name="kategori">{{ $blmproses->kategori }}</p>
                    </div>

                    <div class="col-md-6 col-12">
                            <label for="pemohon_id" style="color:#403e3e; font-weight:bold;">Nama Pemohon</label>
                            <p type="text" id="pemohon_id" name="pemohon_id">{{ $blmproses->pemohon->nama}}</p>
                    </div>
     
                    <div class="col-md-12">
                            <label for="deskripsi" style="color:#403e3e; font-weight:bold;">Deskripsi</label>
                            <p type="text" id="deskripsi" name="deskripsi">
                            {{ Str::limit( $blmproses->deskripsi, 235, '....') }}
                            </p>
                    </div>
                          
                    <div class="col-sm-12" >
                        <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal"
                        data-bs-target="#detailPengaduan{{ $blmproses->id}}"><i class="bi bi-pencil-square"></i> Proses</button>
                    </div>
                </div>
           
          </div>

          <!--scrolling content Modal -->
          <div class="modal fade" id="detailPengaduan{{ $blmproses->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header bg-danger">
                        <h5 class="modal-title white">Detail Laporan Pengaduan Pemohon</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          <i data-feather="x"></i>
                          </button>
                      </div>
                      
              <!-- FORM EDIT STATUS -->
                      <div class="modal-body">
                      <form action="/pengaduan/belum-proses/{{ $blmproses->id }}" method="POST">
                      @csrf
                      @method('PUT')
                        <!--TAMPILKAN DATA PENGADUAN BERDASARKAN ID -->
                        <div class="form-group">
                          <label for="kategori" style="color:#000;">Kategori Pengaduan</label>
                            <p type="text" class="form-control-plaintext" id="kategori" name="kategori">{{ $blmproses->kategori }}</p>
                        </div>

                        <div class="form-group">
                          <label for="judul" style="color:#000;">Judul Pengaduan</label>
                            <p type="text" class="form-control-plaintext" id="judul" name="judul">{{ $blmproses->judul }}</p>
                        </div>
                        
                        <div class="form-group">
                          <label for="deskripsi" style="color:#000;">Deskripsi</label>
                          <p type="text" class="form-control-plaintext" id="deskripsi" name="deskripsi" style="text-align:justify;">{{ $blmproses->deskripsi }}</p>
                            
                        </div>
                    
                        <div class="form-group col-md-6 col-12">
                          <label for="tgl_pengaduan" style="color:#000;">Tanggal Pengaduan</label>
                            <input type="text" class="form-control-plaintext" id="tgl_pengaduan" name="tgl_pengaduan" 
                            onfocusin="(this.type='date')" onfocusout="(this.type='text')" readonly value="{{ \Carbon\Carbon::parse($blmproses->tgl_pengaduan)->format('d M Y') }}">
                        </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label for="pemohon_id" style="color:#000;">Nama Pemohon</label>
                          <input type="text" class="form-control-plaintext" id="pemohon_id" name="pemohon_id" 
                          value="{{ $blmproses->pemohon->nama }}" readonly>
                        </div>

                        <!-- <div class="form-group col-md-6 col-12">
                          <label for="tgl_verifikasi" style="color:#000;">Tanggal Verifikasi Status</label>
                          <input type="text" class="form-control" id="tgl_verifikasi" name="tgl_verifikasi" placeholder="Bulan/Tanggal/Tahun"
                          onfocusin="(this.type='date')" onfocusout="(this.type='text')" value="{{ $blmproses->tgl_verifikasi }}" required>
                        </div> -->

                        <div class="form-group col-md-6 col-12">
                          <label for="pemohon_id" style="color:#000;">Username Pemohon</label>
                          <input type="text" class="form-control-plaintext" id="pemohon_id" name="pemohon_id" 
                          value="{{ $blmproses->pemohon->username }}" readonly>
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="status" style="color:#000;">Status</label>
                            <select name="status" class="choices form-select @error('status') is-invalid @enderror" required>
                                <option value="{{ $blmproses->status }}" selected>{{ $blmproses->status }}</option>
                                <optgroup label="-- Pilih Status --">
                                  <!-- <option value="Belum Diproses">Belum Diproses</option> -->
                                  <option value="Sedang diproses oleh Bidang Pengaduan & Pelaporan">Sedang diproses oleh Bidang Pengaduan & Pelaporan</option>
                                  <option value="Sedang diproses oleh Bidang Program & Informasi">Sedang diproses oleh Bidang Program & Informasi</option>
                                  <option value="Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan">Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</option>
                                  <option value="Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan">Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan</option>
                                  <option value="Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi">Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi</option>
                                  <option value="Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal">Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal</option>
                                  <!-- <option value="Selesai">Selesai</option> -->
                                </optgroup>
                            </select>
                        </div> 

                        <!-- end tampil data -->

                        
                        <div class="mb-5">
                        <button type="submit" class="btn btn-success btn-sm" style="float:right;"><i class="bi bi-arrow-repeat"></i> Sedang Diproses</button>
                        </div>
                        </form>
                      </div>

                    </div>
                  </div>
              </div>

              <!-- end modal scrolling -->
        </div>
    </div>
</div>
@endforeach

<!-- PAGINATION -->
<div class="d-flex justify-content-end">
      {{ $pengaduanMasuk->links() }}
    </div>


</section>


@endsection