@extends('layout.main')
@section('title', 'Data Verifikator | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Data Verifikator')
@section('content')


<section class="section">
  <div class="card">
  <div class="row" id="table-responsive">
    <div class="col-12">
    <div class="card-header col-md-12">
      <h6 class="text-muted font-extrabold mb-0">Jumlah Akun Verifikator : {{ $jmlhVerifikator }}</h6>
      

      <!-- CARI NAMA VERIFIKATOR -->
      
      <form action="{{ route('carinamaverifikator') }}" method="GET">
        <div class="col-sm-6 col-12" style="float:right;">
          <div class="input-group">
              <input type="text" class="form-control" id="cariverifikator" name="cariverifikator" placeholder="Cari Username" value="{{ old('cariverifikator') }}" autocomplete="off"
                aria-describedby="button-addon2">
              <a class="btn btn-primary" type="button"  href="/pegawai/data-verifikator" id="button-addon2"><i class="bi bi-arrow-repeat"></i></a>
              <a class="btn btn-outline-primary bg-light text-primary" type="button"  href="/pegawai/tambah-verifikator">Tambah Akun</a>
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

    @if (session('statusgagal'))
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
            <th>Kategori Bidang</th>
            <th>Nama Lengkap</th>
            <th>Level User</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        @foreach( $dataverifikator as $semuaverifikator )
          <tr>
            <td scope="row" style="text-align:center;"width="50px">{{ ($dataverifikator ->currentpage()-1) * $dataverifikator ->perpage() + $loop->index + 1 }}.</td>
            <td width="100px">{{$semuaverifikator->username }}</td>
            <td width="250px">{{$semuaverifikator->namabidang }}</td>
            <td width="250px">{{$semuaverifikator->nama }}</td>
            <td width="100px">{{$semuaverifikator->level }}</td>
            <td style="text-align:center;" width="100px">
              @if ($semuaverifikator->status == 'Aktif')
                <span class="badge bg-success" style="font-size: 12px;">Aktif</span>

                @else ($semuaverifikator->status == 'Tidak Aktif')
                  <span class="badge bg-danger" style="font-size: 12px;">Tidak Aktif</span>    
              @endif
            </td>
            <td style="text-align:center;" width="100px">  
              <!-- Button MODAL DETAIL -->
              <button type="button" class="btn btn-primary rounded-pill btn-sm" data-bs-toggle="modal"
                data-bs-target="#detailverifikator{{$semuaverifikator->id}}"><i class="bi bi-pencil-square"></i>
              </button> | 
              <!-- Button MODAL UPDATE PASSWORD -->
              <button type="button" class="btn btn-warning rounded-pill btn-sm" data-bs-toggle="modal"
                data-bs-target="#resetpassVerifikator{{$semuaverifikator->id}}"><i class="bi bi-lock-fill"></i>
              </button>
            </td>

            <!--scrolling content Modal DETAIL -->
            <div class="modal fade" id="detailverifikator{{ $semuaverifikator->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header bg-primary">
                        <h5 class="modal-title white">Detail Data Akun Verifikator</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          <i data-feather="x"></i>
                          </button>
                      </div>
                      
        <!-- FORM EDIT DETAIL PEMOHON oleh Admin -->
                    <div class="modal-body">
                      <form action="/pegawai/data-verifikator/{{ $semuaverifikator->id }}" method="POST">
                      @csrf
                      @method('PUT')
                        <!--TAMPILKAN DATA PEGAWAI -->
                        <div class="row">
                        
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              <label for="username" style="color:#000;">Username</label>
                              <input type="text" id="username" name="username" class="form-control-plaintext" value="{{ $semuaverifikator->username }}" disabled>
                            </div>
                          </div>
                        

                          <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email" style="color:#000;">Email</label>
                                <input type="email" id="email" name="email" class="form-control-plaintext @error('email') is-invalid @enderror" value="{{ $semuaverifikator->email }}" placeholder="Email" disabled>
                                @error('email') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                          </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nama" style="color:#000;">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control-plaintext @error('nama') is-invalid @enderror" value="{{ $semuaverifikator->nama }}" placeholder="Nama Lengkap" disabled>
                                @error('nama') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="jeniskelamin" style="color:#000;">Jenis Kelamin</label>
                            <input type="text" id="jeniskelamin" name="jeniskelamin" class="form-control-plaintext @error('jeniskelamin') is-invalid @enderror" value="{{ $semuaverifikator->jeniskelamin }}" disabled>
                            <!-- <select name="jeniskelamin" class="form-select @error('jeniskelamin') is-invalid @enderror">
                                <option value="{{ $semuaverifikator->jeniskelamin }}" selected disabled>{{ $semuaverifikator->jeniskelamin }}</option>
                                <optgroup label="-- Jenis Kelamin --">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </optgroup>
                            </select> -->
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="telp" style="color:#000;">Telepon</label>
                                <input type="text" id="telp" name="telp" class="form-control-plaintext @error('telp') is-invalid @enderror" value="{{ $semuaverifikator->telp }}" placeholder="Telepon" disabled>
                                @error('telp') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="created_at" style="color:#000;">Registrasi Akun</label>
                                <input type="text" id="created_at" name="created_at" class="form-control-plaintext" value="{{ $semuaverifikator->created_at->format('d M Y') }}" disabled>
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="alamat" style="color:#000;">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control-plaintext @error('alamat') is-invalid @enderror" value="{{ $semuaverifikator->alamat }}" placeholder="Alamat" disabled>
                                @error('alamat') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                    <hr class="mt-2">

                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                  <label for="updated_at" style="color:#000;">Pengubahan Terakhir</label>
                                  <input type="text" id="updated_at" name="updated_at" class="form-control-plaintext" value="{{ $semuaverifikator->updated_at->format('d M Y') }}" disabled>
                              </div>
                            </div>
                            
                            <div class="form-group col-md-6">
                            <label for="namabidang" style="color:#000;">Kategori Bidang</label>
                            <select name="namabidang" class="form-select @error('namabidang') is-invalid @enderror" style="font-size:14px;" required>
                                <option value="{{ $semuaverifikator->namabidang }}" selected>{{ $semuaverifikator->namabidang }}</option>
                                <optgroup label="--Pilih Kategori Bidang--">
                                    <option value="Bidang Pengaduan & Pelaporan">Bidang Pengaduan & Pelaporan</option>
                                    <option value="Bidang Program & Informasi">Bidang Program & Informasi</option>
                                    <option value="Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan">Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</option>
                                    <option value="Bidang Perizinan Pemerintahan & Pembangunan">Bidang Perizinan Pemerintahan & Pembangunan</option>
                                    <option value="Bidang Pelayanan Perizinan Ekonomi">Bidang Pelayanan Perizinan Ekonomi</option>
                                    <option value="Bidang Pelaksanaan Penanaman Modal">Bidang Pelaksanaan Penanaman Modal</option>
                                </optgroup>
                            </select>
                            </div>                           

                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                <label for="status" style="color:#000;">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="{{ $semuaverifikator->status }}" selected required>{{ $semuaverifikator->status }}</option>
                                    <optgroup label="-- Pilih Status --">
                                      <option value="Aktif">Aktif</option>
                                      <option value="Tidak Aktif">Tidak Aktif</option>
                                    </optgroup>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                <label for="level" style="color:#000;">Level User</label>
                                <select name="level" class="form-select @error('level') is-invalid @enderror">
                                    <option value="{{ $semuaverifikator->level }}" selected>{{ $semuaverifikator->level }}</option>
                                    <optgroup label="-- Level User --">
                                      <option value="Verifikator">Verifikator</option>
                                      <option value="Admin">Admin</option>
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
          <div class="modal fade" id="resetpassVerifikator{{ $semuaverifikator->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header bg-warning">
                        <h5 class="modal-title">Ubah Password Akun Verifikator</h5>
                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          <i data-feather="x"></i>
                          </button>
                      </div>

                  <!-- FORM EDIT DETAIL verifikator oleh Admin -->
                  <div class="modal-body">
                      <form action="/pegawai/data-verifikator/{{ $semuaverifikator->id }}" method="POST">
                      @csrf
                      @method('PATCH')
                        <!--TAMPILKAN DATA verifikator -->
                        <div class="col-md-12 col-12">
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ $semuaverifikator->username }}" readonly>
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
                                <label for="konfirmpasspegawai">Konfirmasi Password</label>
                                <input type="password" id="konfirmpasspegawai" name="konfirmpasspegawai" class="form-control @error('konfirmpasspegawai') is-invalid @enderror" placeholder="Terdiri 5-10 karakter" required>
                                @error('konfirmpasspegawai') 
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
            {{ $dataverifikator->appends(['cariverifikator' => request()->cariverifikator])->links() }}
      </div>

      </div>
    </div>
    </div>
</div>


    


  </div>
</section>
@endsection