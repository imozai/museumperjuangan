@extends('front.layouts.master')

@section('css')

th{
    float:left;
}

td{
    float:right;
}

@endsection

@section('content')

<div class="container rounded">
    <div class="row d-flex justify-content-center">
        <div class="menu-content" id="boxshadow">
            <div class="title text-center">

                <div class="container text-center mt-4 mb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h3 class="title">Koleksi {{ $koleksi->name }} <a class="float-right secondary-btn mt-2 mb-4" href="{{ url()->previous() }}">Kembali</a> </h3>
                            </div>
                            <div class="container">
                                <div class="content table-responsive">
                                    <table class="table table-striped">
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <a data-toggle="modal" data-target="#detailsModal" class="text-center">
                                                        <img src="{{ url('uploads/image/500') . '/'. $koleksi->image}}" alt="" class="img-thumbnail" style="width: 500px;">
                                                    </a>
                                                </td>
                                            </tr>


                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $koleksi->name }}</td>
                                            </tr>

                                            <tr>
                                                <th>Sejarah Singkat</th>
                                                <td><p>{{ $koleksi->sejarah }}</p></td>
                                            </tr>

                                            <tr>
                                                <th>Description</th>
                                                <td><p>{{ $koleksi->description }}</p></td>
                                            </tr>

                                            <tr>
                                                <th>Lantai</th>
                                                <td>{{ $koleksi->lantai }}</td>
                                            </tr>

                                            <tr>
                                                <th>Data Update Pada</th>
                                                <td>{{ date('d-F-Y H:i',strtotime($koleksi->updated_at)) }} WIB<br>( {{ $koleksi->updated_at->diffForHumans() }} )</td>
                                            </tr>

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                            
        </div>
    </div>
</div>

<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-white" id="detailsModalLabel"><i class="fa fa-photo"></i> Image of {{ $koleksi->name }}</h5>
        <button type="button" class="close bg-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="{{ url('uploads/image/500') . '/'. $koleksi->image}}" alt="" class="img-thumbnail" width="100%">
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</div>
@endsection