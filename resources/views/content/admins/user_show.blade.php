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
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/pages-auth.js'
])
@endsection

@section('content')

<!-- Multi Column with Form Separator -->
<div class="card mb-6">
  <form class="card-body" action="#" method="POST" enctype="multipart/form-data" >


          <h4 class="mb-1">User Show</h4>
    
    <div class="row g-6">
      <div class="col-md-6">
        <label class="form-label" for="multicol-username">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="" value="{{$user->name}}" readonly />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-username">Email</label>
        <input type="text" id="email" name="email" class="form-control" placeholder="" value="{{$user->email}}" readonly />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-username">Firstname</label>
        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="" value="{{$user->firstname}}" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-username">Lastname</label>
        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="" value="{{$user->lastname}}" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-country">Country</label>
        <select id="country" name="country" class="select2 form-select" data-allow-clear="true">
          <option value="">Select</option>
          @foreach($country as $ct)
			@if($user->country==$ct->iso)
				<option value="{{ $ct->iso }}" selected >{{ $ct->nicename }}</option>
			@else
				<option value="{{ $ct->iso }}">{{ $ct->nicename }}</option>
			@endif
		  @endforeach
        </select>
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-phone">Phone No</label>
        <input type="text" id="mobile" name="mobile" value="{{$user->mobile}}" class="form-control phone-mask" placeholder="" aria-label="658 799 8941" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">Address</label>
        <input type="text" id="address" name="address" value="{{$user->address}}" class="form-control" placeholder="" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">State</label>
        <input type="text" id="state" name="state" value="{{$user->state}}" class="form-control" placeholder="" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">Zip Code</label>
        <input type="text" id="zipcode" name="zipcode" value="{{$user->zipcode}}" class="form-control" placeholder="" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">City</label>
        <input type="text" id="city" name="city" value="{{$user->city}}" class="form-control" placeholder="" />
      </div>
    </div>


  </form>
</div>

         
@endsection
