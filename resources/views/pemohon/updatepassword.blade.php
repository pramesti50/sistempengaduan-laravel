@extends('layout.mainpemohon')
@section('title', 'Ubah Password Akun Pemohon | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Ubah Password Akun')
@section('content')

<section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">


                <div class="card-body">
                    <!-- notifikasi jika gagal -->
                    @if (session('statusgagal'))
                        <div class="alert alert-danger alert-dismissible show fade" role="alert">
                        {{ session('statusgagal') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif
                
                    <!-- notifikasi jika berhasil -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible show fade" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif


                        <form class="{{ route('updatePassword') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="username" id="username" name="username" class="form-control @error('username') is-invalid @enderror"disabled value="{{ Auth::guard('pemohon')->user()->username }}">
                                </div>
                            </div>
                        

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password Saat Ini</label>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Saat Ini" required>
                                    @error('password') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Baru" required>
                                @error('password') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="konfirmpass">Konfirmasi Password Baru</label>
                                <input type="password" id="konfirmpass" name="konfirmpass" class="form-control @error('konfirmpass') is-invalid @enderror" placeholder="Konfirmasi Password Baru" required>
                                @error('konfirmpass') 
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                            
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button class="btn btn-light me-1 mb-1 btn-sm"><a href="/pemohon/profile-pemohon" style="text-decoration:none;">Kembali</a></button><pre></pre>
                                <button type="submit" class="btn btn-primary me-1 mb-1 btn-sm">Ubah Password</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    </section>

@endsection