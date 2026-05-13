@extends('front.layouts.master')

@section('content')

<div class="container">
    <div id="boxshadow">
        <div class="card">
            <div class="card-body">
                <div class="header">
                    <h4 class="title mb-4">Detail Berita Museum Perjuangan<a class="float-right secondary-btn" href="{{ URL::to('/berita') }}">Kembali</a></h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <a href="{{ url('uploads').'/news/500/'. $news->image }}" target="_blank" data-toggle="lightbox" data-gallery="gallery" data-title="{{ $news->title }}" data-footer="<a href='{{ url('uploads').'/news/500/'. $news->image }}' target='_blank'>Gambar Penuh</a>">
                                <img src="{{ url('uploads/news/500') . '/'. $news->image}}" alt="" class="img-thumbnail mb-2" style="width: 500px;">
                            </a>
                        </div>

                        <div class="col-md-4">
                            
                            <p><b class="text-dark">~Diedit Oleh</b> : <span class="fa fa-user"></span> <strong> {{ $news->created_by }}</strong></p>
                        
                            <b class="text-dark">~Dibuat Pada :</b><br>
                            <strong><span class="mdi mdi-clock"></span> {{$news->created_at}} WIB<br>{{ $news->created_at->diffForHumans() }}</strong>

                            <br><br>

                            <b class="text-dark">~Terakhir diedit pada :</b><br>
                            <strong><span class="mdi mdi-clock"></span> {{$news->updated_at}} WIB<br>{{ $news->updated_at->diffForHumans() }}</strong>
                        </div>
                    </div>
                </div>

                <div>
                    <table>
                        <tbody>
                        <tr>
                            <td><h3>{{ $news->title }}</h3></td>
                        </tr>

                        <tr>
                            <td>
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <p>{{ $news->content }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection