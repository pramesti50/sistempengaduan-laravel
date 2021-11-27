@extends('layout.main')
@section('title', 'Tambah Akun Pegawai | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Tambah Akun Pegawai')
@section('content')

<section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <!-- <h6 class="mt-3" style="margin-left: 25px;">Formulir Registrasi Akun Pegawai</h6> -->

                    <div class="card-body">
                    <!-- NOTIFIKASI -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible show fade">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif

                        <form class="{{ route('tambahverifikator') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama lengkap" required>
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
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email harus aktif dan benar" required>
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
                                    <input type="text" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" placeholder="Nomor Identitas Pegawai" required>
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
                                    <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp') }}" placeholder="Nomor Telp. harus aktif dan benar" required>
                                    @error('telp') 
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="jeniskelamin">Jenis Kelamin</label>
                                <select name="jeniskelamin" class="form-select" required>
                                    <option value="">--Jenis Kelamin--</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="level">Level User</label>
                                <select name="level" class="form-select" required>
                                    <option value="">--Level User--</option>
                                    <option value="Verifikator">Verifikator</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            </div>

                        
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="namabidang">Kategori Bidang</label>
                                    <select name="namabidang" class="form-select" required>
                                    <option value="">--Pilih Kategori Bidang--</option>
                                    <option value="Bidang Pengaduan & Pelaporan">Bidang Pengaduan & Pelaporan</option>
                                    <option value="Bidang Program & Informasi">Bidang Program & Informasi</option>
                                    <option value="Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan">Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</option>
                                    <option value="Bidang Perizinan Pemerintahan & Pembangunan">Bidang Perizinan Pemerintahan & Pembangunan</option>
                                    <option value="Bidang Pelayanan Perizinan Ekonomi">Bidang Pelayanan Perizinan Ekonomi</option>
                                    <option value="Bidang Pelaksanaan Penanaman Modal">Bidang Pelaksanaan Penanaman Modal</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
                                @error('username') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password terdiri 5-10 karakter" value="{{ old('password') }}" required>
                                @error('password') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <label for="konfirmpasspegawai">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('konfirmpasspegawai') is-invalid @enderror" id="konfirmpasspegawai" name="konfirmpasspegawai" placeholder="Password terdiri 5-10 karakter" value="{{ old('konfirmpasspegawai') }}" required>
                                @error('konfirmpasspegawai') 
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" placeholder="Alamat lengkap" required>
                                @error('alamat') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="reset" class="btn btn-secondary me-1 mb-1">Reset</button>
                                <button type="submit" class="btn btn-success me-1 mb-1">Daftar</button>
                            </div>
                        
                        </form>
                        
                </div>
            </div>
        </div>
    </div>
    </section>

@endsection