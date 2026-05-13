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
    Detail Berita
@endsection

@section('hal')
    Detail Berita
@endsection


@section('page')
    Details Berita
@endsection

@section('content')

<div class="row">

    <div class="col-md-12 align-items-stretch grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="header">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="title">Detail Berita
                                <br><p class="category">Detail dari berita museum perjuangan</p>
                                <a href="{{ url('/admin/news') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-backburger"></i> Kembali</a>
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('uploads').'/news/500/'. $news->image }}" data-toggle="lightbox" data-gallery="gallery" data-title="{{ $news->title }}" data-footer="<a href='{{ url('uploads').'/news/500/'. $news->image }}' target='_blank'>Gambar Penuh</a>">
                                <img src="{{ url('uploads/news/500') . '/'. $news->image}}" alt="" class="img-thumbnail mb-2" style="width: 350px;">
                            </a>
                        </div>
                        <div class="col-md-2">
                            @if(auth()->guard('admin')->user()->email == "museumperjuanganjogja@gmail.com")
                                {{ Form::open(['route' => ['news.destroy', $news->id], 'method'=>'DELETE']) }}
                                    {{ Form::button('<span class="fa fa-trash"> Hapus</span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Are you sure you want to delete this?")'])  }}
                                    {{ link_to_route('news.edit',' Edit', $news->id, ['class' => 'btn btn-info btn-sm fa fa-pencil']) }}
                                {{ Form::close() }}
                            @else
                                {{Form::open()}}
                                    {{ link_to_route('news.edit',' Edit', $news->id, ['class' => 'btn btn-info btn-sm fa fa-pencil']) }}
                                {{Form::close()}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card align-items-center mt-4"> 
                    <div>
                        <h5>{{ $news->title }}<hr></h5>
                    </div>
                </div>
                <div class="table ">
                    <table class="table table-responsive table-stripped">
                        <tbody>
                    
                        <tr>
                            <th>Diedit Oleh</th>
                            <td>{{ $news->created_by }}</td>
                        </tr>

                        <tr>
                            <th>Dibuat Pada</th>
                            <td><span class="mdi mdi-clock"></span> {{$news->created_at}} WIB<br><strong>{{ $news->created_at->diffForHumans() }}</strong></td>
                        </tr>

                        <tr>
                            <th>Terakhir diedit pada</th>
                            <td><span class="mdi mdi-clock"></span> {{$news->updated_at}} WIB<br><strong>{{ $news->updated_at->diffForHumans() }}</strong></td>
                        </tr>

                        </tbody>
                    </table>
                    <hr>
                    <div class="container">
                        <div class="card align-items-center">
                            <strong>Isi Berita</strong>
                            <p>{{ $news->content }}</p>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ url( 'admin/news/' . $previous ) }}"><span class="mdi mdi-skip-previous"></span> Data Sebelumnya</a>
                    <a class="pull-right" href="{{ url( 'admin/news/' . $next ) }}">Data Selanjutnya <span class="mdi mdi-skip-next"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection