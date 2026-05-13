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
    Koleksi
@endsection

@section('hal')
    Koleksi Museum
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
    List Koleksi Museum Perjuangan
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-2 mb-3">
                    <a href="{{ url('/admin/koleksi/create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Koleksi</a>
                </div>
                <div class="col-lg-8"></div>
                <div class="right-align">
                    <a href="/koleksi/print" class="btn btn-primary btn-rounded btn-fw" target="_blank"><i class="fa fa-print"></i>Preview PDF</a>
                </div>
            </div>

            @include('admin.layouts.message')

            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <div class="row">
                            <h4 class="col-md-9 title">Koleksi</h4>
                            <p class="category" id="hilang">
                                <span class="badge badge-success">O</span> Koleksi Tampil di Dashboard
                            </p>
                        </div>
                        <div class="row">
                            <p class="col-md-9 category">List dari koleksi museum</p>
                            <p class="category" id="hilang">
                                <span class="badge badge-danger">O</span> Koleksi tidak Tampil di Dashboard
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Gambar</th>
                                    <th>Nama<br>Koleksi</th>
                                    <th>Deskripsi</th>
                                    <th>Sejarah</th>
                                    <th>Lantai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($koleksi as $koleksi)
                            <tr>
                                <td>K-{{ $koleksi->id }}</td>
                                <td>
                                    @if($koleksi->slide == '1')
                                        <span class="badge badge-success">O</span>
                                    @else
                                        <span class="badge badge-danger">O</span>
                                    @endif
                                    <a href="{{ url('uploads').'/image/500/'. $koleksi->image }}" data-toggle="lightbox" data-gallery="gallery" data-title="{{ $koleksi->name }}" data-footer="<p>Sejarah Singkat: {{ $koleksi->sejarah }}</p>">
                                        <img src="{{ url('uploads').'/image/500/'. $koleksi->image }}" alt="{{ $koleksi->image }}" style="width:50px;" class="img-thumbnail">
                                    </a>
                                </td>
                                <td>{{ $koleksi->name }}</td>
                                <td>{{ $koleksi->description }}</td>
                                <td>{{ $koleksi->sejarah }}</td>
                                <td>{{ $koleksi->lantai }}</td>
                                <td>

                                    {{ Form::open(['route' => ['koleksi.destroy', $koleksi->id], 'method'=>'DELETE']) }}
                                        {{ link_to_route('koleksi.show','', $koleksi->id, ['class' => 'btn btn-primary btn-sm mdi mdi-eye']) }}
                                        {{ link_to_route('koleksi.edit','', $koleksi->id, ['class' => 'btn btn-info btn-sm fa fa-pencil']) }}
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