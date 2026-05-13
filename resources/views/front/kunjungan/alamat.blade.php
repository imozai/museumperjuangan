@extends('front.layouts.master')

@section('content')
<br>
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="menu-content col-lg-10">
			<div class="title text-center">
				<h1>Alamat Museum</h1>
			</div>                            
		</div>
	</div>
</div>

<center>
	<div id="content">
		<div class="container">
			<div class="row" id="boxshadow">
				<div class="col-md-12 mt-4 mb-4">
					<div style="width: 100%;"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?q=Museum%20Perjuangan%2C%20Jalan%20Kolonel%20Sugiyono%2C%20Brontokusuman%2C%20Yogyakarta%20City%2C%20Special%20Region%20of%20Yogyakarta%2C%20Indonesia&z=14&t=&ie=UTF8&output=embed"></iframe><a href="https://goo.gl/maps/FW5PQzk4BtN8C6w97"></a></div>
				</div>
			</div>
			<a href="https://www.google.com/maps/place/Museum+Perjuangan/@-7.8163128,110.3718774,17z/data=!4m5!3m4!1s0x2e7a5798b77b074f:0x6c69556d4022dc2c!8m2!3d-7.8163128!4d110.3718774" target="_blank">
				<button class="secondary-btn mb-4 ml-auto mr-auto">Buka GMaps</button>
			</a>
		</div>
	</div>
	<br>
</center>

@endsection