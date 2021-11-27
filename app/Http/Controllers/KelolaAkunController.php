<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemohon;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use Validator;


class KelolaAkunController extends Controller
{

// -----------------KELOLA AKUN PEMOHON oleh ADMIN-----------------------
    public function indexDataPemohon(Request $request)
    {
        $jmlhPemohon = Pemohon::all()->count();

        if($request->has('caripemohon'))
        {
            $datapemohon = Pemohon::where('username', 'LIKE','%'.$request->caripemohon.'%')->paginate(20)
            ->appends(['caripemohon' => $request->caripemohon]);
            
        }
        else
        {
            $datapemohon = Pemohon::orderBy('id', 'desc')->paginate(20);
            
        }
        
        return view('pegawai.data-pemohon', compact('datapemohon', 'jmlhPemohon'));
    }



    public function editDataPemohon(Request $request, Pemohon $datapemohon)
    {
        $request->validate([
            'status' =>'required'
        ]);

        Pemohon::where('id', $datapemohon->id)->update([
            'status' => $request->status
        ]);
  
        
        return redirect('/pegawai/data-pemohon')->with('status', 'Data Akun Pemohon berhasil diubah');
    }

    public function editPassword(Request $request, Pemohon $datapemohon)
    {
        $resetpass = bcrypt($request->passbaru);

        $cekpassdb = Pemohon::where('id', $datapemohon)->value('password');

        if( $resetpass == $cekpassdb || $request->password == $request->konfirmpass )
        {
            $request->validate([
                'password' => 'required|min:5|max:10',
                'konfirmpass' => 'required|min:5|max:10'
            ]);

            Pemohon::where('id', $datapemohon->id)->update([
                'password' => bcrypt($request->password)
            ]);

            return redirect('/pegawai/data-pemohon')->with('status', 'Berhasil ubah password Pemohon');
        }
        else
        {
            return redirect('/pegawai/data-pemohon')->with('statusgagal', 'Gagal mengubah password Pemohon');
        }
    }
// SELESAI KELOLA AKUN PEMOHON  (ADMIN)-----------------------
    



// -----------------KELOLA AKUN VERIFIKATOR oleh ADMIN-----------------------

//tambah verifikator
    public function indexTambahVerifikator()
    {
        return view ('pegawai/tambah-verifikator');
    }

    public function prosesTambahVerifikator(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:35',
            'email' => 'required|email:dns',
            'telp' => 'required|max:12',
            'nip' => 'required|max:20',
            'jeniskelamin' => 'required',
            'alamat' => 'required',
            'namabidang' => 'required',
            'level' => 'required',
            'username' => 'required|unique:pegawais|max:20',
            'password' => 'required|min:5|max:10',
            'konfirmpasspegawai' => 'required|min:5|max:10'   
        ]);    
        
        Pegawai::create([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'telp'          => $request->telp,
            'nip'          => $request->nip,
            'jeniskelamin'  => $request->jeniskelamin,
            'alamat'        => $request->alamat,
            'namabidang'    => $request->namabidang,
            'level'         => $request->level,
            'username'      => $request->username,
            'password'      => Hash::make($request->password)
        ]);
        
        return redirect('pegawai/data-verifikator');
    }

//tampil data verifikator
    public function indexDataVerifikator(Request $request)
    {
        $jmlhVerifikator = Pegawai::where('level', 'Verifikator')->count();

        if( $request->has('cariverifikator'))
        {
            $dataverifikator = Pegawai::where('username', 'LIKE','%'.$request->cariverifikator.'%')->orderBy('id', 'desc')->paginate(15)
            ->appends(['cariverifikator' => $request->cariverifikator]);;
        }
        else
        {
            //nampilin data verifikator saja
            $dataverifikator = Pegawai::where('level', ['Verifikator'])->orderBy('id', 'desc')->paginate(15);
            //$dataverifikator = Pegawai::orderBy('id', 'desc')->get();     nampilin semua data
        }
        return view ('pegawai/data-verifikator', compact('dataverifikator', 'jmlhVerifikator'));
    }
    
//edit verifikator
    public function editDataVerifikator(Request $request, Pegawai $dataverifikator)
    {
        $request->validate([
            'namabidang' => 'required',
            'status' => 'required',
            'level' => 'required'
        ]);

        Pegawai::where('id', $dataverifikator->id)->update([
            'namabidang' => $request->namabidang,
            'status' => $request->status,
            'level' => $request->level
        ]);
        
        return redirect('/pegawai/data-verifikator')->with('status', 'Data Akun Verifikator berhasil diubah');
    }

//reset password verifikator
    public function editPasswordVerifikator(Request $request, Pegawai $dataverifikator)
    {
        $resetpegawai = Hash::make($request->passbarupegawai);

        $cekpasspegawai = Pegawai::where('id', $dataverifikator)->value('password');

        if( $resetpegawai == $cekpasspegawai || $request->password == $request->konfirmpasspegawai )
        {
            $request->validate([
                'password' => 'required|min:5|max:10',
                'konfirmpasspegawai' => 'required|min:5|max:10'
            ]);

            Pegawai::where('id', $dataverifikator->id)->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect('/pegawai/data-verifikator')->with('status', 'Berhasil ubah password Verifikator');
        }
        else
        {
            return redirect('/pegawai/data-verifikator')->with('statusgagal', 'Gagal mengubah password Verifikator');
        }
    }    


// SELESAI KELOLA AKUN VERIFIKATOR (ADMIN) -----------------------
}
