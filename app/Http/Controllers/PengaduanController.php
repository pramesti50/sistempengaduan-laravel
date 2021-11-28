<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
//use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use PDF;
use Auth;

class PengaduanController extends Controller
{

// --------start PENGADUAN AKSES PEMOHON ----------------------------------------
    public function tambahPengaduan(Request $request)
    {
        return view('pemohon.tambah-pengaduan');
    }

    public function prosesTambahPengaduan(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:80',
            'kategori' => 'required',
            'tgl_pengaduan' => 'required',
            'deskripsi' => 'required'
        ]);
       
        Pengaduan::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'tgl_pengaduan' => $request->tgl_pengaduan,
            'deskripsi' => $request->deskripsi,
            'pemohon_id' => auth('pemohon')->id() 
            
        ]);
        return redirect('/pemohon/riwayatpengaduan')->with('status', 'Laporan pengaduan Anda telah dikirim dan segera diproses'); 
    }

    public function riwayatPengaduan(Request $request)
    {
        // menampilkan data pengaduan yg telah dikirimkan pemohon
        $id = $request->session()->get('idlogin');
        $pengaduan = Pengaduan::where('pemohon_id', $id)->orderBy('id', 'desc')->paginate(10);

        return view('pemohon.riwayatpengaduan', compact('pengaduan'));
    }

    public function detailRiwayatPengaduan(Request $request, $id)
    {
        //ambil id pengaduan sama dengan id pengaduan dgn batasan 1 id pengaduan
        $riwayat = Pengaduan::where('id', $id)->first();

        // menampilkan nama user yg login
        //$sesinama = $request->session()->get('namalogin');
        return view('pemohon.detail-riwayatpengaduan', compact('riwayat'));
    }
// --------end PENGADUAN AKSES PEMOHON----------------------------------------





//=========================================================================================    
// --------start PENGADUAN AKSES Admin & Verifikator

//Belum Diproses
    public function indexBelumProses()
    {
        $blmproses = Pengaduan::where(['status' => 'Belum Diproses'])->count();
        $pengaduanMasuk = Pengaduan::where('status', ['Belum Diproses'])->paginate(10);
        return view ('pengaduan.belum-proses', compact('pengaduanMasuk', 'blmproses'));
    }

    public function editStatusBelumProses(Request $request, Pengaduan $pengaduanMasuk)
    {
        $request->validate([
            // 'tgl_verifikasi' => 'required',
            'status' => 'required'
        ]);

        Pengaduan::where('id', $pengaduanMasuk->id)->update([
           // 'tgl_verifikasi' => $request->tgl_verifikasi,
            'status' => $request->status
        ]);
               
        return redirect ('/pengaduan/belum-proses')->with('status', 'Status laporan pengaduan sedang diproses');
    }


//  SEDANG DIPROSES =================SEDANG DIPROSES==================SEDANG DIPROSES===============================================  

    public function indexSedangDiproses(Request $request)
    {
        $sedangproses = Pengaduan::where([['status', '!=', 'Belum Diproses'], ['status', '!=', 'Selesai'], ['status', '!=', 'Tidak Aktif']])->count();
        if($request->has('caristatus'))
        {
            $pengaduanMasuk = Pengaduan::where('status', 'LIKE','%'.$request->caristatus.'%')->paginate(10);
        }
        else 
        {
            $pengaduanMasuk = Pengaduan::where([
                ['status', '!=', 'Belum Diproses'],
                ['status', '!=', 'Selesai'],
                ['status', '!=', 'Tidak Aktif'],
            ])->paginate(10);
        }

        return view ('pengaduan.sedang-diproses', compact('pengaduanMasuk', 'sedangproses'));
    }

    public function indexVerifikasiPengaduan($id)
    {
        //ambil id pengaduan sama dengan id pengaduan dgn batasan 1 id pengaduan
        $sedangproses = Pengaduan::where('id', $id)->first();
        return view('pengaduan.detail-sedang-diproses', compact('sedangproses'));
    }


    public function verifikasiPengaduan(Request $request, Pengaduan $sedangproses)
    {
        $request->validate([
            'tgl_verifikasi' => 'required',
            'status' => 'required',
            'tanggapan' => 'required'
        ]);

        Pengaduan::where('id', $sedangproses->id)->update([
            'tgl_verifikasi' => $request->tgl_verifikasi,
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
            'pegawai_id' => auth('pegawai')->id()
        ]);
        
        return redirect ('/pengaduan/selesai')->with('status', 'Pengaduan berhasil diverifikasi');

    }




