@extends('front.layouts.master')

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
  		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
@stop

@section('content')
<!-- End banner Area -->
@if(count($koleksi))

<br>
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="menu-content ">
			<div class="title text-center">
				<h1 class="mb-10">Koleksi Museum - Lantai Atas</h1>
			</div>                            
		</div>
	</div>
</div>
<div class="container">
	<p>Koleksi lantai atas museum perjuangan banyak peninggalan sejarah perang dunia II</p>
	<center>
		<div class="row justify-content-between d-flex bg-dark rounded">
			<div class="col-md-6 mb-4 mt-4">
				<form class="example" method="GET" action="/searchKoleksi">
					<input class="" type="text" placeholder="Cari Koleksi Lantai Atas.." name="searchAtas">
					<button class="secondary-btn" type="submit"><i class="mdi mdi-magnify mdi-24px"></i></button>
				</form>
			</div>
			<div class="col-md-3 mb-4 mt-4">
				<a class="secondary-btn" href="{{ url('/gallery.html') }}">Kembali ke Gallery</a>
			</div>
		</div>
	</center>
	<div class="row">
		@foreach ($koleksi as $koleksi)
		<div class="single-exibition item">
			<div class="card card-statistics ml-3 mb-4 mt-4">
				<div class="card-body">
					<div class="col-md-2 cell">
						<a href="{{ URL::to('/detail_koleksi', [$koleksi->id]) }}">
							<img width="250px" style="background: url('{{ url('uploads').'/image/500/'. $koleksi->image }}'); background-size: cover; position: relative; border-radius: 5%; height: 200px"></img>
						</a>
					</div>
				</div>
				<div class="card-footer text-center">
					<h5>
						{{ $koleksi->name }} 
						@if( $koleksi->slide == '1' )
							<span class="badge badge-danger" data-toggle="tooltip" title="Koleksi yang di tampilkan di Dashboard">Highlight</span>
						@else
						@endif
					</h5>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>

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