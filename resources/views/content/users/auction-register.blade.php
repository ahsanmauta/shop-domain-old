@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Register Basic - Pages')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  'resources/assets/vendor/libs/flatpickr/flatpickr.scss'
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
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/flatpickr/flatpickr.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/pages-auth.js',
  'resources/assets/js/forms-pickers.js'
])

@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">




<!-- Multi Column with Form Separator -->
<div class="card mb-6" style="margin-top:100px;" >
  <form class="card-body" action="{{route('users.auction.store')}}" method="POST" >
  @csrf

          <h4 class="mb-1">Create Auction</h4>
    
    <div class="row g-6">
      <div class="col-md-12">
        <label class="form-label" for="multicol-username">Domain Name</label>
        <input type="text" id="domain" name="domain" class="form-control" placeholder="" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">Domain Category</label>
        <select id="category" name="category" class="select2 form-select" data-allow-clear="true">
          <option value="">Select</option>
          <option value="Entertainment">Entertainment</option>
          <option value="Government">Government</option>
          <option value="Travel">Travel</option>
          <option value="Sport">Sport</option>
          <option value="Newspaper">Newspaper</option>
          <option value="Community">Community</option>
          <option value="Forum">Forum</option>
          <option value="E-commerce">E-commerce</option>
          <option value="Review">Review</option>
          <option value="Directory">Directory</option>
          <option value="Blog">Blog</option>
        </select>
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">Domain Price</label>
		<div class="input-group">
		  <span class="input-group-text">$</span>
		  <input type="number" id="price" name="price" class="form-control" placeholder="" />
		</div>
        
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">When did you register the domain?</label>
		<input type="text" class="form-control flatpickr-validation" id="flatpickr-date" name="register" required="">
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">Auction End Time</label>
        <input type="text" class="form-control flatpickr-validation" id="flatpickr-multi" name="endtime" required="">
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-country">Your Country</label>
        <select id="country" name="country" class="select2 form-select" data-allow-clear="true">
          <option value="">Select</option>
          <option value="Australia">Australia</option>
          <option value="Bangladesh">Bangladesh</option>
          <option value="Belarus">Belarus</option>
          <option value="Brazil">Brazil</option>
          <option value="Canada">Canada</option>
          <option value="China">China</option>
          <option value="France">France</option>
          <option value="Germany">Germany</option>
          <option value="India">India</option>
          <option value="Indonesia">Indonesia</option>
          <option value="Israel">Israel</option>
          <option value="Italy">Italy</option>
          <option value="Japan">Japan</option>
          <option value="Korea">Korea, Republic of</option>
          <option value="Mexico">Mexico</option>
          <option value="Philippines">Philippines</option>
          <option value="Russia">Russian Federation</option>
          <option value="South Africa">South Africa</option>
          <option value="Thailand">Thailand</option>
          <option value="Turkey">Turkey</option>
          <option value="Ukraine">Ukraine</option>
          <option value="United Arab Emirates">United Arab Emirates</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="United States">United States</option>
        </select>
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-phone">Domain Traffic</label>
        <input type="number" id="traffic" name="traffic" class="form-control phone-mask" placeholder="" aria-label="658 799 8941" />
      </div>
	  
	  <div class="col-md-12">
        <label class="form-label" for="multicol-first-name">About the domain</label>
        <textarea class="form-control" id="about" name="about" rows="6" ></textarea>
      </div>
	  <div class="col-md-12">
        <label class="form-label" for="multicol-first-name">Seller Note [optional]</label>
        <textarea class="form-control" id="sellernote" name="sellernote" rows="6" ></textarea>
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
