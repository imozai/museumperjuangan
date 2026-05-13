@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

  });
  $(document).on("click", '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
        alwaysShowClose: true
    });
  });
</script>
@stop

@extends('admin.layouts.master')

@section('tab')
    Event
@endsection

@section('hal')
    Event Museum
@endsection

@section('css')
    td{
      max-width: 100px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
@endsection

@section('page')
    List Event Museum Perjuangan
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
        	<div class="row">
            	<div class="col-lg-2 mb-3">
                	<a href="{{ url('/admin/event/create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Event</a>
            	</div>
            	<div class="col-lg-8"></div>
            	<div class="right-align">
            		<a href="/event/print" class="btn btn-primary btn-rounded btn-fw" target="_blank"><i class="fa fa-print"></i>Preview PDF</a>
            	</div>
        	</div>

            @include('admin.layouts.message')

            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <div class="row">
                            <h4 class="col-md-9 title">Event</h4>
                            <u class="category" id="hilang">
                                Info Status
                            </u>
                        </div>
                        <div class="row">
                            <p class="col-md-9 category">List dari Event museum</p>
                            <p class="category" id="hilang">
                                <span class="badge badge-success">Berlangsung</span> Event sedang berlangsung<br>
                                <span class="badge badge-primary">Segera</span> Event akan segera berlangsung <br>
                                <span class="badge badge-danger">Berakhir</span> Event telah berakhir
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead class="bg-dark text-white">
                            <tr>
                                <th>ID</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th>Judul</th>
                                <th>Konten</th>
                                <th>Tanggal<br>Mulai(WIB)</th>
                                <th>Diedit<br>Oleh</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($event as $event)
                            <tr>
                                <td>E-{{ $event->id }}</td>
                                <td>
                                    <a href="{{ url('uploads').'/event/500/'. $event->image }}" data-toggle="lightbox" data-gallery="gallery" data-title="{{ $event->title }}<br><p>oleh {{ $event->created_by }}<p>" data-footer="Mulai pada {{ $event->tgl_mulai }} - {{ $event->tgl_selesai }}">
                                        <img src="{{ url('uploads').'/event/500/'. $event->image }}" alt="{{ $event->image }}" style="width:50px;" class="img-thumbnail">
                                    </a>
                                </td>
                                <td>
                                    @php
                                        $today = date('Y-m-d H:i');
                                        $today=date('Y-m-d H:i', strtotime($today));

                                        $stratDate = date('Y-m-d H:i', strtotime($event->tgl_mulai));
                                        $endDate = date('Y-m-d H:i', strtotime($event->tgl_selesai));

                                        if (($today >= $stratDate) && ($today <= $endDate)){
                                            echo '<span class="badge badge-success">Berlangsung</span>';
                                        }else if($today <= $stratDate){
                                            echo '<span class="badge badge-primary">Segera</span>';
                                        }else{
                                            echo '<span class="badge badge-danger">Berakhir</span>';
                                        }
                                    @endphp
                                </td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->content }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($event->tgl_mulai)) }}</td>
                                <td>{{ $event->created_by }}</td>
                                <td>

                                    {{ Form::open(['route' => ['event.destroy', $event->id], 'method'=>'DELETE']) }}
                                        {{ link_to_route('event.show','', $event->id, ['class' => 'btn btn-primary btn-sm mdi mdi-eye']) }}
                                        {{ link_to_route('event.edit','', $event->id, ['class' => 'btn btn-info btn-sm fa fa-pencil']) }}
                                        @if(auth()->guard('admin')->user()->email == "museumperjuanganjogja@gmail.com")
                                            {{ Form::button('<span class="fa fa-trash"></span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Anda yakin ingin menghapus data ini ?")'])  }}
                                        @else
                                        @endif
                                    {{ Form::close() }}

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection