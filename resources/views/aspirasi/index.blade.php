@extends('layout.main')
@section('title', 'Data Aspirasi | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Data Aspirasi Pemohon')
@section('content')

<section class="section">
  <div class="card">
    <div class="col-12">
      <div class="card-header">
      @if(Auth::guard('pegawai')->user()->level == "Admin")
        <h6>Filter dan Cetak Aspirasi Berdasarkan Tanggal</h6>
      @else
      <h6>Filter Aspirasi Berdasarkan Tanggal</h6>
      @endif
      </div>

      <div class="card-body">
        <form class="{{ route('filterAspirasi') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-sm-4 col-12">
              <div class="form-group">
                <label for="tgl_awal">Dari Tanggal</label>
                <input type="date" id="tgl_awal" name="tgl_awal" class="form-control">
              </div>
            </div>
                      
            <div class="col-sm-4 col-12">
              <div class="form-group">
                <label for="tgl_akhir">Sampai Tanggal</label>
                <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control">
              </div>
            </div>

            <div class="col-sm-4 col-12" style="margin-top:25px;">
              <div class="btn-group mb-3 btn-group" role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-primary" style="font-size:14px;"><i class="bi bi-search"></i> Filter</button>
                <a href="/aspirasi" type="button" class="btn btn-light-secondary" style="font-size:14px;"><i class="bi bi-arrow-repeat"></i> Refresh</a>
                @if(auth('pegawai')->user()->level == "Admin")
                  @if($dataaspirasi ?? '')
                  <a href="{{ route('laporan_aspirasipdf', ['tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir ]) }}" 
                    target="_blank" class="btn btn-primary" style="font-size:14px;"><i class="fa fa-print fa-3px"></i> Print</a>
                  @endif
                  @endif
              </div>
            </div>
          </div>
        </form>

          <p class="text-muted font-bold mb-0">Total Data Aspirasi: {{ $totalaspirasi}} </p>
    
      </div>    
    </div> 
  </div>
</section>


<section class="section">
  <div class="card">
    <div class="row" id="table-responsive">
      <div class="col-12">
        <div class="card-header">
          <h6>Data Aspirasi Pemohon</h6>
        </div>
        

        <div class="card-body">
          <!-- NOTIFIKASI BERHASIL UPDATE -->
          @if (session('status'))
            <div class="alert alert-success alert-dismissible show fade">
              <i class="bi bi-check-circle"></i>
              {{ session('status') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          @endif

     
          <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered">
              <thead>
                <tr style="text-align:center;">
                  <th>No.</th>
                  <th>Judul Aspirasi</th>
                  <th>Deskripsi</th>
                  <!-- <th>Nama Pemohon</th> -->
                  <th>Tanggal<br>Aspirasi</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
        
              <tbody>
              @foreach( $dataaspirasi as $semuaaspirasi )
                <tr>
                  <td scope="row" style="text-align:center;"width="35px">{{ ($dataaspirasi ->currentpage()-1) * $dataaspirasi ->perpage() + $loop->index + 1 }}.</td>
                  <td width="280px">{{ $semuaaspirasi->judul }}</td>
                  <td width="400px">{{ Str::limit( $semuaaspirasi->deskripsi, 80, '....') }}</td>
                  <!-- <td width="120px">{{ $semuaaspirasi->pemohon->nama }}</td> -->
                  <td style="text-align:center;" width="120px">{{ $semuaaspirasi->created_at->format('d M Y') }}</td>
                  <td style="text-align:center;" width="80px">
                    @if ( $semuaaspirasi->status == 'Aktif')
                      <span class="badge bg-success" style="font-size: 12px;">Aktif</span>

                      @else ($semuaaspirasi->status == 'Tidak Aktif')
                        <span class="badge bg-danger" style="font-size: 12px;">Tidak Aktif</span>    
                    @endif
                  </td>
                  <td style="text-align:center;" width="60px">  
                    <!-- Button MODAL -->
                    @if(auth('pegawai')->user()->level == "Admin")
                        <button type="button" class="btn btn-primary rounded-pill btn-sm" data-bs-toggle="modal"
                        data-bs-target="#detailaspirasi{{ $semuaaspirasi->id}}"><i class="bi bi-pencil-square"></i></button>
                    @else
                        <button type="button" class="btn btn-primary rounded-pill btn-sm" data-bs-toggle="modal"
                        data-bs-target="#detailaspirasi{{ $semuaaspirasi->id}}"><i class="bi bi-search"></i></button>
                    @endif
                  </td>


                  <!--scrolling content Modal -->
                  <div class="modal fade" id="detailaspirasi{{ $semuaaspirasi->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary">
                          <h5 class="modal-title white">Detail Aspirasi Pemohon</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              <i data-feather="x"></i>
                            </button>
                        </div>
                      
                  <!-- FORM EDIT STATUS -->
                    <div class="modal-body">
                      <form action="/aspirasi/{{ $semuaaspirasi->id }}" method="POST">
                      @csrf
                      @method('PUT')
                        <!--TAMPILKAN DATA ASPIRASI BERDASARKAN ID -->
                        <div class="form-group">
                          <label for="judul" style="color:#000;">Judul Aspirasi</label>
                            <input type="text" class="form-control-plaintext" id="judul" name="judul" value="{{ $semuaaspirasi->judul }}" readonly>
                        </div>
          
                        <div class="form-group">
                          <label for="deskripsi" style="color:#000;">Deskripsi</label>
                            <p type="text" id="deskripsi" name="deskripsi" readonly style="text-align:justify;">{{ $semuaaspirasi->deskripsi }}</p>
                        </div>
                        
                        <div class="form-group">
                          <label for="created_at" style="color:#000;">Tanggal Input Aspirasi</label>
                            <input type="text" class="form-control-plaintext" id="created_at" name="created_at" value="{{ $semuaaspirasi->created_at->format('d M Y') }}" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                <label for="pemohon_id" style="color:#000;">Nama Pemohon</label>
                                <input type="text" class="form-control-plaintext" id="pemohon_id" name="pemohon_id" value="{{ $semuaaspirasi->pemohon->nama }}" readonly>
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                <label for="pemohon_id" style="color:#000;">Username Pemohon</label>
                                <input type="text" class="form-control-plaintext" id="pemohon_id" name="pemohon_id" value="{{ $semuaaspirasi->pemohon->username }}" readonly>
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                <label for="updated_at" style="color:#000;">Update Status Terakhir</label>
                                <input type="text" class="form-control-plaintext" id="updated_at" name="updated_at" value="{{ $semuaaspirasi->updated_at->format('d M Y') }}" readonly>
                              </div>
                            </div>

                          @if(auth('pegawai')->user()->level == "Admin")
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                  <label for="status" style="color:#000;">Status</label>
                                  <select name="status" class="form-select @error('status') is-invalid @enderror">
                                      <option value="{{ $semuaaspirasi->status }}" selected>{{ $semuaaspirasi->status }}</option>
                                      <optgroup label="-- Pilih Status --">
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                      </optgroup>
                                  </select>
                              </div> 
                            </div>

                            @else
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                  <label for="status" style="color:#000;">Status</label>
                                  <input type="text" class="form-control-plaintext" id="status" name="status" value="{{ $semuaaspirasi->status }}" readonly>
                              </div> 
                            </div>
                          @endif
                        </div>

                        <!-- end tampil data -->
                        @if(auth('pegawai')->user()->level == "Admin")
                          <button type="submit" class="btn btn-success btn-sm" style="float:right;">Ubah Status</button>
                        @endif
                        </form>
                      </div>
                    </div>
                  </div>
                </div>                        
                </tr>

              @endforeach
              </tbody>
            </table>
      
      <!-- PAGINATION -->
      <div class="d-flex justify-content-end">
      
      {{ $dataaspirasi->appends(request()->input())->links() }}
      </div>

      </div>
    </div>
  </div>
</div>

    


  </div>
</section>
@endsection