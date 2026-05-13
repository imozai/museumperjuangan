@section('js')
    <script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        var check = function(){
            if (document.getElementById('password').value != document.getElementById('repassword').value) {
                document.getElementById('submit').disabled = true;
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Password Tidak Cocok !';   
            }
            else if(/(?=.*\d)(?=.*[a-z]).{8,}/.test(document.getElementById('password').value) == false){
                document.getElementById('submit').disabled = true;
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Password Harus lebih dari 8 character dan harus kombinasi huruf dan angka !';
            }
            else {
                document.getElementById('submit').disabled = false;
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'Password Cocok !';
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        });

        $(document).on("click", '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
        $(document).ready(function() {
            $('#passModalAdmin').on('shown', function(){
                var togglePassword = document.getElementById('#togglePassword');
                var password = document.getElementById('#password');
                var repassword = document.getElementById('#repassword');
                togglePassword.addEventListener('click', function (e) {

                    var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    var retype = repassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    repassword.setAttribute('type', retype);

                    this.classList.toggle('fa-eye-slash');
                });

                $('#passModalAdmin').on('shown', function(){
                  alert('Hello World');
                });
            });

           
            

            $(document).on('click', "#togglePassword", function() {
                var x = document.getElementById("password");
                var y = document.getElementById("repassword");
                if (x.type === "password" || y.type === "repassword") {
                    x.type = "text";
                    y.type = "text";
                    $(this).removeClass('fa fa-eye');
                    $(this).addClass('fa fa-eye-slash');
                } else {
                    x.type = "password";
                    y.type = "password";
                    $(this).removeClass('fa fa-eye-slash');
                    $(this).addClass('fa fa-eye');
                }
            });

            $(document).on('click', "#pass-btn", function() {
                $(this).addClass('pass-btn-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

                var options = {
                  'backdrop': 'static'
                };
                $('#passModalAdmin').modal(options)
            });

              // on modal show
            $('#passModalAdmin').on('show.bs.modal', function() {
                var el = $(".pass-btn-trigger-clicked"); // See how its usefull right here? 
                var row = el.closest(".data-row");

                // get the data
                var id = el.data('item-id');
                var name = el.data("item-name");
                $('#editFormAdmin').attr('action', '/admin/edit/'+id);

                // fill the data in the input fields
                $("#modal-edit-id").val(id);
                document.getElementById("modal-edit-name").innerHTML = "Ganti Password Admin <b>"+name;
            });

              // on modal hide
              $('#passModalAdmin').on('hide.bs.modal', function() {
                $('.pass-btn-trigger-clicked').removeClass('pass-btn-trigger-clicked')
                $("#editFormAdmin").trigger("reset");
            });

                //DELETE MODAL ADMIN


            $(document).on('click', "#delete-btn", function() {
                $(this).addClass('delete-btn-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

                var options = {
                  'backdrop': 'static'
                };
                $('#deleteModalAdmin').modal(options)
            });

              // on modal show
            $('#deleteModalAdmin').on('show.bs.modal', function() {
                var el = $(".delete-btn-trigger-clicked"); // See how its usefull right here? 
                var row = el.closest(".data-row");

                // get the data
                var id = el.data('item-id');
                var name = el.data("item-name");
                $('#deleteFormAdmin').attr('action', '/admin/delete/'+id);

                // fill the data in the input fields
                $("#modal-delete-id").val(id);
                document.getElementById("modal-delete-name").innerHTML = "Konfirmasi Hapus Admin <b>"+name+" ?";

            });

              // on modal hide
            $('#deleteModalAdmin').on('hide.bs.modal', function() {
                $('.delete-btn-trigger-clicked').removeClass('delete-btn-trigger-clicked')
                $("#deleteFormAdmin").trigger("reset");
            });
        });
    </script>
@stop

@extends('admin.layouts.master')

@section('css')
    .dark-theme {
      color: white;
      background: black;
    }

    #btedit{
        position: absolute; font-size: 24px; top: 10%; left: 90%; border-radius: 20%; border-width: 3px; border-color: white;
    }

    #bteye{
        position: absolute; font-size: 24px; top: 10%; left: 80%; border-radius: 20%; border-width: 3px; border-color: white;
    }

    #brForMobile{
        display: none;
    }

    @media screen and (max-width: 580px) {
      #btedit{
        position: absolute;
        left : 75%;
      }
      #bteye{
        position: absolute;
        left : 50%;
      }
      #brForMobile{
        display: block;
      }
    }
@endsection

@section('tab')
    Dashboard
@endsection

@section('hal')
    Dashboard
@endsection

@section('page')
    Dashboard
@endsection

@section('content')

