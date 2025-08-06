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
  <form class="card-body" action="{{route('admin.setting-email-save')}}" method="POST" enctype="multipart/form-data" >
  @csrf
  @method('POST')

          <h4 class="mb-1">Setting Email</h4>
    
    <div class="row g-6">
      <div class="col-md-6">
        <label class="form-label" for="multicol-username">Mail Host</label>
        <input type="text" id="MAIL_HOST" name="MAIL_HOST" class="form-control" placeholder="" value="{{ env('MAIL_HOST') }}"  />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-username">Mail Port</label>
        <input type="text" id="MAIL_PORT" name="MAIL_PORT" class="form-control" placeholder="" value="{{ env('MAIL_PORT') }}"  />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-username">Mail Username</label>
        <input type="text" id="MAIL_USERNAME" name="MAIL_USERNAME" class="form-control" placeholder="" value="{{ env('MAIL_USERNAME') }}" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-username">Mail Password</label>
        <input type="password" id="MAIL_PASSWORD" name="MAIL_PASSWORD" class="form-control" placeholder="" value="{{ env('MAIL_PASSWORD') }}" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-phone">Mail Encryption</label>
        <input type="text" id="MAIL_ENCRYPTION" name="MAIL_ENCRYPTION" value="{{ env('MAIL_ENCRYPTION') }}" class="form-control phone-mask" placeholder="" aria-label="658 799 8941" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">Mail From Address</label>
        <input type="text" id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}" class="form-control" placeholder="" />
      </div>
	  <div class="col-md-6">
        <label class="form-label" for="multicol-first-name">Mail From Name</label>
        <input type="text" id="MAIL_FROM_NAME" name="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}" class="form-control" placeholder="" />
      </div>
    </div>

    <div class="pt-6">
      <button type="submit" class="btn btn-primary me-4">Submit</button>
      <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>
  </form>
</div>

         
@endsection
