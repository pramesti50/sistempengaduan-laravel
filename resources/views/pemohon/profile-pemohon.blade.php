@extends('layout.mainpemohon')
@section('title', 'Profil Pemohon | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Profil Saya')
@section('content')

<!-- <section class="section">
<div class="card"> -->
    
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

                        <form class="{{ route('updatepemohon') }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                        @foreach ($semua as $pemohon)
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" value="{{ $pemohon->username }}" readonly>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $pemohon->email }}" placeholder="Email" required>
                                @error('email') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $pemohon->nama }}" placeholder="Nama Lengkap" required >
                                @error('nama') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nik">NIK KTP</label>
                                <input type="text" id="nik" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ $pemohon->nik }}" placeholder="Nomor NIK" required>
                                @error('nik') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group col-md-6">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <select name="jeniskelamin" class="form-select @error('jeniskelamin') is-invalid @enderror">
                                <option value="{{ $pemohon->jeniskelamin }}" selected>{{ $pemohon->jeniskelamin }}</option>
                                <optgroup label="-- Jenis Kelamin --">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </optgroup>
                            </select>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="telp">Telepon</label>
                                <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ $pemohon->telp }}" placeholder="Telepon" required>
                                @error('telp') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $pemohon->alamat }}" placeholder="Alamat" required>
                                @error('alamat') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button class="btn btn-warning me-1 mb-1 btn-sm"><a href="{{ url('/pemohon/updatepassword') }}" style="text-decoration:none; color:#fff;">Ubah Password</a>
                                </button><pre> </pre>
                                <button type="submit" class="btn btn-success me-1 mb-1 btn-sm">Simpan Perubahan</button>
                            </div>
                        </div>
                        </form>
                        
                </div>
            </div>
        </div>
    </div>
    </section>



    
                
<!-- 
</div>
</section> -->
            
@endsection