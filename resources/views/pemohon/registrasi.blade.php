<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/app.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/pages/auth.css">
    <title>Registrasi Pemohon | Sistem Pengaduan DPMPTSP Kabupaten Badung</title>

    <style>
        body 
        {
            background-color: #093782;
        }
    </style>
</head>

<body>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-12 mt-3">    
            <div class="card">
                <div class="card-body">   
                    <img src="{{asset('template')}}/dist/assets/images/logo/logo dpmptsp.png" alt="Logo" 
                    style="width:60px; height:60px;  margin:0 9px 3px 0; float:left;">                     
                    <h6 style=" margin-top: 8px; ">SISTEM PENGADUAN DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU KABUPATEN BADUNG </h4> 
                    <hr>
                    <h5 class="mb-4 mt-3">Registrasi Pemohon</h5>

                <form action="/pemohon/registrasi" method="POST">
                @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                            @error('nama') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                            

                        <div class="form-group col-md-6">
                            <label for="nik">NIK KTP</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" placeholder="NIK KTP" value="{{ old('nik') }}"  required>
                            @error('nik') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="jeniskelamin">Jenis Kelamin</label>
                            <select name="jeniskelamin" class="form-select" required>
                                <option value="">--Jenis Kelamin--</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="telp">Telepon</label>
                            <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" placeholder="No. Telp harus aktif dan benar" value="{{ old('telp') }}"  required>
                            @error('telp') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email harus aktif dan benar" value="{{ old('email') }}" required>
                            @error('email') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
                            @error('username') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Terdiri dari 5-10 karakter" value="{{ old('password') }}" required>
                            @error('password') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="konfirmpass">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('konfirmpass') is-invalid @enderror" id="konfirmpass" name="konfirmpass" placeholder="Terdiri dari 5-10 karakter" value="{{ old('konfirmpass') }}" required>
                            @error('konfirmpass') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <!-- <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat lengkap" rows="3" value="{{ old('alamat') }}"></textarea> -->
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat lengkap" value="{{ old('alamat') }}" required>
                            @error('alamat') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    <div class="row">
                        <div class="form-group col-md-6 mt-3">
                            <p style="color: #52515c;">Sudah punya akun? 
                                <a href="/login" class="font-bold">  Login</a>  
                            </p>
                        </div>

                        <div class="form-group col-md-6 mt-3">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Registrasi</button>
                        </div> 
                        </div> 
                    </div>
                        
                   
                
                </form>

                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                </div>
            </div>
            </div>
    </div>

    

</body>
</html>