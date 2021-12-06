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
                  <th>Detail</th>
                </tr>
              </thead>

              <tbody>
                @foreach( $dataaspirasi as $riwayataspirasi )
                <tr>
                  <td scope="row" style="text-align:center;" width="40px">{{ ($dataaspirasi->currentpage()-1) * $dataaspirasi ->perpage() + $loop->index + 1 }}.</td>
                  <td width="200px">{{ Str::limit( $riwayataspirasi->judul, 80, '....') }}</td>
                  <td width="300px">{{ Str::limit( $riwayataspirasi->deskripsi, 97, '....')}}</td>
                  <td style="text-align:center;" width="100px">{{ $riwayataspirasi->created_at->format('d M Y') }}</td>
                  <td style="text-align:center;" width="30px">
                    <button type="button" class="btn btn-primary rounded-pill btn-sm" data-bs-toggle="modal"
                      data-bs-target="#detailaspirasi{{ $riwayataspirasi->id}}"><i class="bi bi-search"></i>
                    </button>
                  </td>
                    <!--scrolling content Modal -->
                      <div class="modal fade" id="detailaspirasi{{ $riwayataspirasi->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-light-primary">
                              <h5 class="modal-title primary">Detail Aspirasi</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  <i data-feather="x"></i>
                                </button>
                            </div>
                                    
                            <!-- FORM EDIT STATUS -->
                            <div class="modal-body">
                              <!--TAMPILKAN DATA PENGADUAN BERDASARKAN ID -->
                                <div class="form-group">
                                  <label for="judul" style="color:#000;">Judul Aspirasi</label>
                                    <p type="text" class="form-control-plaintext" id="judul" name="judul">{{ $riwayataspirasi->judul }}</p>
                                </div>
            
                                <div class="form-group">
                                  <label for="deskripsi" style="color:#000;">Deskripsi Aspirasi</label>
                                    <p type="text" class="form-control-plaintext" id="deskripsi" name="deskripsi" style="text-align:justify;">{{ $riwayataspirasi->deskripsi }}</p>
                                </div>
                                                            
                                <div class="form-group">
                                  <label for="created_at" style="color:#000;">Tanggal Aspirasi</label>
                                    <p type="text" class="form-control-plaintext" id="created_at" name="created_at">{{ $riwayataspirasi->created_at->format('d M Y') }}</p>
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

            <!-- PAGINATION -->
            <div class="d-flex justify-content-end">
                {{ $dataaspirasi->links() }}
            </div>

        </div>
    </div>
</section>
@endsection