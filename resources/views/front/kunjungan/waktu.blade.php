@extends('front.layouts.master')

@section('content')
<br>
<div class="container">
	<div class="row d-flex justify-content-center" id="boxshadow">
		<div class="menu-content pb-60 col-lg-10">
			<div class="title text-center">
				<h1 class="mt-4">Waktu Kunjungan Museum</h1>
			</div>
			<div id="post-content" class="mt-4">
				<h5><strong>Waktu Kunjungan Museum Sementara</strong></h5><hr>
				<p>Selasa&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 08.00 - 16:00 WIB</p>
				<p>Rabu&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 08.00 - 16:00 WIB</p>
				<p>Kamis&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 08.00 - 16:00 WIB</p>
				<p>Jumat&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : 08.00 - 16:30 WIB</p><p><br></p><hr>
				<p class="text-danger">Hari Sabtu, Minggu, Senin dan Hari Libur Nasional MUSEUM TUTUP</p>
			</div>
			<div class="text-center">
				<span id="bgbuka" class="badge badge-secondary">PELAYANAN MUSEUM OFFLINE SAAT INI <h2 id="bukatutup" class="text-light"></h2></span>
			</div>
		</div>
	</div>
</div>

@endsection