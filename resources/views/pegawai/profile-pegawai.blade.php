@extends('layout.main')
@section('title', 'Profil Pegawai | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Profil Saya')
@section('content')

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <!-- <h4 class="card-title mt-3" style="margin-left: 25px;">Profil Saya</h4> -->

                    <div class="card-body">
                    <!-- NOTIFIKASI BERHASIL UPDATE -->
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

                        <form class="{{ route('editprofilepegawai') }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                        @foreach ($datapegawai as $profilpegawai)
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" value="{{ $profilpegawai->username }}" readonly>
                                </div>
                            </div>
                        
                        @if (auth('pegawai')->user()->level == "Admin")
                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="namabidang">Kategori Bidang</label>
                                <select name="namabidang" class="form-select @error('namabidang') is-invalid @enderror" required>
                                <option value="{{ $profilpegawai->namabidang }}" selected>{{ $profilpegawai->namabidang }}</option>
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
                            </div>
                        @else
                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="namabidang">Kategori Bidang</label>
                                <input type="text" id="namabidang" name="namabidang" class="form-control @error('namabidang') is-invalid @enderror" value="{{ $profilpegawai->namabidang }}" placeholder="Namabidang" readonly>
                            </div>
                            </div>
                        @endif


                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $profilpegawai->nama }}" placeholder="Nama Lengkap" required >
                                @error('nama') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $profilpegawai->email }}" placeholder="Email">
                                @error('email') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ $profilpegawai->nip }}" placeholder="NIP" required >
                                @error('nip') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="telp">No. Telepon</label>
                                <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ $profilpegawai->telp }}" placeholder="Telepon" required>
                                @error('telp') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <select name="jeniskelamin" class="form-select @error('jeniskelamin') is-invalid @enderror">
                                <option value="{{ $profilpegawai->jeniskelamin }}" selected>{{ $profilpegawai->jeniskelamin }}</option>
                                <optgroup label="-- Jenis Kelamin --">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </optgroup>
                            </select>
                            </div>

                            <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $profilpegawai->alamat }}" placeholder="Alamat" required>
                                @error('alamat') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>
                    @endforeach

                            <div class="col-12 d-flex justify-content-end">
                                <a type="button" class="btn btn-warning btn-sm" href="/pegawai/ubahpassword">Ubah Password</a><pre> </pre>
                                <button type="submit" class="btn btn-success btn-sm">Simpan Perubahan</button>
                            </div>
                        </div>
                        </form>
 
                </div>
            </div>
        </div>
    </div>
    </section>

            
@endsection