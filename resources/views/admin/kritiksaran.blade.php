@extends('admin.layouts.master')

@section('tab')
    Kritik & Saran
@endsection

@section('hal')
    Kritik & Saran
@endsection

@section('page')
    Kritik & Saran
@endsection

@section('js')

<script type="text/javascript">
    function msgall() {
        var y = document.getElementById("kritFilter");
        var x = document.getElementById("filAll").value;
        y.value = x;
    }
    function msgdas() {
        var y = document.getElementById("kritFilter");
        var x = document.getElementById("filDas").value;
        y.value = x;
    }
    function msgkol() {
        var y = document.getElementById("kritFilter");
        var x = document.getElementById("filKol").value;
        y.value = x;
    }
    function msgber() {
        var y = document.getElementById("kritFilter");
        var x = document.getElementById("filBer").value;
        y.value = x;
    }
    function msgeve() {
        var y = document.getElementById("kritFilter");
        var x = document.getElementById("filEve").value;
        y.value = x;
    }
    function msgsud() {
        var y = document.getElementById("kritFilter");
        var x = document.getElementById("filSud").value;
        y.value = x;
    }
    function msgbel() {
        var y = document.getElementById("kritFilter");
        var x = document.getElementById("filBel").value;
        y.value = x;
    }
    $('#kritikModal').on('show.bs.modal', function (event) {
        var krId = $(event.relatedTarget).data('id');
        var krName = $(event.relatedTarget).data('name');
        var krKritik = $(event.relatedTarget).data('pesan');
        var krTitle = $(event.relatedTarget).data('judul');
        var krEmail = $(event.relatedTarget).data('email');
        var krStatus = $(event.relatedTarget).data('status');
        var krHandler = $(event.relatedTarget).data('handler');
        if($(event.relatedTarget).data('status') == 0){
            krStatus="Belum di review";
        }else{
            krStatus="Telah di review oleh "+krHandler;
        }
        $(this).find(".modal-title").text(krTitle);
        $(this).find(".modal-body .krId").val(krId);
        $(this).find(".modal-body #krID").text("#KS-"+krId);
        $(this).find(".modal-body .krKritik").text(krKritik);
        $(this).find(".modal-body .krName").text(krName);
        $(this).find(".modal-body .krEmail").text(krEmail);
        $(this).find(".modal-body .krStatus").text(krStatus);
    });

    $('#iconsearch').click(function() {
        $(this).toggleClass('badge badge-primary mdi mdi-magnify mr-2');
        $(this).toggleClass('badge badge-danger mdi mdi-minus-circle mr-2');
    });
</script>

@stop

@section('content')
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

    <div class="container mb-4">
        <form action="/admin/filterKritik" method="GET">
            <div class="row">
                <a id="iconsearch" class="badge badge-primary mdi mdi-magnify mr-2" href="#forsearch" data-toggle="collapse" style="font-size: 40px"></a>
                <div id="forsearch" class="collapse mr-2 mt-2">
                    <input name="kritFilter" id="kritFilter" value="">
                    <button type="submit" class="btn btn-primary"><span class="mdi mdi-magnify mdi-spin"></span></button>
                </div>
                <h5 class="bg-secondary text-dark mt-3"><span class="mdi mdi-filter"></span> Filter : </h5>
                <button id="btnFilter" class="btn btn-secondary btnFilter ml-2 mt-2" onclick="msgAll()"><input type="hidden" id="filAll" value="">Semua</button>
                <button id="btnFilter" class="btn btn-secondary btnFilter ml-2 mt-2" onclick="msgdas()"><input type="hidden" id="filDas" value="dashboard">Dashboard</button>
                <button id="btnFilter" class="btn btn-secondary btnFilter ml-2 mt-2" onclick="msgkol()"><input type="hidden" id="filKol" value="koleksi">Koleksi</button>
                <button id="btnFilter" class="btn btn-secondary btnFilter ml-2 mt-2" onclick="msgber()"><input type="hidden" id="filBer" value="berita">Berita</button>
                <button id="btnFilter" class="btn btn-secondary btnFilter ml-2 mt-2" onclick="msgeve()"><input type="hidden" id="filEve" value="event">Event</button>
                <button id="btnFilter" class="btn btn-secondary btnFilter ml-2 mt-2" onclick="msgsud()"><input type="hidden" id="filSud" value="1">Sudah Review</button>
                <button id="btnFilter" class="btn btn-secondary btnFilter ml-2 mt-2" onclick="msgbel()"><input type="hidden" id="filBel" value="0">Belum Review</button>
            </div>
        </form>
    </div>
    
    <div class="row">
        @foreach($kritik as $kr)
        <div class="col-xl-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <div class="row">                            
                                <i class="mdi mdi-comment text-danger icon-lg"></i>
                                <div class="fluid-container ml-4">
                                    <p class="badge badge-secondary text-dark">#KS-{{ $kr->id }}</p><br>
                                    <strong class="font-weight-medium text-right">"{{ $kr->title }}"</strong>
                                </div>
                            </div>
                        </div>
                        <div class="float-right badge badge-secondary text-dark">
                            <p class="mdi mdi-account icon-md"></p>
                            <h5 class="mb-0 text-right">{{ $kr->nama }}</h5>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="float-left mt-4">
                            @if( $kr->status != 0 )
                                <div class="badge badge-pills badge-success">Telah di review<div class="mdi mdi-account"> {{ $kr->handle_by }}</div></div>
                            @else
                                <div class="badge badge-pills badge-danger">Belum di review</div>
                            @endif
                        </div>
                        <div class="float-right mt-2">
                            <a class="badge badge-pills badge-primary text-white" href="#" data-toggle="modal" data-target="#kritikModal" data-id="{{ $kr->id }}" data-name="Nama : {{ $kr->nama }}" data-pesan="{{ $kr->kritik }}" data-judul="Perihal : {{ $kr->title }}" data-status="{{ $kr->status }}" data-email="Email : {{ $kr->email }}" data-handler="{{ $kr->handle_by }}">
                                <i class="mdi mdi-application text-white icon-md"></i><br>
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


<div class="modal fade" id="kritikModal" tabindex="-1" role="dialog" aria-labelledby="kritikModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="kritikModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/updatekritik" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" class="krId" name="id">
            <h5 class="badge badge-secondary text-dark" id="krID"></h5>
            <h5 class="krName"></h5>
            <h5 class="krEmail"></h5><hr>
            <h5 class="krKritik"></h5>
            <div class="modal-footer">
                <h5 class="krStatus badge badge-secondary text-dark"></h5>
                <input id="submit" type="submit" class="btn btn-primary" value="Sudah Review">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
    
@endsection