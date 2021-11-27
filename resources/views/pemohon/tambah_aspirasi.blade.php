@extends('layout.mainpemohon')
@section('title', 'Aspirasi Pemohon | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Aspirasi Pemohon')
@section('content')
    <section class="section">
    <div class="card">
        <div class="card-header">
            
            <p class="text-subtitle text-muted">Sampaikan aspirasi Anda yang dapat berupa saran, harapan, dan kritik yang membangun untuk kami</p>
        </div>
        
        <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible show fade">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        
        <form action="{{ route('tambahAspirasi') }}" method="post">
        @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="judul">Judul Aspirasi</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Masukkan Judul Aspirasi Anda" value="{{ old('judul') }}" required>
                        @error('judul') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" rows="5" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi Aspirasi Anda" value="{{ old('deskripsi') }}" required></textarea>
                        @error('deskripsi') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>     
                </div>
                
                <div class="col-12 d-flex justify-content-end mt-3">
                    <button type="reset" class="btn btn-secondary me-1 mb-1 btn-sm">Reset</button>
                    <button type="submit" class="btn btn-success me-1 mb-1 btn-sm">Submit</button>
                </div>                
        </form>
         
        </div>

    </div>
    </section>
            
@endsection