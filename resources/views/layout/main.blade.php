<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('template')}}/dist/assets/css/app.css">
    <link rel="shortcut icon" href="{{asset('template')}}/dist/assets/images/favicon.svg" type="image/x-icon">

    <!-- tambahan link modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- tambahan untuk toast -->
    <script href="{{asset('template')}}/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script href="{{asset('template')}}/dist/assets/js/bootstrap.bundle.min.js"></script>

    <script href="{{asset('template')}}/dist/assets/vendors/toastify/toastify.js"></script>
    <script href="{{asset('template')}}/dist/assets/js/extensions/toastify.js"></script>

    <script href="{{asset('template')}}/dist/assets/js/main.js"></script>

</head>

<body>
<!-- NAVIGATION BAR -->
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{asset('template')}}/dist/assets/images/logo/logo dpmptsp.png" alt="Logo" 
                                style="width:60px; height:60px;  display: block; margin-left: auto; margin-right: auto;">
                            </a>
                            <p style="font-size: 14px; text-align:center; margin-top: 5px;">SISTEM PENGADUAN <br>DINAS PENANAMAN MODAL DAN PTSP KABUPATEN BADUNG </p>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <!-- <li class="sidebar-item active"> -->
                        <li class="sidebar-item">
                            <a href="{{ url('/pegawai/dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class="sidebar-link">
                                <i class="bi bi-clipboard-data"></i>
                                <span>Pengaduan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item">
                                    <a href="{{ url('/pengaduan/belum-proses') }}">Pengaduan Belum Diproses</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('/pengaduan/sedang-diproses') }}">Pengaduan Sedang Diproses</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{ url('/pengaduan/selesai') }}">Pengaduan Selesai</a>
                                </li>
                                @if(auth('pegawai')->user()->level == "Admin")
                                <li class="submenu-item ">
                                    <a href="{{ url('/pengaduan/tidak-aktif') }}">Pengaduan Tidak Aktif</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{ url('/pengaduan/cetakpengaduan') }}">Cetak Laporan Pengaduan</a>
                                </li>
                                @else
                                <li class="submenu-item ">
                                    <a href="{{ url('/pengaduan/cetakpengaduan') }}">Filter Laporan Pengaduan</a>
                                </li>
                                @endif
                            </ul>
                        </li>

                        
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                            <i class="bi bi-chat-square-text-fill"></i>
                                <span>Aspirasi</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item ">
                                    <a href="{{ url('/aspirasi') }}">Data Aspirasi</a>
                                </li>
                                
                                <!-- <li class="submenu-item ">
                                    <a href="{{ url('/aspirasi/cetakaspirasi') }}">Cetak Laporan Aspirasi</a>
                                </li> -->
                               
                            </ul>
                        </li>

                    @if(auth('pegawai')->user()->level == "Admin")
                    <li class="sidebar-title">Kelola Akun</li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-badge"></i>
                                <span>Data Verifikator</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{ url('/pegawai/tambah-verifikator') }}">Tambah Akun</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{ url('/pegawai/data-verifikator') }}">Data Verifikator</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ url('/pegawai/data-pemohon') }}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Data Pemohon</span>
                            </a>
                        </li>
                    @endif
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
<!-- END NAVIGATION BAR -->



<!-- HEADER CONTENT -->
<div id="main" class='layout-navbar'> 
        <nav class="navbar navbar-expand navbar-light ">
            <div class="container-fluid">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
     
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-nav ms-auto">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600">{{ Auth::guard('pegawai')->user()->nama }}</h6>
                                        <p class="mb-0 text-sm text-gray-600">{{ Auth::guard('pegawai')->user()->level }}</p>
                                </div>
                                        
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                    <img src="{{asset('template')}}/dist/assets/images/logo/profil2.png">
                                    </div>
                                </div>
                            </div>
                        </a>
                                
                                
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ url('/pegawai/profile-pegawai') }}">
                                <i class="icon-mid bi bi-person me-2"></i>Profil Saya</a>
                            </li>
                            
                            <li>
                            <form action="{{ route('logoutpegawai') }}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                <i class="icon-mid bi bi-box-arrow-right me-2"></i> Logout</button>
                            </form>
                            </li>
                                                      
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
<!-- END HEADER CONTENT -->



    <!-- ------------------ ISI CONTENT -------------------->
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-8 order-md-1">
                        <h4>@yield('header')</h4> 
                    </div>
                </div>
                @yield('content')
            </div>                   
        </div>                
    </div>  
<!-- ------------------ SELESAI CONTENT -------------------->
    </div>



    <script src="{{asset('template')}}/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{asset('template')}}/dist/assets/js/bootstrap.bundle.min.js"></script>

    <script src="{{asset('template')}}/dist/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="{{asset('template')}}/dist/assets/js/pages/dashboard.js"></script>

    <script src="{{asset('template')}}/dist/assets/js/main.js"></script>
    <!-- tambahan script untuk modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 2000);
        });    
    </script>
</body>

</html>