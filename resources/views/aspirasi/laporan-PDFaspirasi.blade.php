<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Laporan Aspirasi Pemohon</title>
    <style>
        .tabelasp
        {
            border-collapse: collapse;
        }
        
        .tabelasp, th, td
        {
          border: 1px solid #000;
          padding: 5px 5px;;
        }
        .tabelasp tr th
        {
            background: #d3dee8;
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
        <h4>DATA LAPORAN ASPIRASI PEMOHON<br> 
        DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU <br>
        KABUPATEN BADUNG<br>
        Periode {{ $tgl_awal }} - {{ $tgl_akhir }}
        </h4>
        
    </div>

    <table class="tabelasp">
        <thead>
            <tr style="text-align:center;">
                <th scope="col">No.</th>
                <th scope="col">Judul Aspirasi</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Nama Pemohon</th>
                <th scope="col">Tgl<br>Aspirasi</th>
            </tr>
        </thead>
                            
        <tbody>
        @foreach( $dataaspirasi as $semuaaspirasi )
            <tr>
                <td scope="row" style="text-align:center;"width="20px">{{ $loop->iteration }}.</td>
                <td >{{ $semuaaspirasi->judul }}</td>
                <td >{{ $semuaaspirasi->deskripsi }}</td>
                <td width="100px">{{ $semuaaspirasi->pemohon->nama }}</td>
                <td style="text-align:center;" width="100px">{{ $semuaaspirasi->created_at->format('d M Y') }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>

    <!--  .................................... -->
    <footer style="page-break-inside: avoid;">
    <p style="float:right">Mangupura, {{ date('d F Y') }}</p>
    
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