//====SELESAI PROSES============SELESAI PROSES==========SELESAI PROSES===========================  

    public function indexSelesai(Request $request)
    {
        //TOMBOL INFO JUMLAH DATA PENGADUAN
            $blmproses = Pengaduan::where('status', 'Belum Diproses')->count();
            $sedangproses = Pengaduan::where([['status', '!=', 'Belum Diproses'], ['status', '!=', 'Selesai'], ['status', '!=', 'Tidak Aktif']])->count();
            $selesai = Pengaduan::where('status', 'Selesai')->count();
            $aktif = Pengaduan::where([['status', '!=', 'Tidak Aktif']])->count();
            $tdkaktif = Pengaduan::where('status', 'Tidak Aktif')->count();
            $total = Pengaduan::all()->count();
        //END
        
        $pengaduanMasuk = Pengaduan::where('status', ['Selesai'] )->orderby('updated_at', 'desc')->paginate(10);
        return view ('pengaduan.selesai', compact(['pengaduanMasuk', 'selesai', 'blmproses', 'sedangproses', 'aktif','tdkaktif','total']));
    }

    
    public function cariSelesai(Request $request)
    {
        //TOMBOL INFO JUMLAH DATA PENGADUAN
            $blmproses = Pengaduan::where('status', 'Belum Diproses')->count();
            $sedangproses = Pengaduan::where([['status', '!=', 'Belum Diproses'], ['status', '!=', 'Selesai'], ['status', '!=', 'Tidak Aktif']])->count();
            $selesai = Pengaduan::where('status', 'Selesai')->count();
            $aktif = Pengaduan::where([['status', '!=', 'Tidak Aktif']])->count();
            $tdkaktif = Pengaduan::where('status', 'Tidak Aktif')->count();
            $total = Pengaduan::all()->count();
        //END


        //cari berdasarkan tanggal verifikasi selesai
            $awalselesai = $request->awalselesai;
            $akhirselesai = $request->akhirselesai;
         
        $pengaduanMasuk = Pengaduan::whereBetween('tgl_verifikasi', [$awalselesai, $akhirselesai])->where(['status' => 'Selesai'])->latest('updated_at')->paginate(10);
        return view('pengaduan.selesai', ['pengaduanMasuk' => $pengaduanMasuk, 'awalselesai' => $awalselesai, 
            'akhirselesai' => $akhirselesai, 'selesai' => $selesai, 'blmproses' => $blmproses, 'sedangproses' => $sedangproses, 'aktif' => $aktif,'tdkaktif' => $tdkaktif,'total' => $total]);
    }


    public function indexDetailSelesai($id)
    {
        $selesai = Pengaduan::where('id', $id)->first();
        return view('pengaduan.detail-selesai', compact('selesai'));
    }

    public function editTanggapanSelesai(Request $request, Pengaduan $selesai)
    {
        $request->validate([
            'status' => 'required',
            'tanggapan' => 'required'
        ]);

        Pengaduan::where('id', $selesai->id)->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
            'pegawai_id' => auth('pegawai')->id()
        ]);

        return redirect()->back()->with('status', 'Perubahan disimpan');
    }
// --------end AKSES Admin & Verifikator --------------------------------
    




