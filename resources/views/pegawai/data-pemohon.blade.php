@extends('layout.main')
@section('title', 'Data Pemohon | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Data Pemohon')
@section('content')


<section class="section">
  <div class="card">
  <div class="row" id="table-responsive">
    <div class="col-12">
    <div class="card-header">
      <h6 class="text-muted font-extrabold mb-0">Jumlah Akun Pemohon : {{ $jmlhPemohon }}</h6>
      
      <!-- CARI NAMA VERIFIKATOR -->
      
      <form action="{{ route('cariusernamepemohon') }}" method="GET">
        <div class="col-sm-6 col-12" style="float:right;">
          <div class="input-group">
              <input type="text" class="form-control" id="caripemohon" name="caripemohon" placeholder="Cari Username Pemohon" value="{{ old('caripemohon') }}" autocomplete="off"
                aria-describedby="button-addon2">
              <a class="btn btn-primary" type="button"  href="/pegawai/data-pemohon" id="button-addon2"><i class="bi bi-arrow-repeat"></i></a>
          </div>
        </div>
      </form>
    </div>
    </div>

    <div class="card-body">
    <!-- NOTIFIKASI berhasil update-->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible show fade">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    @if(session('statusgagal'))
    <div class="alert alert-danger alert-dismissible show fade">
          {{ session('statusgagal') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif


      <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr style="text-align:center;">
            <th>No.</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        @foreach( $datapemohon as $semuapemohon )
          <tr>
            <td scope="row" style="text-align:center;"width="80px">{{ ($datapemohon ->currentpage()-1) * $datapemohon ->perpage() + $loop->index + 1 }}.</td>
            <td width="200px">{{ $semuapemohon->username }}</td>
            <td width="200px">{{ $semuapemohon->email }}</td>
            <td width="220px">{{ $semuapemohon->nama }}</td>
            <td style="text-align:center;" width="100px">
              @if ( $semuapemohon->status == 'Aktif')
                <span class="badge bg-success" style="font-size: 12px;">Aktif</span>

                @else ($semuapemohon->status == 'Tidak Aktif')
                  <span class="badge bg-danger" style="font-size: 12px;">Tidak Aktif</span>    
              @endif
            </td>
            <td style="text-align:center;">  
              <!-- Button MODAL DETAIL -->
              <button type="button" class="btn btn-primary rounded-pill btn-sm" data-bs-toggle="modal"
                data-bs-target="#detailpemohon{{ $semuapemohon->id}}"><i class="bi bi-pencil-square"></i>
              </button> | 
              <!-- Button MODAL UPDATE PASSWORD -->
              <button type="button" class="btn btn-warning rounded-pill btn-sm" data-bs-toggle="modal"
                data-bs-target="#resetpass{{ $semuapemohon->id}}"><i class="bi bi-lock-fill"></i>
              </button>
            </td>

            <!--scrolling content Modal DETAIL -->
            <div class="modal fade" id="detailpemohon{{ $semuapemohon->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header bg-primary">
                        <h5 class="modal-title white">Detail Data Akun Pemohon</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          <i data-feather="x"></i>
                          </button>
                      </div>
                      
        <!-- FORM EDIT DETAIL PEMOHON oleh Admin -->
                    <div class="modal-body">
                      <form action="/pegawai/data-pemohon/{{ $semuapemohon->id }}" method="POST">
                      @csrf
                      @method('PATCH')
                        <!--TAMPILKAN DATA PEMOHON -->
                        <div class="row">
                        
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              <label for="username" style="color:#000;">Username</label>
                              <input type="text" id="username" name="username" class="form-control-plaintext" value="{{ $semuapemohon->username }}" disabled readonly>
                            </div>
                          </div>
                        

                          <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email" style="color:#000;">Email</label>
                                <input type="email" id="email" name="email" class="form-control-plaintext @error('email') is-invalid @enderror" value="{{ $semuapemohon->email }}" placeholder="Email" disabled readonly>
                            </div>
                          </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nama" style="color:#000;">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control-plaintext @error('nama') is-invalid @enderror" value="{{ $semuapemohon->nama }}" placeholder="Nama Lengkap" disabled>
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nik" style="color:#000;">NIK KTP</label>
                                <input type="text" id="nik" name="nik" class="form-control-plaintext @error('nik') is-invalid @enderror" value="{{ $semuapemohon->nik }}" placeholder="Nomor NIK" disabled>
                            </div>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="jeniskelamin" style="color:#000;">Jenis Kelamin</label>
                            <input type="text" id="jeniskelamin" name="jeniskelamin" class="form-control-plaintext @error('jeniskelamin') is-invalid @enderror" value="{{ $semuapemohon->jeniskelamin }}" disabled>
                            <!-- <select name="jeniskelamin" class="form-control-plaintext @error('jeniskelamin') is-invalid @enderror" readonly>
                                <option value="{{ $semuapemohon->jeniskelamin }}" selected>{{ $semuapemohon->jeniskelamin }}</option>
                                <optgroup label="-- Jenis Kelamin --">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </optgroup>
                            </select> -->
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="telp" style="color:#000;">Telepon</label>
                                <input type="text" id="telp" name="telp" class="form-control-plaintext @error('telp') is-invalid @enderror" value="{{ $semuapemohon->telp }}" placeholder="Telepon" disabled>
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="alamat" style="color:#000;">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control-plaintext @error('alamat') is-invalid @enderror" value="{{ $semuapemohon->alamat }}" placeholder="Alamat" disabled>
                            </div>
                            </div>

                            <hr class="mt-2">

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="created_at" style="color:#000;">Registrasi Akun</label>
                                <input type="text" id="created_at" name="created_at" class="form-control-plaintext" value="{{ $semuapemohon->created_at->format('d M Y') }}" disabled>
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="updated_at" style="color:#000;">Pengubahan Terakhir</label>
                                <input type="text" id="updated_at" name="updated_at" class="form-control-plaintext" value="{{ $semuapemohon->updated_at->format('d M Y') }}" disabled>
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                <label for="status" style="color:#000;">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="{{ $semuapemohon->status }}" selected>{{ $semuapemohon->status }}</option>
                                    <optgroup label="-- Pilih Status --">
                                      <option value="Aktif">Aktif</option>
                                      <option value="Tidak Aktif">Tidak Aktif</option>
                                    </optgroup>
                                </select>
                              </div>
                            </div>
                        <!-- end tampil data -->
                        </div>
                        <button type="submit" class="btn btn-success btn-sm" style="float:right;">Simpan</button>
                        </form>

                    </div>
                    </div>
                  </div>
              </div>
          <!-- END MODAL DETAIL -->

   <!-- MODAL EDIT PASSWORD -->
          <div class="modal fade" id="resetpass{{ $semuapemohon->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header bg-warning">
                        <h5 class="modal-title">Ubah Password Akun Pemohon</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          <i data-feather="x"></i>
                          </button>
                      </div>

                  <!-- FORM EDIT DETAIL PEMOHON oleh Admin -->
                  <div class="modal-body">
                      <form action="/pegawai/data-pemohon/{{ $semuapemohon->id }}" method="POST">
                      @csrf
                      @method('PUT')
                        <!--TAMPILKAN DATA PEMOHON -->
                        <div class="col-md-12 col-12">
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ $semuapemohon->username }}" readonly>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Terdiri 5-10 karakter" required>
                                @error('password') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="konfirmpass">Konfirmasi Password</label>
                                <input type="password" id="konfirmpass" name="konfirmpass" class="form-control @error('konfirmpass') is-invalid @enderror" placeholder="Terdiri 5-10 karakter" required>
                                @error('konfirmpass') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>
                        <!-- end tampil data -->
                        </div>
                        <button type="submit" class="btn btn-success btn-sm" style="float:right;">Simpan</button>
                        </form>

                    </div>
                    </div>
                  </div>
              </div>
          <!-- END MODAL Ubah Password-->
          </tr>
        @endforeach
        </tbody>
      </table>

      <!-- PAGINATION -->
      <div class="d-flex justify-content-end">
            <!-- {{ $datapemohon->onEachSide(3)->links() }} -->
            {{ $datapemohon->appends(['caripemohon' => request()->caripemohon])->links() }}
            
      </div>

      </div>
    </div>
    </div>
</div>


    


  </div>
</section>
@endsection