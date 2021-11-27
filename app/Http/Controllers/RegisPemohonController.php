<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemohon;

class RegisPemohonController extends Controller
{
    public function regisPemohon()
    {
        return view('pemohon.registrasi');
    }

    public function inputRegis(Request $request)
    {
        $this->validate($request,[
            'nama' =>'required|max:35',
            'nik' =>'required|max:16',
            'email' =>'required|email:dns',
            'telp' =>'required|max:12',
            'jeniskelamin' =>'required',
            'alamat' =>'required',
            'username' =>'required|unique:pemohons|max:20',
            'password' => 'required|min:5|max:10',
            'konfirmpass' => 'required|min:5|max:10'
        ]);
        

        if($request->password === $request->konfirmpass)
        {
            Pemohon::create([
                'nama' =>$request->nama,
                'nik' =>$request->nik,
                'email' =>$request->email,
                'telp' =>$request->telp,
                'jeniskelamin' =>$request->jeniskelamin,
                'alamat' =>$request->alamat,
                'username' =>$request->username,
                'password' => bcrypt($request->password)
            ]);
            
            return redirect('/login')->with('statusberhasil', 'Registrasi berhasil, silahkan Login');
        }
        else
        {
            return back()->with('status', 'Gagal Registrasi Akun');
        }
    }



    
}
