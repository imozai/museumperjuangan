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
    Detail Koleksi
@endsection

@section('hal')
    Detail Koleksi
@endsection


@section('page')
    Details Koleksi
@endsection

@section('content')

<div class="row">

    <div class="col-md-12 align-items-stretch grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="header">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="title">Detail Koleksi 
                                <br><p class="category">Detail dari koleksi museum perjuangan</p>
                            	@if( $koleksi->slide == 1 )
                            		<span class="badge badge-success badge-pill mb-4">Tampil</span>
                            	@else
                            		<span class="badge badge-danger badge-pill mb-4">Tidak Tampil</span>
                            	@endif
                            	<br>
                                <a href="{{ url('/admin/koleksi') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-backburger"></i> Kembali</a>
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('uploads').'/image/500/'. $koleksi->image }}" data-toggle="lightbox" data-gallery="gallery" data-title="{{ $koleksi->name }}" data-footer="<a href='{{ url('uploads').'/image/500/'. $koleksi->image }}' target='_blank'>Gambar Penuh</a>">
                                <img src="{{ url('uploads/image/500') . '/'. $koleksi->image}}" alt="" class="img-thumbnail mb-2" style="width: 350px;">
                            </a>
                        </div>
                        <div class="col-md-2">
                            @if(auth()->guard('admin')->user()->email == "museumperjuanganjogja@gmail.com")
                                {{ Form::open(['route' => ['koleksi.destroy', $koleksi->id], 'method'=>'DELETE']) }}
                                    {{ Form::button('<span class="fa fa-trash"> Hapus</span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Are you sure you want to delete this?")'])  }}
                                    {{ link_to_route('koleksi.edit',' Edit', $koleksi->id, ['class' => 'btn btn-info btn-sm fa fa-pencil']) }}
                                {{ Form::close() }}
                            @else
                                {{Form::open()}}
                                    {{ link_to_route('koleksi.edit',' Edit', $koleksi->id, ['class' => 'btn btn-info btn-sm fa fa-pencil']) }}
                                {{Form::close()}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card align-items-center mt-4"> 
                    <div>
                        <h5>{{ $koleksi->name }}<hr></h5>
                    </div>
                </div>
                <table class="table table-responsive table-stripped">
                    <tbody>
                        
                        <tr>
                            <th>Lokasi</th>
                            <td>Lantai {{ $koleksi->lantai }}</td>
                        </tr>

                        <tr>
                            <th>Dibuat Pada</th>
                            <td><span class="mdi mdi-clock"></span> {{$koleksi->created_at}} WIB<br><strong>{{ $koleksi->created_at->diffForHumans() }}</strong></td>
                        </tr>

                        <tr>
                            <th>Terakhir diedit pada</th>
                            <td>
                            	<span class="mdi mdi-clock"></span> {{$koleksi->updated_at}} WIB<br>
                            	<strong>{{ $koleksi->updated_at->diffForHumans() }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="container">
                    <div class="card align-items-center">
                        <strong>Sejarah Singkat Koleksi</strong>
                        <p>{{ $koleksi->sejarah }}</p>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div class="card align-items-center">
                        <strong>Deskripsi Koleksi</strong>
                        <p>{{ $koleksi->description }}</p>
                    </div>
                </div>
                <hr>
                <a href="{{ url( 'admin/koleksi/' . $previous ) }}"><span class="mdi mdi-skip-previous"></span> Data Sebelumnya</a>
                <a class="pull-right" href="{{ url( 'admin/koleksi/' . $next ) }}">Data Selanjutnya <span class="mdi mdi-skip-next"></span></a>
            </div>
        </div>
    </div>
</div>
@endsection