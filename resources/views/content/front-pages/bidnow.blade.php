@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Bid Now - Pages')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/apex-charts/apex-charts.scss',
  'resources/assets/vendor/libs/swiper/swiper.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
<style>
.flex-container {
  display: flex;
  flex-direction: row;
  margin-left: auto;
  margin-right: auto;
}

.kotak {
  width:168px;
  float:left;	
}

.space-kotak {
  margin-left:20px;
}

.text-counter {
  font-size:26px;
  color:#042d63;
}

/* Responsive layout - makes a one column layout instead of a two-column layout */
@media (max-width: 800px) {
  .flex-container {
	flex-direction: column;
	margin-left: 0px;
    margin-right: 0px;
  }
  
  .kotak {
	  width:155px;
	  float:left;	
	}
	
  .space-kotak {
	  margin-left:0px;
  }

}




</style>
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/apex-charts/apexcharts.js',
  'resources/assets/vendor/libs/swiper/swiper.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/config.js',
  'resources/assets/js/pages-auth.js',
  'resources/assets/js/cards-advance.js'
])
<script>
// Set the date we're counting down to
var countDownDate = new Date("{{ $auction->endtime }}").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  
  document.getElementById("days").innerHTML = days;
  document.getElementById("hours").innerHTML = hours;
  document.getElementById("minutes").innerHTML = minutes;
  document.getElementById("seconds").innerHTML = seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
  }
}, 1000);
</script>
@endsection

<div style="margin-top:150px;">
@section('content')
	@php
		use Illuminate\Support\Facades\Session;
		
	  @endphp
	@if(Session::get('message')!=null)
		
				<div class="col-md-6 alert alert-warning" role="alert" style="margin-left: auto;margin-right: auto;">
          
				{{ Session::get('message') }}
				</div>

	  @endif
</div>
	  
<div class="raw flex-container col-md-10" style="margin-top:50px;" >  
  <div class="col-md-6 col-lg-6 col-md-6">
    <div class="card">
      <div class="card-header pb-4">
        <div class="d-flex align-items-start">
          <div class="d-flex align-items-center">
            <div class="avatar me-4">
              <img src="{{ asset('assets/img/icons/brands/social-label.png') }}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="me-2">
              <h5 class="mb-0"><a href="javascript:;" class="stretched-link text-heading">{{ $auction->domain }}</a></h5>
              <div class="client-info text-body"><span class="fw-medium">Category: </span><span>{{ $auction->category }}</span></div>
            </div>
          </div>
          <div class="ms-auto">
            <div class="dropdown z-2">
              <button type="button" class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md text-muted"></i></button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">View Bids</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">View Creator</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex align-items-center flex-wrap">
          <div class="bg-lighter px-3 py-2 rounded me-auto mb-4" style="width:200px;" >
            <p class="mb-1"><span class="fw-medium text-heading">$ {{ number_format($auction->price,2,".",",") }}</span></p>
            <span class="text-body">Domain Price</span>
          </div>
          <div class="text-start mb-4">
            <p class="mb-1"><span class="text-heading fw-medium">Register Date: </span> <span>{{ $auction->register }}</span></p>
            <p class="mb-1"><span class="text-heading fw-medium">Time End: </span> <span>{{ $auction->endtime }}</span></p>
          </div>
        </div>
        <p class="mb-0">{{ $auction->about }}</p>
      </div>
      <div class="card-body border-top">
        <div class="d-flex align-items-center mb-4">
          <p class="mb-1"><span class="text-heading fw-medium">Bid High Price: </span> <span>$ {{ ((isset($maxprice))?number_format($maxprice->bidprice,2,".",","):'') }}</span></p>
        </div>
        <div class="d-flex align-items-center">
          <div class="d-flex align-items-center">
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske" class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol" class="avatar avatar-sm pull-up me-3">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar">
              </li>
              <li><small class="text-muted">{{ $bidcount }} Bids</small></li>
            </ul>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  

  <div class="col-md-12 col-xxl-3 mb-6 space-kotak" >
    <div class="card h-100">
      <div class="card-body">
        
		
		<div class="col-md-12 "  >
			<div class="card kotak" >
			  <div class="row g-0 "  >
				<div class="col-md-12" style="padding: 18px 24px;background-color: #e28743" >
				  <center><div id="days" class="text-counter" >0</div></center> 
				</div>
			  </div>
			  <div class="row g-0">
				<div class="col-md-12" style="padding: 5px 24px;background-color: #e28743" >
				  <center>day</center>
				</div>
			  </div>
			</div>
			<div class="card kotak"  >
			  <div class="row g-0 ">
				<div class="col-md-12" style="padding: 18px 24px;background-color: #abdbe3" >
				  <center><div id="hours" class="text-counter"  >0</div></center>
				</div>
			  </div>
			  <div class="row g-0">
				<div class="col-md-12" style="padding: 5px 24px;background-color: #abdbe3" >
				  <center>hours</center>
				</div>
			  </div>
			</div>
			<div class="card kotak"  >
			  <div class="row g-0 ">
				<div class="col-md-12" style="padding: 18px 24px;background-color: #dbe5e4" >
				  <center><div id="minutes" class="text-counter"  >0</div></center> 
				</div>
			  </div>
			  <div class="row g-0">
				<div class="col-md-12" style="padding: 5px 24px;background-color: #dbe5e4" >
				  <center>minutes</center>
				</div>
			  </div>
			</div>
			<div class="card kotak" style="float:none;"   >
			  <div class="row g-0 ">
				<div class="col-md-12" style="padding: 18px 24px;background-color: #8dd9e9" >
				  <center><div id="seconds" class="text-counter"  >0</div></center>  
				</div>
			  </div>
			  <div class="row g-0">
				<div class="col-md-12" style="padding: 5px 24px;background-color: #8dd9e9" >
				  <center>second</center>
				</div>
			  </div>
			</div>
		  </div>
		  
		  <br>
		
		<form action="{{route('users.bidsave')}}" method="POST" id="formbid" >  
		@csrf
		<div class="col-md-12"  >
			<div class="card col-md-12"  >
			  <div class="row g-0">
				<div class="col-md-4">
				  <img class="card-img card-img-left" src="{{ asset('assets/img/illustrations/girl-with-laptop.png') }}" alt="Card image" />
				</div>
				<div class="col-md-8">
				  <div class="card-body">
					<h5 class="card-title">Bid Price</h5>
					<p class="card-text">
					  <input type="hidden" id="idauction" name="idauction" value="{{ $auction->id }}" />
					  <input type="number" id="price" name="price" class="form-control" placeholder="" />
					  <input type="hidden" id="minprice" name="minprice" value="{{ $minprice }}" />
					</p>
					<p class="card-text"><small class="text-muted">Min Price $ {{ number_format($minprice,2,".",",") }}</small></p>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		 
		 <p>&nbsp;</p>
  
        <a href="javascript:void(0);" class="btn btn-primary w-100" onclick="document.getElementById('formbid').submit()" >Submit</a>
		</form>
	
      </div>
    </div>
  </div>
  <!--/ Upcoming Webinar -->

  
</div>

@endsection
