<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/app.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/pages/auth.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <title>Login Pegawai | Sistem Pengaduan DPMPTSP Kabupaten BADUNG</title>

    <style>
        body 
        {
            /* background-color: #093782; */
            background-image: url('{{ asset('template')}}/dist/assets/images/bg/back-admin2.jpg');
            height: 100%;
            width: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 2300);
        });    
    </script>

</head>
<body>
<div class="row justify-content-center mt-10">
        <div class="col-lg-5 col-12 mt-3">    
            <div class="card">
                <div class="card-body">   
                    <img src="{{asset('template')}}/dist/assets/images/logo/logo dpmptsp.png" alt="Logo" 
                    style="width:60px; height:60px;  margin:0 9px 3px 0; float:left;">                     
                    <h6 style=" margin-top: 3px; ">SISTEM PENGADUAN DINAS PENANAMAN MODAL <br>DAN PELAYANAN TERPADU SATU PINTU <br>KABUPATEN BADUNG </h4> 
                    <hr>
                    <h5 class="text-center">Login</h5>  
                    

                    <form action="{{ route('loginpegawai') }}" method="POST">
                    @csrf
                        <div class="form-group position-relative has-icon-left mt-3 mb-4">
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror form-control-xl" placeholder="Username" value="{{ old('username') }}" required>
                            @error('username') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" id="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" required> 
                            @error('password') 
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>  


                        @if (session('statusgagal'))
                        <div class="alert alert-danger alert-dismissible show fade mt-3">
                            {{ session('statusgagal') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif

                    @if (session('statusberhasil'))
                        <div class="alert alert-success alert-dismissible show fade mt-3">
                            {{ session('statusberhasil') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endif


                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3" style="background-color:#171d73; border-color:#171d73;">Login</button>
                    </form>

                    <div class="text-center mt-3 text-lg">
                        <p>Bukan Pegawai ? 
                            <a href="/login" class="font-bold">  Login Pemohon</a>
                        </p>                 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    

    
</body>
</html>