<div class="jumbotron jumbotron-fluid" style="background: url('{{ asset('uploads/compress/dashboard.jpg')}}'); background-size:contain; position: relative; border-radius: 5%;">
  <div class="container">
    @if( auth()->guard('admin')->user()->email == "museumperjuanganjogja@gmail.com" )
    <button id="btedit" type="submit" class="btn btn-success" data-toggle="modal" data-target="#dashModal">
        <span class="mdi mdi-pencil"></span>
    </button>
    @else
    @endif
    <a id="bteye" href="{{ url('uploads/compress/dashboard.jpg') }}" class="btn btn-primary" data-toggle="lightbox" data-gallery="gallery" data-title="Lihat Gambar Dashboard">
        <span class="mdi mdi-eye"></span>
    </a>
    <h1 class="text-white">Gambar<br>Dashboard<br><p>1920x800px (ukuran direkomendasikan)</p></h1>
  </div>
</div>

    @if ( session()->has('msg') )
        @if(auth()->guard()->user()->darkmode == 0)
        <div class="alert alert-success alert-dismissible border border-dark">
            {{ session()->get('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @else
        <div class="alert alert-success alert-dismissible border border-light">
            {{ session()->get('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    @endif

    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-poll-box text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Kunjungan Web</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ auth()->guard('admin')->user()->view_userpage }} x</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Orang yang Mengunjungi Web
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-folder-lock text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Koleksi</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $koleksi->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Data Koleksi
                        <a class="mdi mdi-eye" href="{{ url('/admin/koleksi') }}"><i class="ti-panel"></i> Selengkapnya</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-library-books text-primary icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Berita</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $news->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Data Berita
                        <a class="mdi mdi-eye" href="{{ url('/admin/berita') }}"><i class="ti-panel"></i> Selengkapnya</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-calendar text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Event</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $event->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Data Event
                        <a class="mdi mdi-eye" href="{{ url('/admin/event') }}"><i class="ti-panel"></i> Selengkapnya</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================================================================================================================== -->

    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            -<i class="mdi mdi-folder-lock text-info icon-lg"></i>-
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Highlight Koleksi</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $koleksis->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Koleksi Tampil di Halaman Utama User
                        <a class="mdi mdi-arrow-down-bold-circle" href="#info" data-toggle="collapse"><i class="ti-info"></i> Details</a>
                    </p>
                    <div id="info" class="collapse row">
                        <div class="col-md-12 mt-2">
                            <table>
                            @foreach($koleksis as $kl)
                                <tbody class="badge badge-secondary text-dark">
                                
                            
                                    <td><img src="{{ url('uploads').'/image/500/'. $kl->image }}" alt="{{ $kl->image }}" style="width:40px; border-radius: 30%;"></td>
                                    <td class="border-left border-right"><p class="ml-2 mr-2">{{ $kl->name }}</p></td>
                                    <td class="badge badge-pill badge-dark text-white"><p class="mt-2">Terakhir Edit<br>{{ $kl->updated_at }}</p></td>
                            
                        
                                </tbody>
                            @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            -<i class="mdi mdi-bell-ring text-dark icon-lg"></i>-
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Event Akan Berlangsung</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $events->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total Event yang akan datang
                        <a class="mdi mdi-arrow-down-bold-circle" href="#info2" data-toggle="collapse"><i class="ti-info"></i> Details</a>
                    </p>
                    <div id="info2" class="collapse row">
                        <div class="col-md-12 mt-2">
                            <table>
                            @foreach($events as $ev)
                                <tbody class="badge badge-secondary text-dark">
                                
                           
                                    <td><img src="{{ url('uploads').'/event/500/'. $ev->image }}" alt="{{ $ev->image }}" style="width:40px; border-radius: 30%;"></td>
                                    <td class="border-left border-right"><p>{{ $ev->title }}</p></td>
                                    <td class="badge badge-pill badge-dark text-white"><p class="mt-2">Mulai Pada<br>{{ $ev->tgl_mulai }}</p></td>
                            
        
                                </tbody>
                            @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            -<i class="mdi mdi-account-multiple text-danger icon-lg"></i>-
                            <a href="/admin/print" class="badge badge-primary badge-pill ml-4 mt-4 icon-md" target="_blank"><i class="fa fa-print"></i> Print Daftar Admin</a>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Daftar Admin</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $adminuser->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Total akun admin museum
                        <a class="mdi mdi-arrow-down-bold-circle" href="#info3" data-toggle="collapse"><i class="ti-info"></i> Details</a>
                    </p>
                    <div id="info3" class="collapse row">
                        <div class="col-md-12 mt-2 mx-auto">
                            <table>
                            @foreach($adminuser as $ev)
                            <center>
                                <tbody class="badge badge-secondary text-dark mx-auto">

                                    <tr>
                                        @if( $ev->email != "museumperjuanganjogja@gmail.com" )
                                            <td>
                                                @if ( $ev->email == auth()->guard('admin')->user()->email )
                                                    <p class="mdi mdi-account"><span class="badge badge-pill badge-success"> O</span> {{ $ev->name }}</p>
                                                @else
                                                    <p class="mdi mdi-account"><span class="badge badge-pill badge-danger"> O</span> {{ $ev->name }}</p>
                                                @endif
                                            </td>
                                        @else
                                            <td>
                                                @if ( $ev->email == auth()->guard('admin')->user()->email )
                                                    <p class="mdi mdi-account">
                                                        <span class="badge badge-pill badge-success">O </span> {{ $ev->name }} <span class="badge badge-primary">Master</span>
                                                    </p>
                                                @else
                                                    <p class="mdi mdi-account">
                                                        <span class="badge badge-pill badge-danger">O </span> {{ $ev->name }} <span class="badge badge-primary">Master</span>
                                                    </p>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <div class="row">
                                            <td class="badge badge-pill badge-dark text-white"><p class="mt-2">{{ $ev->email }}</p></td>
                                            @if( $ev->email != "museumperjuanganjogja@gmail.com" && auth()->guard('admin')->user()->email == "museumperjuanganjogja@gmail.com" )
                                                <td class="ml-2"><button type="button" class="badge badge-primary" id="pass-btn" data-item-id="{{ $ev->id }}" data-item-name="{{ $ev->name }}"><span class="mdi mdi-pencil icon-sm"></span></button></td>
                                                <td class="ml-2"><button type="button" class="badge badge-danger" id="delete-btn" data-item-id="{{ $ev->id }}" data-item-name="{{ $ev->name }}"><span class="mdi mdi-delete icon-sm"></span></button></td>
                                            @else
                                            @endif
                                        </div>
                                    </tr>
                                    <tr>
                                        @if( $ev->login_at == '' )
                                        <td><p class="mdi mdi-information mt-2">Belum ada login</p></td>
                                        @else
                                        <td><p class="mdi mdi-clock mt-2">Terakhir Login {{ $ev->login_at }} WIB</p></td>
                                        @endif
                                    </tr>
        
                                </tbody>

                            </center>
                            @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card card-statistics rounded">
                <div class="card-body">
                    <div class="float-left">
                        <div class="row">
                            <i class="mdi mdi-comment-multiple-outline text-danger icon-lg"></i>
                            <strong class="mt-3 ml-2"> Kritik dan Saran</strong>
                        </div>
                    </div>

                    <center>
                        <h5 class="font-weight-medium text-center mt-3">Total Kritik dan Saran :<b class="icon-md"> {{ $kritik->count() }} </b>Laporan</h5>
                    </center>

                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ url('/admin/kritik') }}"><span class="mdi mdi-file"></span>Daftar Kritik & Saran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="dashModal" tabindex="-1" role="dialog" aria-labelledby="dashModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dashModalLabel">Edit Gambar Dashboard</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dashboardedit" method="post" enctype="multipart/form-data">
            <input type = "hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
                <label for="gambar" class="col-md-4 control-label">Gambar</label>
                <div class="col-md-6">
                    <img width="300" height="200" />
                    <input type="file" class="uploads form-control" style="margin-top: 20px;" name="image">
                </div>
                <p class="col-md-12 control-label text-danger">*Ukuran Gambar akan di compress<br>*Rekomendasi Ukuran 1920x800px</p>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="pakai" value="1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="passModalAdmin" tabindex="-1" role="dialog" aria-labelledby="passModalAdminLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passModalAdminLabel">Ganti Password Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editFormAdmin" method="post" enctype="multipart/form-data">
                    <label id="modal-edit-name" name="name"></label>
                    <input type ="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" id="modal-edit-id" name="id">
                    <div class="form-group" id="divpass">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan Password" onkeyup="check();" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Password harus minimal 8 karakter dan harus menyertakan huruf dan angka" class="form-control border-input" required>
                        <i class="fa fa-eye" id="togglePassword"></i>
                    </div>
                    <div class="form-group">
                        <label for="repassword">Verifikasi Password:</label>
                        <input type="password" name="repassword" id="repassword" placeholder="Masukkan Password lagi" onkeyup="check();" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Password harus minimal 8 karakter dan harus menyertakan huruf dan angka" class="form-control border-input" required>
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

<div class="modal fade" id="deleteModalAdmin" tabindex="-1" role="dialog" aria-labelledby="passModalAdminLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passModalAdminLabel">Hapus Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deleteFormAdmin" method="post" enctype="multipart/form-data">
                    <label id="modal-delete-name" name="name"></label>
                    <input type ="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type ="hidden" id="modal-delete-id" name="id">
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <input id="submit" type="submit" class="btn btn-danger" value="Hapus">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection