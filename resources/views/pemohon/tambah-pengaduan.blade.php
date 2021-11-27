@extends('layout.mainpemohon')
@section('title', 'Buat Pengaduan Pemohon | Sistem Pengaduan DPMPTSP Kabupaten BADUNG')
@section('header', 'Buat Pengaduan Baru')
@section('content')
    <section class="section">
    <div class="card">
        <div class="card-header">
            <p class="text-subtitle text-muted">Silahkan buat laporan pengaduan Anda</p>
        </div>
         
        <div class="card-body">
        <form action="{{ route('tambahpengaduan') }}" method="POST">
        @csrf

                <div class="col-md-5 col-12">
                    <div class="form-group">
                        <label for="tgl_pengaduan">Tanggal Pengaduan</label>
                        <input type="date" class="form-control" id="tgl_pengaduan" name="tgl_pengaduan" value="{{ old('tgl_pengaduan') }}" required>
                        @error('tgl_pengaduan') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="judul">Judul Pengaduan</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul/Ringkasan Pengaduan" value="{{ old('judul') }}" required>
                        @error('judul') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori Pengaduan</label>
                        <select name="kategori" class="form-select" required>
                        <div class="modal-dialog modal-dialog-scrollable">
                            
                            <option label="--Pilih Kategori Pengaduan--"></option>
                                <option value="Umum">Umum</option>
                            <optgroup label="Jenis Perizinan">
                                <option value="Izin Mendirikan Bangunan (IMB)">Izin Mendirikan Bangunan (IMB)</option>
                                <option value="Izin Usaha Jasa Kontruksi (IUJK)">Izin Usaha Jasa Kontruksi (IUJK)</option>
                                <option value="Izin Penyimpanan Sementara Limbah Bahan Berbahaya Beracun (B3)">Izin Penyimpanan Sementara Limbah Bahan Berbahaya Beracun (B3)</option>
                                <option value="Izin Pembuangan/Pemanfaatan Air Limbah ke Sumber Air/ Tanah">Izin Pembuangan/Pemanfaatan Air Limbah ke Sumber Air/ Tanah</option>
                                <option value="Izin Penempatan Base Transceiver Station (BTS)">Izin Penempatan Base Transceiver Station (BTS)</option>
                                <option value="Izin Pengelolaan Rumah Kos">Izin Pengelolaan Rumah Kos</option>
                                <option value="Izin Penyelenggaraan Angkutan Umum Dalam/Tidak Dalam Trayek">Izin Penyelenggaraan Angkutan Umum Dalam/Tidak Dalam Trayek</option>
                                <option value="Izin Usaha Warnet, Warsel, Perfilman, dan Telekomunikasi">Izin Usaha Warnet, Warsel, Perfilman, dan Telekomunikasi</option>
                                <option value="Izin Pelayanan Medik Dasar (Klinik)">Izin Pelayanan Medik Dasar (Klinik)</option>
                                <option value="Izin Pelayanan Medik Spesialis (Rumah Sakit)">Izin Pelayanan Medik Spesialis (Rumah Sakit)</option>
                                <option value="Izin Pelayanan Medik Penunjang (Laboratorium)">Izin Pelayanan Medik Penunjang (Laboratorium)</option>
                                <option value="Izin Penempatan Jaringan Utilitas">Izin Penempatan Jaringan Utilitas</option>
                                <option value="Izin Reklame Insidentil / Non Insidentil">Izin Reklame Insidentil / Non Insidentil</option>
                                <option value="Izin Usaha Mikro Obat Tradisional (UMOT)">Izin Usaha Mikro Obat Tradisional (UMOT)</option>
                                <option value="Izin Toko Obat">Izin Toko Obat</option>
                                <option value="Izin Optikal">Izin Optikal</option>
                                <option value="Izin Usaha Industri">Izin Usaha Industri</option>
                                <option value="Izin Usaha Pengelolaan Pasar Rakyat (IUP2R)">Izin Usaha Pengelolaan Pasar Rakyat (IUP2R)</option>
                                <option value="Izin Usaha Toko Swalayan (IUTS)">Izin Usaha Toko Swalayan (IUTS)</option>
                                <option value="Izin Usaha Pusat Perbelanjaan (IUPP)">Izin Usaha Pusat Perbelanjaan (IUPP)</option>
                                <option value="Izin Pengusaha, Pemotongan, dan Penanganan Ternak">Izin Pengusaha, Pemotongan, dan Penanganan Ternak</option>
                                <option value="Izin Usaha Pembudidayaan Ikan">Izin Usaha Pembudidayaan Ikan</option>
                                <option value="Izin Usaha Simpan Pinjam Untuk Koperasi">Izin Usaha Simpan Pinjam Untuk Koperasi</option>
                                <option value="Izin Pembukaan Kantor Cabang, Cabang Pembantu dan Kantor Kas Koperasi Simpan Pinjam">Izin Pembukaan Kantor Cabang, Cabang Pembantu dan Kantor Kas Koperasi Simpan Pinjam</option>
                                <option value="Izin Tempat Penyelenggaraan Parkir Kendaraan Bermotor">Izin Tempat Penyelenggaraan Parkir Kendaraan Bermotor</option>
                                <option value="Izin Lingkungan">Izin Lingkungan</option>
                                <option value="Izin Mempekerjakan Tenaga Asing (IMTA)">Izin Mempekerjakan Tenaga Asing (IMTA)</option>
                                <option value="Izin Lokasi">Izin Lokasi</option>
                                <option value="Surat Izin Usaha Perdagangan (SIUP)">Surat Izin Usaha Perdagangan (SIUP)</option>
                                <option value="Surat Izin Praktik Tenaga Kesehatan">Surat Izin Praktik Tenaga Kesehatan</option>
                                <option value="Surat Izin Praktik Dokter Hewan">Surat Izin Praktik Dokter Hewan</option>
                                <option value="Surat Keterangan Penelitian">Surat Keterangan Penelitian</option>
                                <option value="Surat Izin Apotik">Surat Izin Apotik</option>
                                <option value="Surat Izin Usaha Perdagangan Minuman Beralkohol (SIUP-MB)">Surat Izin Usaha Perdagangan Minuman Beralkohol (SIUP-MB)</option>                            
                                </optgroup>


                            <optgroup label="Jenis Non Perizinan">
                                <option value="Informasi Tata Ruang (ITR)">Informasi Tata Ruang (ITR)</option>
                                <option value="Persetujuan Prinsip Pengkaplingan Tanah untuk Pembangunan, Perumahan dan Pemukiman">
                                    Persetujuan Prinsip Pengkaplingan Tanah untuk Pembangunan, Perumahan dan Pemukiman
                                </option>
                                <option value="Rekomendasi Mengontrakan, Tukar-menukar, dan Jual Tanah Laba Pura">Rekomendasi Mengontrakan, Tukar-menukar, dan Jual Tanah Laba Pura</option>
                                <option value="Rekomendasi Pendaftaran Penanaman Modal Asing (PPMA)">Rekomendasi Pendaftaran Penanaman Modal Asing (PPMA)</option>
                                <option value="Berita Acara Penelitian Lapangan (Rekomendasi SIUP-MB)">Berita Acara Penelitian Lapangan (Rekomendasi SIUP-MB)</option>
                                <option value="Surat Keterangan Tanda Pendaftaran Kegiatan Usaha Perikanan">Surat Keterangan Tanda Pendaftaran Kegiatan Usaha Perikanan</option>
                                <option value="Tanda Pendaftaran Peternakan Rakyat">Tanda Pendaftaran Peternakan Rakyat</option>
                                <option value="Sertifikat Laik Sehat">Sertifikat Laik Sehat</option>
                                <option value="Sertifikat Industri Pangan Rumah Tangga (SPP-IRT)">Sertifikat Industri Pangan Rumah Tangga (SPP-IRT)</option>
                                <option value="Surat Persetujuan Prinsip Landasan Helikopter (Heliport)">Surat Persetujuan Prinsip Landasan Helikopter (Heliport)</option>
                                <option value="Persetujuan Penggunaan Bangunan (PPB)">Persetujuan Penggunaan Bangunan (PPB)</option>
                                <option value="Tanda Daftar Gudang (TDG)">Tanda Daftar Gudang (TDG)</option>
                                <option value="Tanda Daftar Usaha Pariwisata (TDUP)">Tanda Daftar Usaha Pariwisata (TDUP)</option>
                            </optgroup>
                            </div>
                        </select>
                    </div>

                    

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Pengaduan</label>
                        <textarea class="form-control" rows="5" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi Pengaduan"  required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>     
                </div>
                
                <div class="col-12 d-flex justify-content-end mt-3">
                    <button type="reset" class="btn btn-secondary btn-sm me-1 mb-1">Reset</button>
                    <button type="submit" class="btn btn-success btn-sm me-1 mb-1">Laporkan Pengaduan</button>
                </div>
        </form> 
        </div>

    </div>
    </section>
            
@endsection
