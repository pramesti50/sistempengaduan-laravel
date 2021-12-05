<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemohon;
use Auth;
use Session;


class LoginController extends Controller
{
// tampil form login PEMOHON
    public function indexlogin()
    {
        return view('login');
    }

// PROSES LOGIN PEMOHON
    public function prosesLoginPemohon(Request $request)
    {
    //cek username dan password
        $usernamepemohon = Pemohon::where('username', $request->username)->first();
        if( !$usernamepemohon )
        {
            return redirect()->back()->with('status', 'Username Anda tidak terdaftar');
        }

        $passwordpemohon = Pemohon::where('password', $request->password);
        if( !$passwordpemohon)
        {
            return redirect()->back()->with('status', 'Password Anda tidak sesuai');
        }

        
        $loginpemohon = Auth::guard('pemohon')->attempt(['username' => $request->username, 'password' => $request->password, 'status' => 'Aktif']);
        $id = Pemohon::where('username', $request->username)->value('id');  
                session([
                    'idlogin' => $id,
                    // 'namalogin' => $tampilnama, 
                ]);
        

        if($loginpemohon)
        {
            $request->session()->regenerate();
            return redirect()->intended('/pemohon/dashboard');
        }
        else
        {
            return redirect()->back()->with('status', 'Username/password Anda tidak sesuai');
        }
        
    }


    public function dashboardPemohon()
    {
        return view('/pemohon/dashboard');
    }

    public function LogoutPemohon(Request $request)
    {
        Auth::guard('pemohon')->logout();
        //$request->session()->flush(); 
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended('login');
    }


//------------KELOLA AKUN PEMOHON--------------------

    public function indexProfilePemohon(Request $request)
    {
        //nampilin nama sesuai pemohon yg login
        //$sesinama = $request->session()->get('namalogin');
        $id = $request->session()->get('idlogin');
        $semua = Pemohon::where('id', $id)->get();  
        
        return view('pemohon.profile-pemohon', compact(['semua']));
    }

    public function updatePemohon(Request $request)
    {
        $request->validate([
            'nama' =>'required|max:35',
            'nik' =>'required|max:16',
            'email' =>'required|email:dns',
            'telp' =>'required|max:12',
            'jeniskelamin' =>'required',
            'alamat' =>'required'
        ]);

        $updatepemohon = $request->session()->get('idlogin');
        Pemohon::where('id', $updatepemohon)->update([
            'nama'  =>$request->nama,
            'nik'   => $request->nik,
            'email' => $request->email,
            'telp'  =>$request->telp,
            'jeniskelamin' =>$request->jeniskelamin,
            'alamat' =>$request->alamat
        ]);

        return redirect('/pemohon/profile-pemohon')->with('status', 'Data diri berhasil diubah');
    }



    public function indexUpdatePassword(Request $request)
    {
        // $sesinama = $request->session()->get('namalogin');
        return view('pemohon.updatepassword');
    }


    
    public function updatePassword(Request $request)
    {
        $gantipass = bcrypt($request->passbaru);

        //panggil id session yg login
        $id = $request->session()->get('idlogin');
        
        //cek password yg di db sesuai dgn id yg login
        $cekpassdb = Pemohon::where('id', $id)->value('password');

        if( $gantipass == $cekpassdb || $request->password == $request->konfirmpass )
        {
            $request->validate([
                'password' => 'required|min:5|max:10',
                'konfirmpass' => 'required|min:5|max:10'
            ]);

            Pemohon::where('id', $id)->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect('/pemohon/updatepassword')->with('status', 'Berhasil ubah password');
        }
        else
        {
            return back()->with('statusgagal', 'Gagal ubah password');
        }
    }

   
}
