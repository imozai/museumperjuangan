@extends('front.layouts.master')

@section('css')

#cardNews{
	border-width: 3px; border-color: black;
}

.garis-kanan{
  border-right: 3px solid black;
  height: inherit;
}

.card-footer{
	position: relative;
    border-top: 3px solid black;
	bottom: 0;
}

@endsection

@section('content')

@if(count($news))
<section class="exibition-area section-gap rounded">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<div class="menu-content">
				<div class="title text-center">
					<h1 class="mb-10">Berita Museum Perjuangan</h1>
				</div>                            
			</div>
		</div>
	</div>
	<hr>
	<center>
		<div class="container badge badge-dark pt-4 pb-2 pl-2">
			<div class="row justify-content-between d-flex">
				<div class="col-md-2">
					<form method="GET" action="/newNews">
						<select name="new" class="cari form-control" onchange='if(this.value != 0) { this.form.submit(); }' placeholder="">
							<option value="" disabled selected>Filter</option>
      						<option value="first">Terbaru</option>
      						<option value="last">Terlama</option>
						</select>
						<input type="submit" style="display: none;">
					</form>
				</div>
				<div class="col-md-4">
					<form class="example" method="GET" action="{{ URL::to('/searchNews') }}">
						<input class="" type="text" placeholder="Cari Judul Berita" name="search">
						<button class="secondary-btn mb-2" type="submit"><i class="mdi mdi-magnify mdi-18px"></i></button>
					</form>
				</div>
				<div class="col-md-6">
					<form method="GET" action="{{ URL::to('/filterNews') }}">
						<input type="date" placeholder="yyyy-mm-dd" pattern="(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])-(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])-(?:30))|(?:(?:0\[13578\]|1\[02\])-31))" name="startD">
						<input type="date" placeholder="yyyy-mm-dd" pattern="(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])-(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])-(?:30))|(?:(?:0\[13578\]|1\[02\])-31))" name="endD">
						<button class="secondary-btn mb-2" type="submit"><i class="mdi mdi-calendar mdi-18px"></i></button>
					</form>
				</div>
			</div>
		</div>
	</center>
	<div class="container">
		<div class="row">
			@foreach ( $news as $news )
			<div class="container mt-2">
				<div class="card" id="cardNews">
					<div class="row">
						<div class="col-md-3 mt-4 ml-4">
							<img src="/uploads/news/500/{{$news->image}}" class="card-img-top" alt="gambar" >
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">{{ $news->title }}</h5>
								<p>{{ date("d-F-Y", strtotime($news->created_at)) }}<br><b class="text-dark">By {{ $news->created_by }}</b></p>
							</div>
							<div class="card-footer">
								<a href="{{ URL::to('/detail_berita', [$news->id]) }}" class="secondary-btn"><span class="fa fa-list"></span> Baca Artikel</a>
							</div>
						</div>
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
				<h5 class="mb-4"><a class="secondary-btn mt-2" href="{{ url()->previous() }}">Kembali</a></h5>
			</div>                            
		</div>
	</div>
</div>

@endif

@endsection