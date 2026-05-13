@extends('front.layouts.master')

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
  		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
@stop

@section('content')

@if(count($koleksi))

<br>
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="menu-content ">
			<div class="title text-center">
				<h1 class="mb-10">Koleksi Museum - Lantai Bawah</h1>
			</div>                            
		</div>
	</div>
</div>
<div class="container">
	<p>Koleksi lantai bawah museum perjuangan kebanyakan berupa mata uang kuno</p>
	<center>
		<div class="row justify-content-between d-flex bg-dark rounded">
			<div class="col-md-6 mb-4 mt-4">
				<form class="example" method="GET" action="/searchKoleksi">
					<input class="" type="text" placeholder="Cari Koleksi Lantai Bawah ..." name="searchBawah">
					<button class="secondary-btn" type="submit"><i class="fa fa-search"></i></button>
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
                         <!--<div id="grid-container" class="row">
                            <a class="single-gallery" href="img/g1.jpg"title="Tombak : Tombak di dapatkan dari magelang pada tahun 1985"><img class="grid-item" title="asas" alt="rontol" src="img/g1.jpg" ></a>
                            <a class="single-gallery" href="img/g2.jpg"title="test 2"><img class="grid-item" src="img/g2.jpg"></a>
                            <a class="single-gallery" href="img/g3.jpg"title="test 3"><img class="grid-item" src="img/g3.jpg"></a>
                            <a class="single-gallery" href="img/g4.jpg"title="test 4"><img class="grid-item" src="img/g4.jpg"></a>
                            <a class="single-gallery" href="img/g5.jpg"title="test 5"><img class="grid-item" src="img/g5.jpg"></a>
                            <a class="single-gallery" href="img/g6.jpg"><img class="grid-item" src="img/g6.jpg"></a>
                            <a class="single-gallery" href="img/g7.jpg"><img class="grid-item" src="img/g7.jpg"></a>
                            <a class="single-gallery" href="img/g8.jpg"><img class="grid-item" src="img/g8.jpg"></a>
                            <a class="single-gallery" href="img/g9.jpg"><img class="grid-item" src="img/g9.jpg"></a>
                            <a class="single-gallery" href="img/g10.jpg"><img class="grid-item" src="img/g10.jpg"></a>
                            <a class="single-gallery" href="img/g11.jpg"><img class="grid-item" src="img/g11.jpg"></a>
                            <a class="single-gallery" href="img/g12.jpg"><img class="grid-item" src="img/g12.jpg"></a>
                            <a class="single-gallery" href="img/g4.jpg"><img class="grid-item" src="img/g4.jpg"></a>
                            <a class="single-gallery" href="img/g5.jpg"><img class="grid-item" src="img/g5.jpg"></a>
                        </div>
                    --> 