<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;
use App\Models\Pengaduan;
use App\Models\Aspirasi;
use Auth;
use Session;

class AuthPegawaiController extends Controller
{
    
//login
    public function indexLoginPegawai()
    {
        return view('/login-pegawai');
    }

    public function prosesLoginPegawai(Request $request)
    {
        $usernamepegawai = Pegawai::where('username', $request->username)->first();
        if(!$usernamepegawai)
        {
            return redirect()->back()->with('statusgagal', 'Username Anda tidak terdaftar');
        }

        $passwordpegawai = Hash::check($request->password, $usernamepegawai->password);
        if(!$passwordpegawai)
        {
            return redirect()->back()->with('statusgagal', 'Password Anda tidak sesuai');
        }

    //cek proses login
        $authpegawai = Auth::guard('pegawai')->attempt(['username' => $request->username, 'password' => $request->password, 'status' => 'Aktif']);
        $idpegawai = Pegawai::where('username', $request->username)->value('id');
                
            session([
                'idloginpegawai' => $idpegawai,
            ]);
        
        if($authpegawai)
        {
            $request->session()->regenerate();
            
            return redirect()->intended('/pegawai/dashboard');
        }
        else
        {
            return redirect()->back()->with('statusgagal', 'Akun Anda tidak terdaftar');
        }

    }

//dashboard pegawai = ADMIN & VERIFIKATOR
    public function indexDashboardPegawai()
    {
        $belum = Pengaduan::where(['status' => 'Belum Diproses'])->count();
        $selesai = Pengaduan::where(['status' => 'Selesai'])->count();
        $sedangproses = Pengaduan::where([['status', '!=', 'Belum Diproses'], ['status', '!=', 'Selesai'], ['status', '!=', 'Tidak Aktif']])->count();
        $aspirasi = Aspirasi::where(['status' => 'Aktif'])->count();
        

        $aduan = Pengaduan::where(['status'=> 'Sedang diproses oleh Bidang Pengaduan & Pelaporan'])->count();
        $programinfo = Pengaduan::where(['status' => 'Sedang diproses oleh Bidang Program & Informasi'])->count();
        $non = Pengaduan::where(['status' => 'Sedang diproses oleh Bidang Perizinan Kesejahteraan Rakyat & Non Perizinan'])->count();
        $pemerintah = Pengaduan::where(['status' => 'Sedang diproses oleh Bidang Perizinan Pemerintahan & Pembangunan'])->count();
        $ekonomi = Pengaduan::where(['status' => 'Sedang diproses oleh Bidang Pelayanan Perizinan Ekonomi'])->count();
        $modal = Pengaduan::where(['status' => 'Sedang diproses oleh Bidang Pelaksanaan Penanaman Modal'])->count();
        $totalpengaduan = Pengaduan::all()->count();

        return view('/pegawai/dashboard', compact([ 'belum', 'selesai', 'sedangproses', 'aduan', 'programinfo', 'non', 'pemerintah', 'ekonomi', 'modal', 'aspirasi', 'totalpengaduan' ]));
    }
    
//logout
    public function logoutPegawai(Request $request)
    {
        Auth::guard('pegawai')->logout(); 
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginpegawai');
    }

//Profile Pegawai Admin/Verifikator
    public function indexProfilePegawai(Request $request)
    {
        $idpegawai = $request->session()->get('idloginpegawai');
        $datapegawai = Pegawai::where('id', $idpegawai)->get(); 
        return view('/pegawai/profile-pegawai', compact(['datapegawai']));
    }

    public function editProfilePegawai(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:35',
            'email' => 'required|email:dns',
            'jeniskelamin' => 'required',
            'telp' => 'required|max:12',
            'nip' => 'required|max:20',
            'alamat' => 'required',
        ]);

        $datapegawai = $request->session()->get('idloginpegawai');
        
        Pegawai::where('id', $datapegawai)->update([
            'nama' => $request->nama,
            'namabidang'  => $request->namabidang,
            'email'  => $request->email,
            'jeniskelamin'  => $request->jeniskelamin,
            'telp'  => $request->telp,
            'nip'  => $request->nip,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('editprofilepegawai')->with('status', 'Berhasil menyimpan perubahan akun');
    }

//Update Password Pegawai dimasing2 akun
    public function indexEditPassword(Request $request)
    {
        $profilpegawai = $request->session()->get('idloginpegawai');
        return view('pegawai.ubahpassword', compact('profilpegawai'));
    }

    public function editPasswordPegawai(Request $request, Pegawai $dataakunpegawai)
    {
        $ubahpassAkun = Hash::make($request->updatepass);
        
        $dataakunpegawai = $request->session()->get('idloginpegawai');
        
        $cekpassword = Pegawai::where('id', $dataakunpegawai)->value('password');
        if( $ubahpassAkun == $cekpassword || $request->password == $request->konfirmpasspegawai )
        {
            $request->validate([
                'password' => 'required|min:5|max:10',
                'konfirmpasspegawai' => 'required|min:5|max:10'
            ]);

            Pegawai::where('id', $dataakunpegawai)->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect('/pegawai/ubahpassword')->with('statusberhasil', 'Password berhasil diubah');
        }
        else
        {
            return redirect()->back()->with('statusgagal', 'Gagal ubah password akun');
        }
    }

    
}
