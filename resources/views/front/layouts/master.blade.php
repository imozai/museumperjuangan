<!DOCTYPE html>
	
<html lang="zxx" class="no-js">


<title>Museum Perjuangan Yogyakarta</title>
	
	
	<head>
	
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Author Meta -->
		<meta name="author" content="Museum_Perjuangan_Yogyakarta">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Museum Perjuangan Yogyakarta</title>

		<!-- Favicon-->
		<link rel="shortcut icon" href="{{asset('uploads/compress/MBVY.ico')}}" />

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="{{asset('css/linearicons.css')}}">
			<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
			<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
			<link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
			<link rel="stylesheet" href="{{asset('css/nice-select.css')}}">					
			<link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
			<link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
			<link rel="stylesheet" href="{{asset('css/main.css')}}">
			<link rel="stylesheet" href="{{asset('perpusmu/css/font-awesome.min.css')}}">
			<link rel="stylesheet" href="{{asset('perpusmu/css/linearicons.css')}}">
			<link rel="stylesheet" href="{{asset('perpusmu/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
			<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
			<style type="text/css">
				::-webkit-scrollbar {
				  width: 10px;
				}

				/* Track */
				::-webkit-scrollbar-track {
				  box-shadow: inset 0 0 5px grey; 
				  border-radius: 10px;
				}
				 
				/* Handle */
				::-webkit-scrollbar-thumb {
				  background: #91db3d; 
				  border-radius: 10px;
				}

				/* Handle on hover */
				::-webkit-scrollbar-thumb:hover {
				  background: #91db9d; 
				}
				#loader {
				  position: absolute;
				  left: 50%;
				  top: 40%;
				  z-index: 1;
				  width: 150px;
				  height: 150px;
				  margin: -75px 0 0 -75px;
				  border: 16px solid black;
				  border-radius: 50%;
				  border-top: 20px solid #91db3d;
				  width: 120px;
				  height: 120px;
				  -webkit-animation: spin 2s linear infinite;
				  animation: spin 2s linear infinite;
				}

				#text-loader {
				  position: absolute;
				  left: 47%;
				  top: 44%;
				}

				.mdi:hover, .fa:hover, .badge:hover {
					-ms-transform: scale(1.05); /* IE 9 */
  					-webkit-transform: scale(1.05); /* Safari 3-8 */
  					transform: scale(1.05);
				}

				.loader-circle {
				  display: inline-block;
				  transform: translateZ(1px);
				}
				.loader-circle > div {
				  display: inline-block;
				  width: 64px;
				  height: 64px;
				  margin: 8px;
				  border-radius: 50%;
				  background: #91db3d;
				  animation: loader-circle 2.4s cubic-bezier(0, 0.2, 0.8, 1) infinite;
				}
				@keyframes loader-circle {
				  0%, 100% {
				    animation-timing-function: cubic-bezier(0.5, 0, 1, 0.5);
				  }
				  0% {
				    transform: rotateY(0deg);
				  }
				  50% {
				    transform: rotateY(1800deg);
				    animation-timing-function: cubic-bezier(0, 0.5, 0.5, 1);
				  }
				  100% {
				    transform: rotateY(3600deg);
				  }
				}

				@-webkit-keyframes spin {
				  0% { -webkit-transform: rotate(0deg); }
				  100% { -webkit-transform: rotate(360deg); }
				}

				@keyframes spin {
				  0% { transform: rotate(0deg); }
				  100% { transform: rotate(360deg); }
				}

				/* Add animation to "page content" */
				.animate-bottom {
				  position: relative;
				  -webkit-animation-name: animatebottom;
				  -webkit-animation-duration: 1s;
				  animation-name: animatebottom;
				  animation-duration: 1s
				}

				@-webkit-keyframes animatebottom {
				  from { bottom:-100px; opacity:0 } 
				  to { bottom:0px; opacity:1 }
				}

				@keyframes animatebottom { 
				  from{ bottom:-100px; opacity:0 } 
				  to{ bottom:0; opacity:1 }
				}

				* {
  					box-sizing: border-box;
				}
				
    			.navbar-inner{
    				display: block;    				
    			}

    			#textFBTN{
    				display: none;
    			}

    			#fixedbutton:hover #textFBTN{
    				display: block;
    			}

    			#fixedbutton2:hover #textFBTN{
    				display: block;
    			}

    			@media (min-width: 600px) {
    				.btn-navbar{
    					display: none;
    				}
    			
    				#navHilang{
    					display: none;
    				}
    			}

    			@media screen and (max-width: 600px) {
					.btn-navbar{
    					display: block;
    					margin-right: 20px;
    				}

    				#loader{
    					left: 50%;
    					top: 40%;
    				}

    				#text-loader{
    					left: 40%;
    					top: 42%;
    				}
  
    				#navHilang{
    					margin-top: 10px;
    					background-color: grey;
    					margin-left: auto;
    					margin-right: auto;
    				}
    				.navbar-inner{
    					display: none;
    				}
    				.brand{
    					left:0;
    				}

    				#denahImg,#imgFasilitas{
    					max-width: 350px;
    				}
    				#boxshadow{
    					margin: 20px;
    				}
    			}
				@section('css')

    			@show
			</style>
			
	</head>
	<body onload="loadFunction()">
		
		<div>
			<a id="fixedbutton" class="mdi mdi-comment btn btn-lg text-white border border-light" data-target="#kritikModalUser" data-toggle="modal"><p id="textFBTN" style="font-size: 10px">Kritik & Saran</p></a>
			<header id="header" id="home">
			  	<div class="container header-top">
			  		<div class="row">
				  		<div class="col-6 top-head-left">
				  			<ul>
				  				<li>
				  					<a href="#" data-target="#qrModal" data-toggle="modal" class="fa fa-qrcode"> QR Code</a>
				  				</li>
				  			</ul>
				  		</div>
				  		<div class="col-6 top-head-right">
				  			<ul>
		  						<li><a href="https://id.wikipedia.org/wiki/Museum_Perjuangan_Yogyakarta"><i class="fa fa-globe"></i> Wikipedia</a></li>
		  						<li><a href="https://vredeburg.id"><i class="fa fa-globe"></i> Vredeburg.id</a></li>
				  			</ul>
				  		</div>			  			
			  		</div>
			  	</div>
			  	<hr>
	  			<div class="container">
	  				<div class="row align-items-center justify-content-between d-flex">
	  					
	  					<div id="logo" class="brand">
	  						<a href="/" class="badge badge-pills" style="background-color: grey;"><img src="https://vredeburg.id/images/logo.png" alt="" title="" /></a>
	  					</div>
	  					<nav id="nav-menu-container badge badge-pills mt-2 mb-2" style="background-color: grey;" class="navbar-inner">
	  						<ul class="nav-menu">
	  							<li class="menu-active badge badge-pills bg-dark border border-white"><a href="/" class="fa fa-home"><b class="text-white"> Home</b></a></li>

	  							<li class="menu-has-children badge badge-pills bg-dark border border-white"><a href="#" class="fa fa-info-circle"><b class="text-white"> Info</b></a>
	  								<ul>
	  									<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/berita') }}">-Berita</a></li>
	  									<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/event') }}">-Event</a></li>
	  									<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/gallery.html') }}">-Galeri</a></li>

	  								</ul>
	  							</li>	

	  							<li class="menu-has-children badge badge-pills bg-dark border border-white"><a href="#" class="fa fa-calendar-check-o"><b class="text-white"> Kunjungan</b></a>
	  								<ul>
	  									<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/waktu') }}">-Waktu Kunjungan</a></li>
	  									<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/tiket') }}">-Tiket</a></li>
	  									<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/alamat') }}">-Alamat</a></li>
	  									<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/fasilitas') }}">-Fasilitas</a></li>
	  									<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/denah') }}">-Denah Zona Museum</a></li>
	  								</ul>
	  							</li>

	  							<li class="nav-menu badge badge-pills mr-2 bg-dark border border-white"><a href="{{ URL::to('/tentang') }}" class="fa fa-building-o"><b class="text-white"> Profil</b></a></li>

	  						</ul>
	  					</nav><!-- #nav-menu-container -->
	  					<a class="btn-navbar text-white icon-lg btn btn-secondary" data-toggle="collapse" data-target=".nav-collapse">
	    					<span id="btn-mobile" class="fa fa-bars"></span>
	    				</a>
	    				<div class="nav-collapse collapse" id="navHilang">
	    				<!-- .nav, .navbar-search, .navbar-form, etc -->
		    				<ul class="nav-menu">
		    					<li class="menu-active badge badge-pills bg-dark border border-white"><a href="/" class="fa fa-home"><b class="text-white"> Home</b></a></li>

		    					<li class="menu-has-children badge badge-pills bg-dark border border-white"><a href="#" class="fa fa-info-circle"><b class="text-white"> Info</b></a>
		    						<ul>
		    							<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/berita') }}">-Berita</a></li>
		    							<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/event') }}">-Event</a></li>
		    							<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/gallery.html') }}">-Galeri</a></li>

		    						</ul>
		    					</li>	

		    					<li class="menu-has-children badge badge-pills bg-dark border border-white"><a href="#" class="fa fa-calendar-check-o"><b class="text-white"> Kunjungan</b></a>
		    						<ul>
		    							<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/waktu') }}">-Waktu Kunjungan</a></li>
		    							<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/tiket') }}">-Tiket</a></li>
		    							<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/alamat') }}">-Alamat</a></li>
		    							<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/fasilitas') }}">-Fasilitas</a></li>
		    							<li><a class="badge badge-dark text-white mb-1" href="{{ URL::to('/denah') }}">-Denah Zona Museum</a></li>
		    						</ul>
		    					</li>

		    					<li class="nav-menu badge badge-pills mr-2 bg-dark border border-white"><a href="{{ URL::to('/tentang') }}" class="fa fa-building-o"><b class="text-white"> Profil</b></a></li>

		    				</ul>
	    				</div>    		
	  				</div>
	  			</div>
			</header><!-- #header -->

			<!-- start banner Area -->
			@if(Request::url() == 'http://192.168.1.9:8080' || Request::url() == 'http://192.168.1.13:8080' || Request::url() == 'http://127.0.0.1:8080')
			<section class="banner-area relative border border-dark rounded-bottom" id="home" style="background: url('{{ asset('uploads/compress/dashboard.jpg')}}') center;background-size:cover; z-index: +3; position: relative;">
				<div class="overlay overlay-bg"></div>	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-8">
							<h1 class="text-white">
								MUSEUM PERJUANGAN YOGYAKARTA	
							</h1><br>
							<h6 class="text-white">(MUSEUM BENTENG VREDEBURG YOGYAKARTA UNIT II)</h6>
							<p class="pt-20 pb-20 text-white">
								JL. KOLONEL SUGIYONO NO. 24<BR>
								YOGYAKARTA<BR>
								TELEPON/FAX. 0274-387576
							</p>
							<span id="bgbuka" class="badge badge-secondary">PELAYANAN MUSEUM OFFLINE SAAT INI<h2 id="bukatutup" class="text-light"></h2></span>
							<p id="demo"></p>
						</div>											
					</div>
				</div>					
			</section>
			@else
			<section class="banner-area relative" id="home" style="background: url('{{ asset('uploads/compress/dashboard.jpg')}}') center;background-size:cover; z-index: +3; position: relative;">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								MUSEUM PERJUANGAN YOGYAKARTA	
							</h1>
						</div>
					</div>
				</div>
			</section>
			@endif
			<!-- End banner Area -->	
						@if ( session()->has('msg') )
						<div class="container mt-4">
	                        <div class="alert alert-success alert-dismissible">
	                            {{ session()->get('msg') }}
	                            <a class="float-right badge badge-primary mt-1" href="{{ url()->previous() }}">Reset</a>
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                                <span aria-hidden="true">&times;</span>
	                            </button>
	                        </div>
	                    </div>
	                    @endif
			<!-- Start exibition Area -->
			<!-- <div class="container">
			<div id="loader"><div class="loader-circle"><div></div></div></div>
			<p id="text-loader" class="badge badge-secondary">Loading . . .</p>
			</div>
			<div id="bodyLoaded" style="visibility: hidden;" class="animate-bottom"> -->
			@yield('content')
			<!-- </div> -->
			<!-- End upcoming-event Area -->
			
			<!-- start footer Area -->		
			<footer class="footer-area section-gap"  style="background-color: black;">
				<div class="container">
					<div class="row">
						<div class="col-lg-5 col-md-6 col-sm-6 garis-kiri-footer">
							<div class="single-footer-widget">
								<h6 class="text-white">Museum Perjuangan Yogyakarta</h6>
								<p>
									<strong>Museum Perjuangan Yogyakarta</strong><br>
									Jl. Kolonel Sugiyono No.24, Brontokusuman, Kec. Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55153
								</p>
								<div class="footer-social d-flex align-items-center">
									<div class="w3-center float">
										<a class="mdi mdi-maps" href="https://www.google.com/maps/place/Museum+Perjuangan/@-7.8163128,110.3718774,17z/data=!4m5!3m4!1s0x2e7a5798b77b074f:0x6c69556d4022dc2c!8m2!3d-7.8163128!4d110.3718774" target="_blank">
										<b><span class="mdi mdi-google-maps my-float" style="font-size:30px;"></span></b></a>
									</div>
									<div class="w3-center float">
										<a href="https://www.google.com/search?hl=id-ID&gl=id&q=Museum+Perjuangan,+Jl.+Kolonel+Sugiyono+No.24,+Brontokusuman,+Kec.+Mergangsan,+Kota+Yogyakarta,+Daerah+Istimewa+Yogyakarta+55153&ludocid=7811868956366658604&lsig=AB86z5WtPs9Ob2xuaGDkG7-lxYUB&hl=in&gl=ID#lrd=0x2e7a5798b77b074f:0x6c69556d4022dc2c,1,,," target="_blank">
										<b><span class="mdi mdi-star-circle my-float" style="font-size:30px;"></span></b></a>
									</div>
								</div>
								<p class="footer-text" style="display: none;">
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
									Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> and distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								</p>
							</div>
						</div>
						<div class="col-lg-5  col-md-6 col-sm-6 garis-kiri-footer">
							<div class="single-footer-widget">
								<h6 class="text-white">Waktu Kunjungan Museum</h6>
									<p><i>Selasa-Kamis : 08.00 - 16:00 WIB</i></p>
									<p><i>Jumat : 08.00 - 16:30 WIB</i></p>
									<b><p>Hari Sabtu, Minggu, Senin dan Hari Libur Nasional<br>
										MUSEUM TUTUP
									</p></b>
								</p>
							</div>
						</div>			
								
					 <div class="col-lg-2 col-md-6 col-sm-6 social-widget garis-kiri-footer">
							<div class="single-footer-widget">
								<h6 class="text-white">Kontak kami</h6>
								<p>Telepon:<br>(0274) 387576</p>
								<div class="footer-social d-flex align-items-center">
									{{-- <i class="fa fa-instagram w3-hover-opacity w3-large">
										<a href="https://www.instagram.com/museum.perjuangan.yogyakarta/">Instagram</a></i>
									</i> --}}

									<div class="w3-center float">
										<a href="https://m.facebook.com/profile.php?id=568221439938860&__tn__=C-R" target="_blank">
										<b><span class="mdi mdi-facebook my-float" style="font-size:30px;"></span></b></a>
									</div>
									<div class="w3-center float">
										<a href="https://www.youtube.com/results?search_query=museum+perjuangan+yogyakarta" target="_blank">
										<b><span class="mdi mdi-youtube-play my-float" style="font-size:30px;"></span></b></a>
									</div>
									<div class="w3-center float">
										<a href="https://api.whatsapp.com/send?phone=6281226099292&text=Halo" target="_blank">
										<b><span class="mdi mdi-whatsapp my-float" style="font-size:30px;"></span></b></a>
									</div>
									<div class="w3-center float2">
										<a href="tel:6281226099292" target="_blank">
										<b><span class="fa fa-phone my-float2"  style="font-size:30px;"></span></b></a>	
									</div>	
								</div>
							</div>
						</div>					
					</div>
				</div>
			</footer>	
			<!-- End footer Area -->
			<div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="qrModalLabel">QR Code untuk Halaman ini</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<center>
								<img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data={{ Request::url() }}&amp;size=100x100" alt="" title="QR-MPY-WEB" width="350" height="350" />
								<p>
									<b class="fa fa-info text-black"> Cara Download QR</b><br>
									*Mobile : Tekan Lama pada QR untuk Download<br>
									*Web    : Klik Kanan pada QR untuk Download
								</p>
							</center>
						</div>
					</div>
				</div>
			</div>	

			<script src="{{asset('js/vendor/jquery-2.2.4.min.js')}}"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js')}}" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
			<script src="{{asset('js/easing.min.js')}}"></script>			
			<script src="{{asset('js/hoverIntent.js')}}"></script>
			<script src="{{asset('js/superfish.min.js')}}"></script>	
			<script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
			<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>	
			<script src="{{asset('js/owl.carousel.min.js')}}"></script>	
			<script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
			<script src="{{asset('js/justified.min.js')}}"></script>					
			<script src="{{asset('js/jquery.sticky.js')}}"></script>
			<script src="{{asset('js/jquery.nice-select.min.js')}}"></script>			
			<script src="{{asset('js/parallax.min.js')}}"></script>		
			<script src="{{asset('js/mail-script.js')}}"></script>	
			<script src="{{asset('js/main.js')}}"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
			<script type="text/javascript">
				
				var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
			  	var d = new Date();
			  	var dayName = days[d.getDay()];
			  	var hr = d.getHours();
			 	var element = document.getElementById("bukatutup");
			  	var bg = document.getElementById("bgbuka");
			  	$(document).ready(function() {
			    	if( hr >= 8 && hr <= 15 && dayName != "Sabtu" && dayName != "Minggu" && dayName != "Senin"){
			      		element.innerHTML = "Buka";
			      		bgbuka.className = "badge badge-success border border-light text-center";
			    	}
			    	else if( dayName == "Sabtu" ){
			    		document.getElementById("demo").innerHTML = "Buka Kembali Hari Selasa Jam 08.00 WIB";
			    		element.innerHTML = "Tutup";
			      		bgbuka.className = "badge badge-danger border border-light text-center";
			    	}
			    	else{
			    		document.getElementById("demo").innerHTML = "Buka Kembali Besok Jam 08.00 WIB";
			      		element.innerHTML = "Tutup";
			      		bgbuka.className = "badge badge-danger border border-light text-center";
			    	}
			  	});


			 //  	var loadVar;
			 //  	var percentVar;
			 //  	var p=0;

				// function loadFunction() {
				// 	$('html').animate({scrollTop:0}, 'slow');
				//     loadVar = setTimeout(showPage, 2000);
				//     percentVar = setTimeout(timeout_trigger, 2000);
				// }

				// function timeout_trigger() {
   	// 				$("#text-loader").text("Loading "+p+" %");
   	// 				if(p!=100) {
    //    					setTimeout('timeout_trigger()', 16);
   	// 				}
   	// 				p = p + 1;
   					
				// }
				// timeout_trigger();

				// function showPage() {
				//   document.getElementById("loader").style.display = "none";
				//   document.getElementById("text-loader").style.display = "none";
				//   document.getElementById("bodyLoaded").style.visibility = "visible";
				// }
	  		</script>
			@section('js')
			
			@show
		</div>
	</body>
</html>


<div class="modal fade" id="kritikModalUser" tabindex="-1" role="dialog" aria-labelledby="kritikModalUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kritikModalUserLabel">Kritik dan Saran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/createKritik" method="post" enctype="multipart/form-data" id="usrForm">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" name="status" value="0">
                    <div class="form-group">
                    	<label for="name">Nama:</label>
                    	<input type="text" name="name" placeholder="Nama Anda" class="form-control border-input" required>
                	</div>
                	<div class="form-group">
                    	<label for="title">Email:</label>
                    	<input type="email" name="email" placeholder="Email Anda" class="form-control border-input" required>
                	</div>
                	<div class="form-group">
                    	<label for="title">Perihal:</label>
                    	<input type="text" name="title" placeholder="Tentang Apa ?" class="form-control border-input" required>
                	</div>
                	<div class="form-group">
                		<label for="kritik">Kritik dan Saran:</label>
                		<textarea type="text" form="usrForm" name="kritik" placeholder="Kritik dan Saran anda" class="form-control border-input" required></textarea>
                	</div>
                    <div class="modal-footer">
                        <input id="submit" type="submit" class="secondary-btn" value="Kirim">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>