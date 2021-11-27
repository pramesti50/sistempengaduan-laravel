@extends('layout.main')
@section('title', 'Detail Sedang Diproses | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Detail Pengaduan Sedang Diproses')
@section('content')



<section class="section">


<!-- NOTIFIKASI BERHASIL UPDATE -->
@if (session('status'))
      <div class="alert alert-success alert-dismissible show fade">
        <i class="bi bi-check-circle"></i>
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
     @endif

     
<!-- TAMPILAN DATA PENGADUAN SEDANG DIPROSES -->

<div class="card">
    
          <div class="card-body">
                      <form action="/pengaduan/detail-sedang-diproses/{{ $sedangproses->id }}" method="POST">
                      @csrf
                      @method('PATCH')
                        <!--TAMPILKAN DATA PENGADUAN BERDASARKAN ID -->
                    <div class="row">
                        <div class="col-md-10 col-12">
                            <div class="form-group">
                            <label for="kategori" style="color:#000;">Kategori Pengaduan</label>
                                <p type="text" class="form-control-plaintext" id="kategori" name="kategori">{{ $sedangproses->kategori }}</p>
                            </div>
                        </div>

                        <div class="col-md-2 col-12">
                            <p style="font-size:14px;">ID. Pengaduan: #{{ $sedangproses->id }}</p>
                        </div>
                    </div>

                        <div class="form-group">
                          <label for="judul" style="color:#000;">Judul Pengaduan</label>
                            <p type="text" class="form-control-plaintext" id="judul" name="judul">{{ $sedangproses->judul }}</p>
                        </div>
                        
                        <div class="form-group">
                          <label for="deskripsi" style="color:#000;">Deskripsi</label>
                          <p type="text" class="form-control-plaintext" id="deskripsi" name="deskripsi" style="text-align:justify;">{{ $sedangproses->deskripsi }}</p>
                        </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label for="tgl_pengaduan" style="color:#000;">Tanggal Pengaduan</label>
                            <input type="text" class="form-control-plaintext" id="tgl_pengaduan" name="tgl_pengaduan" 
                            onfocusin="(this.type='date')" onfocusout="(this.type='text')" readonly disabled value="{{ \Carbon\Carbon::parse($sedangproses->tgl_pengaduan)->format('d M Y') }}">
                        </div>

                        <div class="form-group col-md-6 col-12">
                          <label for="pemohon_id" style="color:#000;">Nama Pemohon</label>
                          <input type="text" class="form-control-plaintext" id="pemohon_id" name="pemohon_id" 
                          value="{{ $sedangproses->pemohon->nama }}" readonly disabled>
                        </div>
                    

                        <div class="form-group col-md-6 col-12">
                          <label for="tgl_verifikasi" style="color:#000;">Tanggal Verifikasi Pengaduan</label>
                          <input type="date" class="form-control" id="tgl_verifikasi" name="tgl_verifikasi"
                          value="{{ $sedangproses->tgl_verifikasi }}" required>
                        </div>

                        <div class="form-group col-md-6 col-12">
                          <label for="pemohon_id" style="color:#000;">Username Pemohon</label>
                          <input type="text" class="form-control-plaintext" id="pemohon_id" name="pemohon_id" 
                          value="{{ $sedangproses->pemohon->username }}" readonly disabled>
                        </div>
                    </div>

                        

                        <div class="form-group">
                          <label for="tanggapan" style="color:#000;">Tindak Lanjut</label>
                          <textarea class="form-control  @error('tanggapan') is-invalid @enderror" id="tanggapan" 
                              name="tanggapan" placeholder="Tuliskan tanggapan tindak lanjut" rows="8" required>{{ old('tanggapan') }}</textarea>
                          @error('tanggapan') 
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" style="color:#000;">Status</label>
                            <select name="status" class="choices form-select @error('status') is-invalid @enderror" required>
                                <option value="{{ $sedangproses->status }}" selected>{{ $sedangproses->status }}</option>
                                <optgroup label="-- Pilih Status --">
                                  <option value="Sedang diproses oleh Bidang Pengaduan & Pelaporan">Sedang diproses oleh Bidang Pengaduan & Pelaporan</option>
                                  <option value="Sedang diproses oleh Bidang Program & Informasi">Sedang diproses oleh Bidang Program & Informasi</option>
                                  <option value="Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan">Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</option>
                                  <option value="Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan">Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan</option>
                                  <option value="Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi">Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi</option>
                                  <option value="Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal">Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal</option>
                                  <option value="Selesai">Selesai</option>
                                </optgroup>
                            </select>
                        </div> 
                        <!-- end tampil data -->

                        
                        <div class="col-12 d-flex justify-content-end mt-5">
                            <a href="{{ url('pengaduan/sedang-diproses') }}" type="button" class="btn btn-dark btn-sm me-1 mb-1">Kembali</a><pre> </pre>
                            <button type="submit" class="btn btn-success btn-sm me-1 mb-1"><i class="bi bi-check2-circle"></i> Verifikasi</button>
                        </div>
                        </form>
                      

                    </div>
                  </div>
              </div>
</div>



</section>



@endsection