@extends('admin.layouts.master')

@section('page')
    Tambah Data Koleksi
@endsection

@section('tab')
    Tambah Data Koleksi
@endsection

@section('hal')
    Tambah Data Koleksi
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('admin.layouts.message')
                        
                            <h4 class="title">Tambah Data Koleksi</h4>

                            <div class="content">
                            {!! Form::open(['url' => 'admin/koleksi', 'files'=>'true']) !!}
                                <div class="row">
                                    <div class="col-md-12">
                                    @include('admin.koleksi._fields')
                                        <div class="form-group">
                                            {{ Form::submit('Tambah Koleksi', ['class'=>'btn btn-primary']) }}
                                            <a href="{{ url('/admin/koleksi') }}" class="btn btn-light btn-sm pull-right"><i class="mdi mdi-backburger"></i> Batal</a>
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