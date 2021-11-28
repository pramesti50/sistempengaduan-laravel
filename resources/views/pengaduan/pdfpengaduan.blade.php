<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Laporan Data Pengaduan</title>
    <style>
        .tabeladuan
        {
            border-collapse: collapse;
        }
    
        .tabeladuan, th, td
        {
          border: 1px solid #000;
          padding: 5px 5px;;
        }
        
        .tabeladuan tr th
        {
            background: #abb0b3;
            color: #000;
            font-weight: bold;
            letter-spacing: 0.3px;
        }
        .tbody .tandatangan
        {
            font-size: 11px;
        }

        .logo 
        {
            float:left;
            display:block;
            width:70px;
            margin-top:15px;
        }
    </style>
</head>

<body>
    <img src="{{ public_path('template/logodpmptsp.png')}}" class="logo">
    <div style="text-align:center;">
        <h4>LAPORAN PENGADUAN<br> 
        DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU <br>
        KABUPATEN BADUNG<br>
        Periode {{ $tgl_awalpengaduan }} - {{ $tgl_akhirpengaduan }}
        </h4>
    </div>

    <table class="tabeladuan">
        <thead>
            <tr style="text-align:center;">
                <th scope="col">No.</th>
                <th scope="col">Tgl Pengaduan</th>
                <th scope="col">Nama Pemohon</th>
                <th scope="col">Kategori<br>Pengaduan</th>
                <th scope="col">Judul Pengaduan</th>
                <th scope="col">Tgl Verifikasi</th>
            </tr>
        </thead>
                            
        <tbody>
        @foreach( $cetakTglPengaduan as $semuaPengaduan )
            <tr>
                <td scope="row" style="text-align:center;" width="20px">{{ $loop->iteration }}.</td>
                <td width="85px" style="text-align:center;">{{ \Carbon\Carbon::parse($semuaPengaduan->tgl_pengaduan)->format('d/m/Y') }}</td>
                <td width="90px">{{ $semuaPengaduan->pemohon->nama }}</td>
                <td width="150px">{{ $semuaPengaduan->kategori }}</td>
                <td width="200px">{{ $semuaPengaduan->judul }}</td>
                <td width="85px" style="text-align:center;">{{ $semuaPengaduan->tgl_verifikasi ? \Carbon\Carbon::parse($semuaPengaduan->tgl_verifikasi)->format('d/m/Y') : null }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>

    <!--  .................................... -->
    <footer style="page-break-inside: avoid;">
    <p style="float:right;">Mangupura, {{ date('d F Y') }}</p>
    <div class="tandatangan">
    <br>
        <table style="border:none;">
        <tbody style="border:none;">
                <tr style="border:none;">
                    <td style="border:none;">Kepala Bidang Pengaduan dan Pelaporan</td>
                    <td style="border:none; color:white;">......................</td>
                    <td style="border:none;">Kepala Seksi Pengaduan dan Informasi Layanan</td>
                </tr>  
            
                <tr style="border:none;">
                    <td style="border:none;" height="10%"></td>
                    <td style="border:none; color:white;"height="10%"></td>
                    <td style="border:none;" height="10%"></td>
                </tr>
                

                <tr style="border:none;">
                    <td style="border:none; text-indent:20px;"><b><u>I Gusti Made Suparta, SE., M.Si</b></u></td>
                    <td style="border:none; color:white;">......................</td>
                    <td style="border:none; text-indent:60px;"><b><u>I Nyoman Wirnata, SE</b></u></td>
                </tr>


                <tr style="border:none;">
                    <td style="border:none; text-indent:20px;">NIP. 19631231 198803 1 315</td>
                    <td style="border:none; color:white;">......................</td>
                    <td style="border:none; text-indent:48px;">NIP. 19740529 200604 1 004</td>
                </tr>
            </tbody>
        </table>
    </div>
    </footer>

</body>
</html>