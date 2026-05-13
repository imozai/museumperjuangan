@extends('admin.layouts.master')

@section('page')
    Edit Event
@endsection

@section('tab')
    Edit Event
@endsection

@section('hal')
    Edit Event
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('admin.layouts.message')
            
                            <h4 class="title">Update Data Event</h4>

                            <div class="content">
                            {!! Form::open(['url' => ['admin/event', $event->id], 'files'=>'true', 'method'=>'put']) !!}
                                <div class="row">
                                    <div class="col-md-12">
                                    @include('admin.event._fields')
                                        <div class="form-group">
                                            {{ Form::submit('Update Event', ['class'=>'btn btn-primary']) }}
                                            <a href="{{ url('/admin/event') }}" class="btn btn-light btn-sm pull-right"><i class="mdi mdi-backburger"></i> Batal</a>
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