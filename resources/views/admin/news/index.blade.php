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
    Berita
@endsection

@section('hal')
    Berita Museum
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
    List Berita Museum Perjuangan
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-2 mb-3">
                    <a href="{{ url('/admin/news/create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Berita</a>
                </div>
                <div class="col-lg-8"></div>
                <div class="right-align">
                    <a href="/news/print" class="btn btn-primary btn-rounded btn-fw" target="_blank"><i class="fa fa-print"></i>Preview PDF</a>
                </div>
            </div>

            @include('admin.layouts.message')

            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <h4 class="title">Berita</h4>
                        <p class="category">List dari berita museum</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead class="bg-dark text-white">
                            <tr>
                                <th>ID</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Konten</th>
                                <th>Diedit Oleh</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($news as $news)
                            <tr>
                                <td>B-{{ $news->id }}</td>
                                <td>
                                    <a href="{{ url('uploads').'/news/500/'. $news->image }}" data-toggle="lightbox" data-gallery="gallery" data-title="{{ $news->title }}<br><p>oleh {{ $news->created_by }}<p>">
                                        <img src="{{ url('uploads').'/news/500/'. $news->image }}" alt="{{ $news->image }}" style="width:50px;" class="img-thumbnail">
                                    </a>
                                </td>
                                <td>{{ $news->title }}</td>
                                <td>{{ $news->content }}</td>
                                <td>{{ $news->created_by }}</td>
                                <td>

                                    {{ Form::open(['route' => ['news.destroy', $news->id], 'method'=>'DELETE']) }}
                                        {{ link_to_route('news.show','', $news->id, ['class' => 'btn btn-primary btn-sm mdi mdi-eye']) }}
                                        {{ link_to_route('news.edit','', $news->id, ['class' => 'btn btn-info btn-sm fa fa-pencil']) }}
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