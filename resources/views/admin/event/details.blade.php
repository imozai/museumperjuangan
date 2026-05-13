@section('js')
<script type="text/javascript">
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
    Detail Event
@endsection

@section('hal')
    Detail Event
@endsection

@section('page')
    Details Event
@endsection

@section('css')

    .table .table-stripped{
      word-wrap: break-word;
    }

@endsection

@section('content')

<div class="row">

    <div class="col-md-12 align-items-stretch grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="header">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="title">Detail Event
                                <br><p class="category">Detail dari event museum perjuangan</p>
                                <a href="{{ url('/admin/event') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-backburger"></i> Kembali</a>
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('uploads').'/event/500/'. $event->image }}" data-toggle="lightbox" data-gallery="gallery" data-title="{{ $event->title }}" data-footer="<a href='{{ url('uploads').'/event/500/'. $event->image }}' target='_blank'>Gambar Penuh</a>">
                                <img src="{{ url('uploads/event/500') . '/'. $event->image}}" alt="" class="img-thumbnail mb-2" style="width: 350px;">
                            </a>
                        </div>
                        <div class="col-md-2">
                            @if(auth()->guard('admin')->user()->email == "museumperjuanganjogja@gmail.com")
                                {{ Form::open(['route' => ['event.destroy', $event->id], 'method'=>'DELETE']) }}
                                    {{ Form::button('<span class="fa fa-trash"> Hapus</span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Are you sure you want to delete this?")'])  }}
                                    {{ link_to_route('event.edit',' Edit', $event->id, ['class' => 'btn btn-info btn-sm fa fa-pencil']) }}
                                {{ Form::close() }}
                            @else
                                {{Form::open()}}
                                    {{ link_to_route('event.edit',' Edit', $event->id, ['class' => 'btn btn-info btn-sm fa fa-pencil']) }}
                                {{Form::close()}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card align-items-center mt-4"> 
                    <div>
                        <h5>{{ $event->title }}<hr></h5>
                    </div>
                </div>
                <div>
                    <table class="table table-stripped table-responsive">
                        <tbody>
                        

                        <tr>
                            <th>Tempat Berlangsung Event</th>
                            <td>{{ $event->tempat }}</td>
                        </tr>

                        <tr>
                            <th>Tanggal Mulai</th>
                            <td>{{ $event->tgl_mulai }} WIB</td>
                        </tr>

                        <tr>
                            <th>Tanggal Berakhir</th>
                            <td>{{ $event->tgl_selesai }} WIB</td>
                        </tr>

                        <tr>
                            <th>Durasi Event</th>
                            <td>
                                @php
                                    $datediff = strtotime($event->tgl_mulai) - strtotime($event->tgl_selesai);
                                    $jarak = round($datediff / (60 * 60 * 24)) / -1;
                                    
                                        echo "<p>$jarak Hari </p>";

                                @endphp
                            </td>
                        </tr>

                        <tr>
                            <th>Status Event</th>
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
                        </tr>

                        <tr>
                            <th>Diedit Oleh</th>
                            <td>{{ $event->created_by }}</td>
                        </tr>

                        <tr>
                            <th>Dibuat Pada</th>
                            <td><span class="mdi mdi-clock"></span> {{$event->created_at}} WIB<br><strong>{{ $event->created_at->diffForHumans() }}</strong></td>
                        </tr>

                        <tr>
                            <th>Terakhir diedit pada</th>
                            <td><span class="mdi mdi-clock"></span> {{$event->updated_at}} WIB<br><strong>{{ $event->updated_at->diffForHumans() }}</strong></td>
                        </tr>

                        </tbody>
                    </table>
                    <hr>
                    <div class="container">
                        <div class="card align-items-center">
                            <strong>Isi</strong>
                            <p>{{ $event->content }}</p>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ url( 'admin/event/' . $previous ) }}"><span class="mdi mdi-skip-previous"></span> Data Sebelumnya</a>
                    <a class="pull-right" href="{{ url( 'admin/event/' . $next ) }}">Data Selanjutnya <span class="mdi mdi-skip-next"></span></a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection