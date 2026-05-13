<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MPY Admin | @yield('tab')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('perpusmu/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('perpusmu/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('perpusmu/vendors/css/vendor.bundle.addons.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('perpusmu/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('perpusmu/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ asset('perpusmu/css/select2.css')}}">
  <link rel="stylesheet" href="{{ asset('perpusmu/css/dataTables.bootstrap4.min.css')}}">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.css" rel="stylesheet" />

  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('uploads/compress/MBVY.ico')}}" />
  <style>

    h1,h2,h3,h4,h5,h6,p{
      word-wrap: break-word;
    }

    #divpass {
      position: relative;
    }
    .form-group i {
      position: absolute;
      top: 35px;
      right: 5px;
      font-size: 20px;
      cursor: pointer;
    }

    @media screen and (max-width: 600px) {
      #hilang{
        display: none;
      }
    }
    @section('css')

    @show
  </style>
</head>
<body onload="startTime()">
    <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @if(auth()->guard()->user()->darkmode == 0)
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: linear-gradient(120deg, #ffffff, #070808);">
    @else
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    @endif
      @if(auth()->guard()->user()->darkmode == 0)
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/admin') }}" style="color: #2d2d2d;">
          <h4 class="mt-3">Museum Perjuangan<br>Yogyakarta</h4>
        </a>
           <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
          <i class="fa fa-align-justify" style="color: #fff;"></i>
        </button>
      </div>
      @else
      <div class="text-center navbar-brand-wrapper-dark d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/admin') }}" style="color: #ffffff">
          <h4 class="mt-3">Museum Perjuangan<br>Yogyakarta</h4>
        </a>
           <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
          <i class="fa fa-align-justify" style="color: #fff;"></i>
        </button>
      </div>
      @endif

      <div class="navbar-menu-wrapper d-flex align-items-center">
        <div class="navbar-nav" id="hilang">
          <h4 class="mt-3 {{ auth()->guard()->user()->darkmode == 0 ? 'text-dark' : '' }}">@yield('hal')</h4>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              @if( auth()->guard()->user()->email == "museumperjuanganjogja@gmail.com" )
                <img class="img-xs rounded-circle" src="{{asset('uploads/superadmin.png')}}" alt="profile image">
              @else
                <img class="img-xs rounded-circle" src="{{asset('uploads/admin.png')}}" alt="profile image">
              @endif
              <span class="profile-text"><strong>More</strong> !</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom mt-3 mr-2 ml-2">
                  <p><b>Username :</b> {{ auth()->guard('admin')->check() ? auth()->guard()->user()->name : 'Account' }}<br>
                  <b>Email :</b> {{ auth()->guard('admin')->check() ? auth()->guard()->user()->email : 'Account' }}</p>
                </div>
              </a>
              <div class="dropdown-item">
                  <form action="/admin/updatedark" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" value="{{ auth()->guard()->user()->id }}">
                    <b class="mr-4"> Dark Mode </b>
                    <input name="darkmode" type="checkbox" data-toggle="toggle" data-on="<span class='fa fa-moon-o'></span>Dark" data-off="<span class='mdi mdi-brightness-5'></span>Default" data-size="small" data-width="100" data-onstyle="outline-light text-white bg-dark" data-offstyle="outline-dark text-black" data-style="border" onChange="this.form.submit()" 
                    {{ auth()->guard()->user()->darkmode ? "checked" : "" }}>
                  </form>
              </div>
              @if( auth()->guard()->user()->email != "museumperjuanganjogja@gmail.com" )
                <a class="dropdown-item btn btn-primary" href="#" data-toggle="modal" data-target="#profilModal">
                  <span class="mdi mdi-account"></span> Profil
                </a>
                <a class="dropdown-item btn btn-primary" href="https://vredeburg.id/berkas/Buku_Panduan_MPY_2020.pdf" target="_blank">
                  <span class="mdi mdi-file-document"></span> Buku Panduan Museum
                </a>
                <a class="dropdown-item btn btn-primary" href="#" data-toggle="modal" data-target="#adminsaveModal">
                  <span class="mdi mdi-archive"></span> Info Penyimpanan
                </a>
              @else
                <a class="dropdown-item btn btn-primary" href="#" data-toggle="modal" data-target="#profilModal">
                  <span class="mdi mdi-account"></span> Profil
                </a>
                <a class="dropdown-item btn btn-primary" href="https://vredeburg.id/berkas/Buku_Panduan_MPY_2020.pdf" target="_blank">
                  <span class="mdi mdi-file-document"></span> Buku Panduan Museum
                </a>
                <a class="dropdown-item btn btn-primary" href="{{ url('/admin/registering') }}">
                  <span class="mdi mdi-account-plus"></span> Tambah Admin Baru
                </a>
                <a class="dropdown-item btn btn-primary" href="#" data-toggle="modal" data-target="#passModal">
                  <span class="mdi mdi-key"></span> Ganti Password
                </a>
                <a class="dropdown-item btn btn-primary" href="#" data-toggle="modal" data-target="#adminsaveModal">
                  <span class="mdi mdi-archive"></span> Info Penyimpanan
                </a>
              @endif
              <a class="dropdown-item" style="margin-top: 10px;" href="{{ url('/') }}">
                 <span class="mdi mdi-web"></span> Halaman User
              </a>
              <a class="dropdown-item" href="{{ url('/admin/logout') }}">
                 <span class="mdi mdi-logout"></span> Logout
              </a>
            </div>
          </li>
        </ul>
     
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @if(auth()->guard()->user()->darkmode == 0)
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            @include('admin.layouts.sidebar')
        </nav>
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('content')

          </div>
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{date('Y')}}
              <a href="https://vredeburg.id/" target="_blank">Museum Benteng Vredeburg Yogyakarta</a>. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      @else
        <nav class="sidebar-dark sidebar sidebar-offcanvas" id="sidebar-dark">
            @include('admin.layouts.sidebar')
        </nav>
        <div class="main-panel">
          <div class="content-wrapper-dark">
            @yield('content')

          </div>
          <footer class="footer-dark">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © {{date('Y')}}
              <a href="https://vredeburg.id/" target="_blank">Museum Benteng Vredeburg Yogyakarta</a>. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      @endif
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script src="{{asset('perpusmu/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('perpusmu/vendors/js/vendor.bundle.addons.js')}}"></script>
  <script src="{{asset('perpusmu/js/off-canvas.js')}}"></script>
  <script src="{{asset('perpusmu/js/misc.js')}}"></script>
  <script src="{{asset('perpusmu/js/dashboard.js')}}"></script>
  <script src="{{asset('perpusmu/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('perpusmu/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('perpusmu/js/sweetalert2.all.js')}}"></script>
  <script src="{{asset('perpusmu/js/select2.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.js"></script>
  
  @section('js')
  
  @show

<div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="passModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="passModalLabel">Ganti Password Master Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="/admin/updatepass" method="post" enctype="multipart/form-data">
            <input type = "hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type = "hidden" name="id" value="{{ auth()->guard()->user()->id }}">
            <div class="form-group" id="divpass">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" onkeyup="check();" placeholder="Masukkan Password" class="form-control border-input" required>
                <i class="fa fa-eye" id="togglePassword"></i>
            </div>
            <div class="form-group">
                <label for="repassword">Verifikasi Password:</label>
                <input type="password" name="repassword" id="repassword" onkeyup="check();" placeholder="Masukkan Password lagi" class="form-control border-input" required>
                <span id="message"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input id="submit" type="submit" class="btn btn-primary" value="Simpan">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="profilModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profilModalLabel">Profil Admin : {{ auth()->guard()->user()->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body align-self-center">
        <div class="card">
          <div class="row">
            <div class="col-md-4">
              <div class="container mt-4">
              @if( auth()->guard()->user()->email == "museumperjuanganjogja@gmail.com" )
                <img src="{{asset('uploads/superadmin.png')}}" alt="profile image" width="175px">
              @else
                <img src="{{asset('uploads/admin.png')}}" alt="profile image" width="175px">
              @endif
              </div>
            </div>
            <div class="col-md-8">
              <div class="card-body mr-4 ml-4">
                <h5 class="card-title">{{ auth()->guard()->user()->name }}</h5><hr>
                <p class="card-text">{{ auth()->guard()->user()->email }}</p><hr>
                <p class="card-text">
                  @if( auth()->guard()->user()->email == "museumperjuanganjogja@gmail.com" )
                    Master Admin
                  @else
                    Admin
                  @endif
                </p><hr>
                <p class="card-text">
                  @if( auth()->guard()->user()->email == "museumperjuanganjogja@gmail.com" )
                    Permission<br>
                    <span class="fa fa-check text-success"> Tambah Data</span><br>
                    <span class="fa fa-check text-success"> Edit Data</span><br>
                    <span class="fa fa-check text-success"> Hapus Data</span><br>
                    <span class="fa fa-check text-success"> Manage Admin</span><br>
                    <span class="fa fa-check text-success"> Edit Gambar Dashboard</span><hr>
                  @else
                    Permission<br>
                    <span class="fa fa-check text-success"> Tambah Data</span><br>
                    <span class="fa fa-check text-success"> Edit Data</span><br>
                    <span class="fa fa-times text-danger"> Hapus Data</span><br>
                    <span class="fa fa-times text-danger"> Manage Admin</span><br>
                    <span class="fa fa-times text-danger"> Edit Gambar Dashboard</span><hr>
                  @endif
                </p>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="adminsaveModal" tabindex="-1" role="dialog" aria-labelledby="adminsaveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adminsaveModalLabel"><span class="mdi mdi-archive"></span> Info Penyimpanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        @php
          $fileskoleksi = File::files(public_path('uploads/image/500/'));
          $filecountkoleksi = 0;
          $filesevent = File::files(public_path('uploads/event/500/'));
          $filecountevent = 0;
          $filesberita = File::files(public_path('uploads/news/500/'));
          $filecountberita = 0;
          $filecounttotal = 0;
          $file_size = 0;

          foreach( File::allFiles(public_path('uploads')) as $file)
          {
            $file_size += $file->getSize();
          }

          $file_size = number_format($file_size / 1048576,2);
        
          if ($fileskoleksi !== false && $filesevent !== false && $filesberita !== false) {
            $filecountkoleksi = count($fileskoleksi);
            $filecountevent = count($filesevent);
            $filecountberita = count($filesberita);
            $filecounttotal = count($fileskoleksi) + count($filesevent) + count($filesberita) + 1;
          }
          echo "Gambar Koleksi = <b>$filecountkoleksi</b> Gambar<br>";
          echo "Gambar Event = <b>$filecountevent</b> Gambar<br>";
          echo "Gambar Berita = <b>$filecountberita</b> Gambar<br>";
          echo "Gambar Dashboard = <b>1</b> Gambar<br><br>";
          echo "Total Seluruh Gambar di Penyimpanan = <b>$filecounttotal</b> Gambar<br>";
          echo "Total Ukuran Seluruh Gambar di Penyimpanan = <b>$file_size</b> MB<br>";
        @endphp

      </div>
    </div>
  </div>
</div>

<script>

  function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('jamNow').innerHTML = today;
    setTimeout(startTime, 1000);
  }

  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }
    
</script>

</body>

</html>