//===========AKSES ADMIN CETAK PENGADUAN=================AKSES ADMIN CETAK PENGADUAN=================================
    
    public function indexCetakPengaduan(Request $request)
    {
        $blmproses = Pengaduan::where('status', 'Belum Diproses')->count();
        $sedangproses = Pengaduan::where([['status', '!=', 'Belum Diproses'], ['status', '!=', 'Selesai'], ['status', '!=', 'Tidak Aktif']])->count();
        $selesai = Pengaduan::where('status', 'Selesai')->count();
        $aktif = Pengaduan::where('status', '!=', 'Tidak Aktif')->count();
        $tdkaktif = Pengaduan::where('status', 'Tidak Aktif')->count();
        $total = Pengaduan::all()->count();

        $cetakTglPengaduan = null;

        $tgl_awalpengaduan = $request->tgl_awalpengaduan;
        $tgl_akhirpengaduan = $request->tgl_akhirpengaduan;

        if (!empty($tgl_awalpengaduan) && !empty($tgl_akhirpengaduan)) {
            $cetakTglPengaduan = Pengaduan::with('pemohon', 'pegawai')->whereBetween('tgl_pengaduan',[$tgl_awalpengaduan, $tgl_akhirpengaduan])->paginate(5);;
        }

        return view('pengaduan.cetakpengaduan', compact(['cetakTglPengaduan', 'tgl_awalpengaduan', 'tgl_akhirpengaduan', 'blmproses', 'sedangproses', 'selesai', 'aktif','tdkaktif','total']));
    }

    // public function cariCetakPengaduanTanggal (Request $request)
    // {
    //     $blmproses = Pengaduan::where('status', 'Belum Diproses')->count();
    //     $sedangproses = Pengaduan::where([['status', '!=', 'Belum Diproses'], ['status', '!=', 'Selesai'], ['status', '!=', 'Tidak Aktif']])->count();
    //     $selesai = Pengaduan::where('status', 'Selesai')->count();
    //     $aktif = Pengaduan::where([['status', '!=', 'Tidak Aktif']])->count();
    //     $tdkaktif = Pengaduan::where('status', 'Tidak Aktif')->count();
    //     $total = Pengaduan::all()->count();

    //     //filter tgl
    //         $tgl_awalpengaduan = $request->tgl_awalpengaduan;
    //         $tgl_akhirpengaduan = $request->tgl_akhirpengaduan;

    //     $cetakTglPengaduan = Pengaduan::whereBetween('tgl_pengaduan',[$tgl_awalpengaduan, $tgl_akhirpengaduan])->get();

    //     return view('pengaduan.cetakpengaduan', ['cetakTglPengaduan' => $cetakTglPengaduan, 
    //         'tgl_awalpengaduan' => $tgl_awalpengaduan, 'tgl_akhirpengaduan' => $tgl_akhirpengaduan, 'blmproses' => $blmproses, 'sedangproses' => $sedangproses, 'selesai' => $selesai, 'tdkaktif' => $tdkaktif, 'aktif' => $aktif,'total' => $total]);
    // }

    public function cetakPdfPengaduan($tgl_awalpengaduan, $tgl_akhirpengaduan)
    {
        $date = Carbon::now()->toDateString();
        
        $cetakTglPengaduan = Pengaduan::whereBetween('tgl_pengaduan',[$tgl_awalpengaduan, $tgl_akhirpengaduan])->get();
        $pengaduanpdf = PDF::loadView('pengaduan.pdfpengaduan', ['cetakTglPengaduan' => $cetakTglPengaduan]);
        return $pengaduanpdf->download('laporan-pengaduan.pdf');
    }



//========== STATUS TIDAK AKTIF ==================================================
    public function indexTidakAktif()
    {
        $total_tdkaktif = Pengaduan::where(['status' => 'Tidak Aktif'])->count();

        $tdkaktif = Pengaduan::where('status',['Tidak Aktif'])->orderby('updated_at', 'desc')->paginate(10);
        return view('pengaduan.tidak-aktif', compact(['total_tdkaktif', 'tdkaktif']));
    }

    public function cariTidakAktif(Request $request)
    {
        $total_tdkaktif = Pengaduan::where('status', 'Tidak Aktif')->count();

        $awal_tdkaktif = $request->awal_tdkaktif;
        $akhir_tdkaktif = $request->akhir_tdkaktif;

        $tdkaktif = Pengaduan::whereBetween('tgl_verifikasi', [$awal_tdkaktif, $akhir_tdkaktif])->where(['status' => 'Tidak Aktif'])->latest('updated_at')->paginate(10);
        return view('pengaduan.tidak-aktif', ['tdkaktif' => $tdkaktif, 'awal_tdkaktif' => $awal_tdkaktif, 'akhir_tdkaktif' => $akhir_tdkaktif, 'total_tdkaktif' => $total_tdkaktif]);
    }

    public function indexDetailTdkAktif($id)
    {
        $tdkaktif = Pengaduan::where('id', $id)->first();
        return view('pengaduan.detail-tidakaktif', compact('tdkaktif'));   
    }

    public function editTidakAktif(Request $request, Pengaduan $tdkaktif)
    {
        $request->validate([
            'status' => 'required',
            'tanggapan' => 'required'
        ]);

        Pengaduan::where('id', $tdkaktif->id)->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
            'pegawai_id' => auth('pegawai')->id()
        ]);

        return redirect()->back()->with('status', 'Perubahan disimpan');
    }

//-------END AKSES ADMIN

}
