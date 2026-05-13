@extends('front.layouts.master')


@section('content')
<!-- Start upcoming-event Area -->
<br>
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="menu-content">
			<div class="title text-center">
				<h1 class="mb-10">Galeri Museum Perjuangan Yogyakarta</h1>
			</div>                            
		</div>
	</div>
</div>					
<br>
<center>
	<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="w3-display-container w3-container">
				<img src="{{ url('uploads/compress/l_atas.jpg') }}" alt="Jeans"  style="border-radius: 5%; width:80%">
			</div>
			<br>
			<a class="btn primary-btn text-uppercase mb-4" style="border-radius: 10%;" href="lantai_atas">Koleksi Lantai Atas</a>
		</div>
		<div class="col-md-6">
			<div class="w3-display-container w3-container">
				<img src="{{ url('uploads/compress/l_bawah.jpg') }}" alt="Jeans" style="border-radius: 5%; width:80%">
			</div>
			<br>
			<a class="btn primary-btn text-uppercase mb-4" style="border-radius: 10%;" href="lantai_bawah">Koleksi Lantai Bawah</a>
		</div>
	</div>
</div>
</center>
<br>



@endsection