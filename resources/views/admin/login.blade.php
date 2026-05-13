<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Admin Museum | Login</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <link rel="shortcut icon" href="{{asset('uploads/compress/MBVY.ico')}}" />

    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>

    <link href="{{ url('assets/css/animate.min.css') }}" rel="stylesheet"/>

    <link href="{{ url('assets/css/paper-dashboard.css') }}" rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset('perpusmu/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">

    <link href="{{ url('http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href='{{ url('https://fonts.googleapis.com/css?family=Muli:400,300') }}' rel='stylesheet' type='text/css'>

    <link href="{{ url('assets/css/themify-icons.css') }}" rel="stylesheet">

    <style type="text/css">
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
        .outlinetitle {
            color: black;
            text-shadow: -1px -1px 0 #FFF, 1px -1px 0 #FFF, -1px 1px 0 #FFF, 1px 1px 0 #FFF;
        }  
    </style>

</head>

<body>
<div class="wrapper" style="overflow: auto; position: absolute; top: 0; bottom: 0; left: 0; right: 0;">
    <div style="background: url('{{ asset('uploads/compress/dashboard.jpg')}}'); background-size:cover; position: relative; border-radius: 5%; filter: blur(8px);
        -webkit-filter: blur(8px); position: fixed; top: 0; bottom: 0; left: 0; right: 0; z-index: -1;">
    </div>
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 mx-auto">
                <center><h3 class="outlinetitle">Login Admin<br>
                    <b>Museum Perjuangan Yogyakarta
                </b></h3></center>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 mx-auto">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Masuk Sebagai Admin</strong></h3>
                    </div>

                    <div class="panel-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if ( session()->has('msg') )
                            <div class="alert alert-success">{{ session()->get('msg') }}</div>
                        @endif


                        <form method="post" action="/admin/login">

                            @csrf

                            <div class="form-group">
                                <label for="email"><span class="mdi mdi-at"></span> Email:</label>
                                <input type="email" name="email" id="email" placeholder="Masukkan Email"
                                       class="form-control border-input">
                            </div>

                            <div class="form-group" id="divpass">
                                <label for="password"><span class="mdi mdi-key"></span> Password:</label>
                                <input type="password" name="password" id="password" placeholder="Masukkan Password"
                                       class="form-control border-input">
                                <i class="fa fa-eye" id="togglePassword"></i>
                            </div>

                            <div class="form-group">
                                <a class="btn btn-default pull-left" href="{{ url('/') }}">Halaman User</a>
                                <button class="btn btn-success pull-right" type="submit"><span class="mdi mdi-login"></span> Masuk</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function (e) {

        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        this.classList.toggle('fa-eye-slash');
    });
</script>

</body>

</html>