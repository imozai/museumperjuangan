@extends('admin.layouts.master')

@section('page')
    Edit Berita
@endsection

@section('tab')
    Edit Berita
@endsection

@section('hal')
    Edit Berita
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('admin.layouts.message')
            
                            <h4 class="title">Update Data Berita</h4>

                            <div class="content">
                            {!! Form::open(['url' => ['admin/news', $news->id], 'files'=>'true', 'method'=>'put']) !!}
                                <div class="row">
                                    <div class="col-md-12">
                                    @include('admin.news._fields')
                                        <div class="form-group">
                                            {{ Form::submit('Update Berita', ['class'=>'btn btn-primary']) }}
                                            <a href="{{ url('/admin/news') }}" class="btn btn-light btn-sm pull-right"><i class="mdi mdi-backburger"></i> Batal</a>
                                        </div>
                                    </div>
                                </div>
                            <div class="clearfix"></div>
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection