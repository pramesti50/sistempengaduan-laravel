<?php

namespace App\Http\Controllers;

use \Carbon\Carbon;
use App\Models\Aspirasi;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{

// --------TAMBAH ASPIRASI AKSES Halaman PEMOHON ----------------------------------------
    public function indexTambahAspirasi()
    {
        return view('pemohon.tambah_aspirasi');
    }

    public function prosesTambahAspirasi(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|max:80',
            'deskripsi' => 'required'
        ]);
        
        Aspirasi::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'pemohon_id' => auth('pemohon')->id() 
        ]);

        return redirect ('pemohon/riwayat-aspirasi')->with('status', 'Terima kasih telah menyampaikan Aspirasi Anda');
    }

    public function indexRiwayatAspirasi(Request $request)
    {
        $id = $request->session()->get('idlogin');
        $dataaspirasi = Aspirasi::where(['pemohon_id' => $id, 'status' => 'Aktif'])->orderBy('id', 'desc')->paginate(10);
        
        return view('pemohon.riwayat-aspirasi', compact('dataaspirasi'));
    }
// --------end ASPIRASI AKSES PEMOHON ------------------------------------------------




// -------AKSES PEGAWAI Admin dan Verifikator ----------------
    public function indexDataAspirasi(Request $request)
    {
    
        //Menghitung jumlah data aspirasi sesuai role user 
            if(Auth::guard('pegawai')->user()->level == "Admin")
            {
                $totalaspirasi = Aspirasi::all()->count();
            }
            else
            {  
                $totalaspirasi = Aspirasi::where(['status' => 'Aktif'])->count();
            }


    //menampilkan data aspirasi
        $tgl_awal =$request->tgl_awal . ' '.'00:00:00';
        $tgl_akhir =$request->tgl_akhir . ' '.'23:59:59';

            if(Auth::guard('pegawai')->user()->level == "Admin")
            {
                //semua status aktif dan tidak aktif di tampilan admin
                $dataaspirasi = Aspirasi::latest()->paginate(5);   
            }
            else 
            {
                //hanya menampilkan status aktif di tampilan verifikator
                $dataaspirasi = Aspirasi::where(['status' => 'Aktif'])->orderby('id', 'desc')->paginate(5);
            }

            return view('aspirasi.index', compact(['dataaspirasi', 'tgl_awal', 'tgl_akhir', 'totalaspirasi']));
    }

    public function filterAspirasi(Request $request)
    {
        //Menghitung jumlah data aspirasi sesuai role user 
            if(Auth::guard('pegawai')->user()->level == "Admin")
            {
                $totalaspirasi = Aspirasi::all()->count();
            }
            else
            {  
                $totalaspirasi = Aspirasi::where(['status' => 'Aktif'])->count();
            }

        //menampilkan filter data aspirasi
        $tgl_awal =$request->tgl_awal . ' '.'00:00:00';
        $tgl_akhir =$request->tgl_akhir . ' '.'23:59:59';
        
        
       
            if(Auth::guard('pegawai')->user()->level == "Admin")
            {
                //tampil semua status
                $dataaspirasi = Aspirasi::whereBetween('created_at',[$tgl_awal, $tgl_akhir])->paginate(5);
                
               
            }
            else
            {
                //tampil filter HANYA data status yg aktif
                $dataaspirasi = Aspirasi::whereBetween('created_at',[$tgl_awal, $tgl_akhir])->where(['status' => 'Aktif'])->paginate(5);
                
            }

            // dd($tgl_awal);
        
        return view('aspirasi.index', compact(['dataaspirasi', 'tgl_awal', 'tgl_akhir', 'totalaspirasi']));
    }


    


    public function edit_StatusAspirasi(Request $request, $dataaspirasi)
    {   
        $request->validate([
            'status' => 'required'
        ]);

        Aspirasi::where('id', $dataaspirasi)->update([
            'status' => $request->status
        ]);

        return redirect('/aspirasi')->with('status', 'Status berhasil diubah');
    }

    public function cetakpdfAspirasi($tgl_awal, $tgl_akhir)
    {
        $date = Carbon::now()->toDateString();

        $dataaspirasi = Aspirasi::whereBetween('created_at',[$tgl_awal, $tgl_akhir])->get();
        $aspirasipdf = PDF::loadView('aspirasi.laporan-PDFaspirasi', ['dataaspirasi' => $dataaspirasi, 'date' => $date]);
        return $aspirasipdf->download('laporan-aspirasi.pdf');
    }
// END akses ADMIN SAJA CETAK LAPORAN ASPIRASI --------
    







//----GAJADI DIPAKE HALAMANNYA INI--------------

    // akses ADMIN SAJA CETAK LAPORAN ASPIRASI --------
    public function indexcetakAspirasi()
    {
        return view('aspirasi.cetakaspirasi');
    }

    public function cariDataCetak(Request $request)
    {
        $tgl_awal =$request->tgl_awal . ' '.'00:00:00';
        $tgl_akhir =$request->tgl_akhir . ' '.'23:59:59';

        $cetaktglAspirasi = Aspirasi::whereBetween('created_at',[$tgl_awal, $tgl_akhir])->get();
        return view('aspirasi.cetakaspirasi', ['cetaktglAspirasi' =>$cetaktglAspirasi, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]);
    }

    // public function pdfAspirasi($tgl_awal, $tgl_akhir)
    // {
        
    //     $cetaktglAspirasi = Aspirasi::whereBetween('created_at',[$tgl_awal, $tgl_akhir])->get();
    //     $aspirasipdf = PDF::loadView('aspirasi.laporan-PDFaspirasi', ['cetaktglAspirasi' => $cetaktglAspirasi]);
    //     return $aspirasipdf->download('laporan-aspirasi.pdf');
    // }
    // END akses ADMIN SAJA CETAK LAPORAN ASPIRASI --------
    
    
// -------------------END AKSES PEGAWAI Admin dan Verifikator


    
}
