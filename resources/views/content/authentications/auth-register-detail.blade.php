@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Register Basic - Pages')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
<link rel="stylesheet" href="{{ url('css/autoaddr.css') }}" type="text/css">
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
<script src="{{ url('js/autoaddr.js') }}"></script>
@endsection

@section('page-script')
@vite([
  'resources/assets/js/pages-auth.js'
])

@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">




<!-- Multi Column with Form Separator -->
<div class="card mb-6">
  <form class="card-body" action="{{route('auth-register-submit')}}" method="POST" >
  @csrf
	<!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{url('/')}}" class="app-brand-link">
              <span class="app-brand-logo demo"><img src="{{ url(config('variables.logo')) }}" width="30px"  /></span>
              <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.loginName') }}</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">User registration detail form</h4>
    
    <div class="row g-6">
      <div class="col-md-12">
        <label class="form-label" for="multicol-username">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-country">Country</label>
        <select id="country" name="country" class="select2 form-select" data-allow-clear="true">
          <option value="">Select</option>
          @foreach($country as $ct)
		  <option value="{{ $ct->iso }}">{{ $ct->nicename }}</option>
		  @endforeach
        </select>
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-phone">Phone No</label>
        <input type="text" id="mobile" name="mobile" class="form-control phone-mask" placeholder="" aria-label="658 799 8941" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">Address</label>
        
		<div class="autocomplete-container" id="autocomplete-container"></div>
		
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">State</label>
        <input type="text" id="state" name="state" class="form-control" placeholder="" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">Zip Code</label>
        <input type="text" id="zipcode" name="zipcode" class="form-control" placeholder="" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">City</label>
        <input type="text" id="city" name="city" class="form-control" placeholder="" />
      </div>
    </div>

    <div class="pt-6">
      <button type="submit" class="btn btn-primary me-4">Submit</button>
      <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>
  </form>
</div>

          
        


  </div>
</div>
@endsection
