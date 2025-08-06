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

</div>
	  
<div class="raw flex-container col-md-10" style="margin-top:50px;" >  
  

    <!-- Popular Product -->
  <div class="col-md-6 col-lg-6 col-md-6">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between">
        <div class="card-title m-0 me-2">
          <h5 class="mb-1">Deposit</h5>
        </div>
        <div class="dropdown">
          
        </div>
      </div>
      <div class="card-body">
        <div class="offcanvas-header border-bottom">
			<h5 class="offcanvas-title">Add Deposit</h5>
		  </div>
		  <div class="offcanvas-body flex-grow-1">
			<div class="d-flex justify-content-between bg-lighter p-2 mb-4">
			</div>
			<form name="payment-form" id="payment-form" method="post" action="{{route('users.deposit.store')}}" >
			@csrf
			  <div class="mb-6">
				<label class="form-label" for="invoiceAmount">Payment Amount</label>
				<div class="input-group">
				  <span class="input-group-text">$</span>
				  <input type="text" id="invoiceAmount" name="invoiceAmount" class="form-control invoice-amount" placeholder="0" value="" />
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
			@if(session('errors')!=null)
			<div class="alert alert-solid-info d-flex align-items-center" role="alert">
			  <span class="alert-icon rounded">
				<i class="ti ti-info-circle"></i>
			  </span>
			  {{session('errors')->first('message');}}
			</div>
		  @endif
		  	@if(Session::get('message')!=null)
				 <div class="alert alert-solid-info d-flex align-items-center" role="alert">
				  <span class="alert-icon rounded">
					<i class="ti ti-info-circle"></i>
				  </span>
				  {{ Session::get('message') }}
				</div>
			  @endif
		  </div>
      </div>
    </div>
  </div>
  <!--/ Popular Product -->
  

  
</div>
<p>&nbsp;</p>
@endsection
