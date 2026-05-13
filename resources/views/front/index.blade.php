@extends('front.layouts.master')

@section('css')

.overlayimg {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .3s ease;
  background-color: #91db3d;
}

.img-fluid:hover .overlayimg {
  opacity: 0.5;
}

.iconforhover:hover{
  color: white;
  background-color: black;
  border-radius: 50%;
  border-color: white;
  border-width: 3px;
}

.img-fluid .overlayimg {
	display: block;
	position: relative;
}

.iconforhover {
  color: black;
  font-size: 50px;
  position: absolute;
  top: 40%;
  left: 30%;
  text-align: center;
}

#fixedbutton2 {
  font-size: 30px;
  background-color: #91db3d;
  border-radius: 50%;
  position: fixed;
  bottom: 100px;
  right: 10px;
  z-index: +2;
}

#fixedbutton2 #notif {
  position: absolute;
  top: -2px;
  right: 1px;
  font-size: 15px;
  padding: 0px 6px;
  border-radius: 50%;
  background-color: red;
  color: white;
}

.garis-kanan{
  border-right: 6px solid black;
  height: inherit;
}

#limitDeskripsi {
  overflow: hidden;
  max-height: 75ch;
  text-overflow: ellipsis;
  white-space: nowrap;
  word-wrap: break-word;
}

@media screen and (max-width: 600px) {
  .garis-kanan{ display: none; }
}

.reveal{
  position: relative;
  transform: translateY(150px);
  opacity: 0;
  transition: 1s all ease;
}

.reveal.active{
  transform: translateY(0);
  opacity: 1;
}

@endsection

@section('js')
<script type="text/javascript">
function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 150;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}

window.addEventListener("scroll", reveal);
</script>
@endsection

@section('content')
<a id="fixedbutton2" class="mdi mdi-bell btn btn-lg text-white border border-light" data-target="#eventModalUser" data-toggle="modal">
  <p id="textFBTN" style="font-size: 10px">Event Terdekat</p>
	@if( $events->count() > 0 )
		<span id="notif" class="border border-light">{{ $events->count() }}</span>
	@else
	@endif
</a>
<section class="exibition-area section-gap bg-white rounded" id="boxshadow">
	<div class="container reveal">
		<div class="row d-flex justify-content-center">
			<div class="menu-content pb-60 col-lg-10">
				<div class="title text-center">
					<h1 class="mb-10">Koleksi Museum</h1>
				</div>
			</div>
		</div>						
		<div class="row">
			<div class="active-exibition-carusel">
				@foreach ($koleksi as $koleksi)
        <div class="container">
          <div class="card">
    				<div class="single-exibition item ml-4 mr-4 mt-2">
    					<div width="400px" class="img-fluid" alt="" style="background: url('{{ url('uploads').'/image/500/'. $koleksi->image }}'); background-size: cover; position: relative; height: 300px;">
    						<div class="overlayimg">
    							<a href="{{ URL::to('/detail_koleksi', [$koleksi->id]) }}" class="fa fa-search iconforhover mr-4">Detail</a>
    						</div>
    					</div>
    					<ul class="tags">
    						<p ><h4>{{ $koleksi->name }}</h4></p>
    						<p id="limitDeskripsi">
    							{{ $koleksi->description}}
    						</p>							
    					</ul> 
    				</div>
          </div>
        </div>
				@endforeach
			</div>													
		</div>
	</div>	
</section>
<!-- End exibition Area -->	


<!-- Start upcoming-event Area -->
<section class="upcoming-event-area bg-white rounded" id="boxshadow">
	<div class="container reveal">
		<div class="row d-flex justify-content-center">
			<div class="menu-content pb-60 col-lg-10">
				<div class="title text-center">
					<h1 class="mb-10" style="margin-top: 50px;">Berita & Event</h1>
				</div>
			</div>
		</div>						
		<div class="row">
			<div class="col-lg-6 event-left mb-4">
				<div class="container reveal" style="margin-bottom: 30px">
					@foreach ($news as $news)
					<div class="single-events">
						<div width="400px" class="img-fluid" alt="" style="background: url('{{ url('uploads').'/news/500/'. $news->image }}'); background-size: cover; position: relative; height: 300px;">
							<div class="badge text-white" style="background-color: #91db3d; position: absolute; font-size: 18px; top: 10%; left: 80%; border-radius: 20%; border-width: 3px; border-color: white;">
								<span>Berita</span>
							</div>
							<div class="overlayimg">
								<a href="{{ URL::to('/detail_berita', [$news->id]) }}" class="fa fa-search iconforhover"> Detail</a>
							</div>
						</div>
						<a href="{{ URL::to('/detail_berita', [$news->id]) }}"><h4>{{ $news->title }}</h4></a>
						<h6>Terakhir disunting <span class="fa fa-clock-o"> {{ date("d-F-Y H:i", strtotime($news->updated_at)) }} WIB</span> oleh <i class="fa fa-user"></i> {{ $news->created_by }}</h6>
						<p id="limitDeskripsi">
						"	{{ $news->content }} "
						</p>
					</div>
					@endforeach
					<a href="{{ URL::to('/berita') }}" class="primary-btn text-uppercase">Berita Selengkapnya -></a>
				</div>
			</div>
      <div class="col-lg-1 garis-kanan"></div>
			<div class="col-lg-5 event-right">
				<div class="container reveal" style="margin-bottom: 30px">
					@foreach ($event as $event)
					<div class="single-events">
						<div width="300px" class="img-fluid" alt="Highligted Koleksi" style="background: url('{{ url('uploads').'/event/500/'. $event->image }}'); background-size: cover; position: relative; height: 300px;">
							<div class="badge text-white" style="background-color: #91db3d; position: absolute; font-size: 18px; top: 10%; left: 80%; border-radius: 20%; border-width: 3px; border-color: white;">
								<span>Event</span>
							</div>
							<div class="overlayimg">
								<a href="{{ URL::to('/detail_event', [$event->id]) }}" class="fa fa-search iconforhover"> Detail</a>
							</div>
						</div>
						<a href="{{ URL::to('/detail_event', [$event->id]) }}"><h4>{{ $event->title }}</h4></a>
						<h6><span class="fa fa-calendar"> {{ date("d-F-Y H:i", strtotime($event->tgl_mulai)) }} WIB - {{ date("d-F-Y H:i", strtotime($event->tgl_selesai)) }} WIB </span><br>
                <span class="fa fa-map-marker"></span> {{ $event->tempat }}
            </h6>
						<p id="limitDeskripsi">
							" {{ $event->content }} "
						</p>
					</div>
					@endforeach
					<a href="{{ URL::to('/event') }}" class="primary-btn text-uppercase">Event Selengkapnya -></a>
				</div>
			</div>
		</div>
	</div>	
</section>

<div class="modal fade" id="eventModalUser" tabindex="-1" role="dialog" aria-labelledby="eventModalUserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalUserLabel">Event Yang Akan Datang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($events as $ev)
                <a href="{{ URL::to('/detail_event', [$ev->id]) }}">
                <div class="container">
                	@if($ev->count() > 0)
                	<div class="row border border-dark mt-2">
                		<div class="col-md-2">
                			<div class="badge badge-dark">
                				<h4 class="text-white">
                					@php
                				 		echo date("d", strtotime($ev->tgl_mulai));
                					@endphp
                				</h4>
                				@php
                				 	echo date("F", strtotime($ev->tgl_mulai));
                				@endphp
                			</div>
                			<div class="badge badge-dark">
                				<b class="text-white">
                					@php
                				 		echo date("H:i", strtotime($ev->tgl_mulai));
                					@endphp
                					WIB
                				</b>
                			</div>
                		</div>
                		<div class="col-md-8">
                			<h5>{{$ev->title}}</h5>
                		</div>
                		<div class="col-md-2 mt-2">
                			<b class="badge badge-secondary"><h4 class="text-white">
                				@php
                					$now = time();
                					$datediff = $now - strtotime($ev->tgl_mulai);
                					$jarak = round($datediff / (60 * 60 * 24)) / -1;
                					if($jarak <= 0){
                						echo "</h4><p>Ber-<br>langsung</p>";
                					}
                					else{
                						echo $jarak;
                						echo "</h4><br><p>Hari Lagi</p>";
                					}
                				@endphp
                			</b>
                		</div>
                	</div>
                	@elseif($ev->count() < 1 || $ev == null)
                  <div class="container">
                		<h5>Belum ada event untuk beberapa saat ini</h5>
                  </div>
                  @else
                  <div class="container">
                    <h5>Belum ada event untuk beberapa saat ini</h5>
                  </div>
                	@endif
                </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- End upcoming-event Area -->
@endsection