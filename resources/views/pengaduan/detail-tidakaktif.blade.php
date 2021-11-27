@extends('layout.main')
@section('title', 'Detail Pengaduan Tidak Aktif | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Detail Pengaduan Tidak Aktif')
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


        <div class="card">
            <div class="card-body">
            
                      <form action="/pengaduan/detail-tidakaktif/{{ $tdkaktif->id }}" method="POST">
                      @csrf
                      @method('PATCH')
                        <!--TAMPILKAN DATA PENGADUAN BERDASARKAN ID -->
                        <div class="row">
                        <div class="col-md-10 col-12">
                            <div class="form-group">
                            <label for="kategori" style="color:#000;">Kategori Pengaduan</label>
                                <p type="text" class="form-control-plaintext" id="kategori" name="kategori">{{ $tdkaktif->kategori }}</p>
                            </div>
                        </div>

                        <div class="col-md-2 col-12">
                            <p style="font-size:14px;">ID. Pengaduan: #{{ $tdkaktif->id }}</p>
                        </div>
                    </div>

                        <div class="form-group">
                          <label for="judul" style="color:#000;">Judul Pengaduan</label>
                            <p type="text" class="form-control-plaintext" id="judul" name="judul">{{ $tdkaktif->judul }}</p>
                        </div>
                        
                        <div class="form-group">
                          <label for="deskripsi" style="color:#000;">Deskripsi</label>
                          <p type="text" class="form-control-plaintext" id="deskripsi" name="deskripsi" style="text-align:justify;">{{ $tdkaktif->deskripsi }}</p>
                        </div>    
                        
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label for="tgl_pengaduan" style="color:#000;">Tanggal Pengaduan</label>
                            <input type="text" class="form-control-plaintext" id="tgl_pengaduan" name="tgl_pengaduan" 
                            onfocusin="(this.type='date')" onfocusout="(this.type='text')" readonly value="{{ \Carbon\Carbon::parse($tdkaktif->tgl_pengaduan)->format('d M Y') }}">
                        </div>

                        <div class="form-group col-md-6 col-12">
                          <label for="pemohon_id" style="color:#000;">Nama Pemohon</label>
                          <input type="text" class="form-control-plaintext" id="pemohon_id" name="pemohon_id" 
                          value="{{ $tdkaktif->pemohon->nama }}" readonly>
                        </div>
                    

                        <div class="form-group col-md-6 col-12">
                          <label for="tgl_verifikasi" style="color:#000;">Tanggal Verifikasi</label>
                          <input type="text" class="form-control-plaintext" id="tgl_verifikasi" name="tgl_verifikasi"
                           value="{{ \Carbon\Carbon::parse($tdkaktif->tgl_verifikasi)->format('d M Y') }}" readonly>
                        </div>

                        <div class="form-group col-md-6 col-12">
                          <label for="pemohon_id" style="color:#000;">Username Pemohon</label>
                          <input type="text" class="form-control-plaintext" id="pemohon_id" name="pemohon_id" 
                          value="{{ $tdkaktif->pemohon->username }}" readonly>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label for="pegawai_id" style="color:#000;">Diverifikasi oleh</label>
                          <p type="text" class="form-control-plaintext" id="pegawai_id" name="pegawai_id" 
                          value="">{{ $tdkaktif->pegawai['nama'] }} | <b>Username: {{ $tdkaktif->pegawai['username'] }}</b></p>
                        </div>

                        <div class="form-group col-md-6 col-12" style="float:right">
                          <label for="pegawai_id" style="color:#000;">Kategori Bidang</label>
                          <p type="text" class="form-control-plaintext" id="pegawai_id" name="pegawai_id" 
                          value="">{{ $tdkaktif->pegawai['namabidang'] }}</p>
                        </div>
                    </div>
     
                    @if(Auth::guard('pegawai')->user()->level == "Admin")
                    <div class="form-group col-md-6 col-12">
                            <label for="status" style="color:#000;">Status</label> <br>
                            <input type="text" class="badge bg-success" id="status" name="status" 
                              value="{{ $tdkaktif->status }}" readonly>
                            <!-- @if ( $tdkaktif->status == 'Selesai')
                                <span class="badge bg-success">Selesai</span>
                            @endif -->
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="{{ $tdkaktif->status }}">{{ $tdkaktif->status }}</option>
                                <optgroup label="-- Pilih Status --">
                                  <!-- <option value="Sedang diproses oleh Bidang Pengaduan & Pelaporan">Sedang diproses oleh Bidang Pengaduan & Pelaporan</option>
                                  <option value="Sedang diproses oleh Bidang Program & Informasi">Sedang diproses oleh Bidang Program & Informasi</option>
                                  <option value="Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan">Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan</option>
                                  <option value="Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan">Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan</option>
                                  <option value="Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi">Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi</option>
                                  <option value="Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal">Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal</option> -->
                                  <option value="Selesai">Selesai</option>
                                  <option value="Tidak Aktif">Tidak Aktif</option>
                                </optgroup>
                            </select>
                        </div>
                      


                        @else
                        <div class="form-group">
                            <label for="status" style="color:#000;">Status</label> <br>
                            <input type="text" class="badge bg-success" id="status" name="status" 
                              value="{{ $tdkaktif->status }}" readonly>
                              @if ( $tdkaktif->status == 'Selesai')
                                <span class="badge bg-success">Selesai</span>
                              @endif
                        </div>
                        @endif
                        <br>

                        <div class="form-group">
                          <label for="tanggapan" style="color:#000;">Tindak Lanjut</label>
                          <textarea class="form-control @error('tanggapan') is-invalid @enderror" id="tanggapan" 
                          name="tanggapan" placeholder="Tuliskan tanggapan Verifikator" rows="8">{{ $tdkaktif->tanggapan }}</textarea>
                        </div>
                        <!-- end tampil data -->

                        
                        <div class="col-12 d-flex justify-content-end mt-2">
                            <a href="{{ url('pengaduan/tidak-aktif') }}" class="btn btn-dark btn-sm me-1 mb-1">Kembali</a>
                            <button type="submit" class="btn btn-success btn-sm me-1 mb-1">Simpan Perubahan</button>
                        </div>
                        </form>
                      </div>

                    </div>
                  </div>
              </div>


              
        </div>
    </div>
</div>


</section>
@endsection