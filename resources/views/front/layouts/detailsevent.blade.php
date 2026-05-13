@extends('front.layouts.master')


@section('content')
<div class="container">
    <div id="boxshadow">
        <div class="row">

            <div class="col-md-12 align-items-stretch grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="header">
                            <h4 class="title mb-4">{{ $event->title }}<a class="float-right secondary-btn" href="{{ URL::to('/event') }}">Kembali</a></h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ url('uploads').'/event/500/'. $event->image }}" target="_blank" data-toggle="lightbox" data-gallery="gallery" data-title="{{ $event->title }}" data-footer="<a href='{{ url('uploads').'/event/500/'. $event->image }}' target='_blank'>Gambar Penuh</a>">
                                        <img src="{{ url('uploads/event/500') . '/'. $event->image}}" alt="" class="img-thumbnail mb-2" style="width: 500px;">
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            
                                            <tr>
                                                <th>Tanggal Mulai</th>
                                                <td>
                                                    {{ date('D, d-F-Y H:i', strtotime($event->tgl_mulai)) }}<br>
                                                    @php
                                                        $today = date('Y-m-d H:i');
                                                        $today = date('Y-m-d H:i', strtotime($today));

                                                        $stratDate = date('Y-m-d H:i', strtotime($event->tgl_mulai));
                                                        if($today <= $stratDate){
                                                            $now = time();
                                                            $datediff = $now - strtotime($event->tgl_mulai);
                                                            $jarak = round($datediff / (60 * 60 * 24)) / -1;
                                                            if($jarak == 0){
                                                                echo "<b>(Berlangsung)</b>";
                                                            }
                                                            else{
                                                                echo "<b>($jarak Hari Lagi)</b>";
                                                            }
                                                        }
                                                        else{
                                                            echo "<b>(Berakhir)</b>";
                                                        }
                                                    @endphp
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Tanggal Berakhir</th>
                                                <td>{{ date('D, d-F-Y H:i', strtotime($event->tgl_selesai)) }}</td>
                                            </tr>

                                            <tr>
                                                <th>Tempat Berlangsung Event</th>
                                                <td>{{ $event->tempat }}</td>
                                            </tr>

                                            <tr>
                                                <th>Status Event</th>
                                                <td>
                                                    @php
                                                        $today = date('Y-m-d H:i');
                                                        $today=date('Y-m-d H:i', strtotime($today));

                                                        $stratDate = date('Y-m-d H:i', strtotime($event->tgl_mulai));
                                                        $endDate = date('Y-m-d H:i', strtotime($event->tgl_selesai));
                                                        if (($today >= $stratDate) && ($today <= $endDate))
                                                            echo '<span class="badge badge-success">Berlangsung</span>';
                                                        else if($today <= $stratDate)
                                                            echo '<span class="badge badge-primary">Segera</span>';
                                                        else
                                                            echo '<span class="badge badge-danger">Berakhir</span>';
                                                    @endphp
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Diedit Oleh</th>
                                                <td><span class="fa fa-user"></span> {{ $event->created_by }}</td>
                                            </tr>

                                            <tr>
                                                <th>Dibuat Pada</th>
                                                <td><span class="mdi mdi-clock"></span> {{$event->created_at}} WIB</td>
                                            </tr>

                                            <tr>
                                                <th>Terakhir diedit pada</th>
                                                <td><span class="mdi mdi-clock"></span> {{$event->updated_at}} WIB</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5>Penjelasan Event :</h5>
                                <p> {{ $event->content }} </p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection