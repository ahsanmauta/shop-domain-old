@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Bid Now - Pages')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
  'resources/assets/vendor/libs/apex-charts/apex-charts.scss',
  'resources/assets/vendor/libs/swiper/swiper.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  'resources/assets/vendor/libs/jquery-timepicker/jquery-timepicker.scss',
  'resources/assets/vendor/libs/pickr/pickr-themes.scss'
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
  'resources/assets/vendor/libs/flatpickr/flatpickr.js',
  'resources/assets/vendor/libs/apex-charts/apexcharts.js',
  'resources/assets/vendor/libs/swiper/swiper.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js',
  'resources/assets/vendor/libs/pickr/pickr.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/config.js',
  'resources/assets/js/pages-auth.js',
  'resources/assets/js/cards-advance.js',
  'resources/assets/js/forms-pickers.js'
])

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
  

    <!-- Popular Product -->
  <div class="col-md-6 col-lg-6 col-md-6">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between">
        <div class="card-title m-0 me-2">
          <h5 class="mb-1">Payment</h5>
        </div>
        <div class="dropdown">
          
        </div>
      </div>
      <div class="card-body">
        <div class="offcanvas-header border-bottom">
			<h5 class="offcanvas-title">Add Payment</h5>
			<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		  </div>
		  <div class="offcanvas-body flex-grow-1">
			<div class="d-flex justify-content-between bg-lighter p-2 mb-4">
			  <p class="mb-0">Invoice Balance:</p>
			  @php
					use Illuminate\Support\Facades\Auth;
			  @endphp
			  <p class="fw-medium mb-0">${{ number_format($bids->bidprice,2,".",",") }}</p>
			</div>
			<form name="payment-form" id="payment-form" method="post" action="{{route('users.paymentsend')}}" >
			@csrf
			  <div class="mb-6">
				<label class="form-label" for="invoiceAmount">Deposit Amount</label>
				<div class="input-group">
				  <span class="input-group-text">$</span>
				  <input type="text" id="invoiceDeposit" name="invoiceDeposit" class="form-control invoice-amount" placeholder="100" value="{{ $saldo }}" />
				  <input type="hidden" name="idbid" id="idbid" value="{{ $bids->id }}" />
				</div>
			  </div>
			  <div class="mb-6">
				<label class="form-label" for="invoiceAmount">Payment Amount</label>
				<div class="input-group">
				  <span class="input-group-text">$</span>
				  <input type="text" id="invoiceAmount" name="invoiceAmount" class="form-control invoice-amount" placeholder="100" value="{{ $bids->bidprice }}" />
				  <input type="hidden" name="idbid" id="idbid" value="{{ $bids->id }}" />
				</div>
			  </div>
			  <div class="mb-6">
				<label class="form-label" for="payment-date">Payment Date</label>
				<input id="flatpickr-date" name="payment-date" class="form-control invoice-date" type="text" value="{{ date('Y-m-d') }}" />
			  </div>
			  <div class="mb-6">
				<label class="form-label" for="payment-method">Payment Method</label>
				<select class="form-select" id="payment-method" name="payment-method" >
				    <option value="" selected disabled>Select payment method</option>
				    @foreach($tipebayar as $tipe)
					<option value="{{ $tipe['paymentMethod'] }}">{{ $tipe['paymentName'] }}</option>
					@endforeach
				</select>
			  </div>
			  <div class="mb-6">
				<label class="form-label" for="payment-note">Internal Payment Note</label>
				<textarea class="form-control" id="payment-note" name="payment-note" rows="2"></textarea>
			  </div>
			  <div class="mb-6 d-flex flex-wrap">
				<button type="button" class="btn btn-primary me-4" data-bs-dismiss="offcanvas" onclick="document.getElementById('payment-form').submit();" >Send</button>
				<button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
			  </div>
			</form>
		  </div>
      </div>
    </div>
  </div>
  <!--/ Popular Product -->

  
</div>

@endsection
