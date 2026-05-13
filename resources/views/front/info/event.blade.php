@extends('front.layouts.master')

@section('css')

#limitDeskripsi {
  overflow: hidden;
  max-height: 75ch;
  text-overflow: ellipsis;
  white-space: nowrap;
  word-wrap: break-word;
}

#eveBadge{
	position: absolute; 
	font-size: 18px; 
	top: 10%; 
	left: 70%; 
	border-radius: 20%; 
	border-width: 3px; 
	border-color: white;
}

@endsection

@section('content')

@if(count($event))
<br>
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="menu-content">
			<div class="title text-center">
				<h1 class="mb-10">Event Museum Perjuangan</h1>
			</div>                            
		</div>
	</div>
</div>
<hr>
<center>
	<div class="container bg-secondary rounded">
		<div class="row">
			<div class="col-md-2 mt-4 mb-4 pl-4">
				<form method="GET" action="/newEvent">
					<select name="new" class="cari form-control" onchange='if(this.value != 0) { this.form.submit(); }' placeholder="">
						<option value="" disabled selected>Filter</option>
      					<option value="last">Terbaru</option>
      					<option value="first">Terlama</option>
      					<option value="berlangsung">Berlangsung</option>
      					<option value="segera">Segera</option>
      					<option value="berakhir">Berakhir</option>
						</select>
					<input type="submit" style="display: none;">
				</form>
			</div>
			<div class="col-md-4 mt-4 mb-4">
				<form class="example" method="GET" action="/searchEvent">
					<input class="" type="text" placeholder="Cari Judul Event" name="search">
					<button class="secondary-btn mt-1" type="submit"><i class="mdi mdi-magnify mdi-24px"></i></button>
				</form>
			</div>
			<div class="col-md-6 mt-4 mb-4">
				<form class="example" method="GET" action="{{ URL::to('/filterEvent') }}">
					<input type="date" placeholder="yyyy-mm-dd" pattern="(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])-(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])-(?:30))|(?:(?:0\[13578\]|1\[02\])-31))" name="startD">
					<input type="date" placeholder="yyyy-mm-dd" pattern="(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])-(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])-(?:30))|(?:(?:0\[13578\]|1\[02\])-31))" name="endD">
					<button class="secondary-btn mt-1" type="submit"><i class="mdi mdi-calendar mdi-24px"></i></button>
				</form>
			</div>
		</div>
	</div>
</center>
<hr>
<section class="upcoming-event-area">
	<div class="container mb-4" id="events">
		<div class="row d-flex justify-content-center">
			@foreach ($event as $event)
			<div class="col-lg-6">
				<div class="container mt-4">
					<div class="card">
						<div class="container mt-4">
							<div width="400px" class="img-fluid" alt="" style="background: url('{{ url('uploads').'/event/500/'. $event->image }}'); background-size: cover; position: relative; height: 300px;">
								@php
                                    $today = date('Y-m-d H:i');
                                    $today=date('Y-m-d H:i', strtotime($today));

                                    $stratDate = date('Y-m-d H:i', strtotime($event->tgl_mulai));
                                    $endDate = date('Y-m-d H:i', strtotime($event->tgl_selesai));
                                    if (($today >= $stratDate) && ($today <= $endDate)){
                                        echo '<div class="badge badge-success border border-white mr-4" id="eveBadge">
												<span>Berlangsung</span>
											</div>';
                                    }else if($today <= $stratDate){
                                        echo '<div class="badge badge-primary border border-white" id="eveBadge">
												<span>Segera</span>
											</div>';
                                    }else{
                                        echo '<div class="badge badge-danger border border-white" id="eveBadge">
												<span>Berakhir</span>
											</div>';
                                    }
                                @endphp
							</div>
						</div>
						<div class="container">
							<a href="{{ URL::to('/detail_event', [$event->id]) }}"><h4>{{ $event->title }}</h4></a><br>
							<h6><span class="fa fa-calendar"> {{ date("d/F/Y H:i", strtotime($event->tgl_mulai)) }} WIB - {{ date("d/F/Y H:i", strtotime($event->tgl_selesai)) }} WIB </span><br>
								<span class="fa fa-map-marker"></span> {{ $event->tempat }}
							</h6>
							<p id="limitDeskripsi">
								" {{ $event->content }} "
							</p>
						</div>
						<a href="{{ URL::to('/detail_event', [$event->id]) }}" class="primary-btn text-uppercase ml-2 mr-2 mb-2"><i class="fa fa-info"></i> Details</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>	
</section>

@else

<br>
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="menu-content">
			<div class="title text-center">
				<h1 class="mb-10">Tidak Ada Hasil T_T</h1>
				<h5 class="mb-4"><a class="btn btn-primary mt-2" href="{{ url()->previous() }}">Kembali</a></h5>
			</div>                            
		</div>
	</div>
</div>

@endif

@endsection