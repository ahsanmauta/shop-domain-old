@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Modals - UI elements')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  'resources/assets/vendor/libs/bs-stepper/bs-stepper.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/cleavejs/cleave.js',
  'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/bs-stepper/bs-stepper.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite([
  'resources/assets/js/pages-pricing.js',
  'resources/assets/js/modal-create-app.js',
  'resources/assets/js/modal-add-new-cc.js',
  'resources/assets/js/modal-add-new-address.js',
  'resources/assets/js/modal-edit-user.js',
  'resources/assets/js/modal-enable-otp.js',
  'resources/assets/js/modal-share-project.js',
  'resources/assets/js/modal-two-factor-auth.js'
])
@endsection

@section('content')
<div class="row mb-6">
  <!--  Profile -->
  <div class="col-12 col-sm-6 col-lg-4 mb-6">
    <div class="card">
      <div class="card-body text-center">
        <i class="mb-4 text-heading ti ti-home ti-32px"></i>
        <h5>Template</h5>
        <p>Setting Template Website</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pricingModal" onclick="location.href='{{ url('admin/setting/profile') }}';" > Change </button>
      </div>
    </div>
  </div>
  <!--/  Pricing -->

  <!--  Duitku -->
  <div class="col-12 col-sm-6 col-lg-4 mb-6">
    <div class="card">
      <div class="card-body text-center">
        <i class="mb-4 text-heading ti ti-currency-dollar ti-32px"></i>
        <h5>Duitku</h5>
        <p>Payment Gateway Duitku</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewCCModal" onclick="location.href='{{ url('admin/setting/duitku') }}';" > Change </button>
      </div>
    </div>
  </div>
  <!--/  Duitku -->

  <!--  Paypal -->
  <div class="col-12 col-sm-6 col-lg-4 mb-6">
    <div class="card">
      <div class="card-body text-center">
        <i class="mb-4 text-heading ti ti-currency-dollar ti-32px"></i>
        <h5>Paypal</h5>
        <p>Payment Gateway Paypal</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewAddress" onclick="location.href='{{ url('admin/setting/paypal') }}';" > Change </button>
      </div>
    </div>
  </div>
  <!--/  Paypal -->

  <!--  Email -->
  <div class="col-12 col-sm-6 col-lg-4 mb-6">
    <div class="card">
      <div class="card-body text-center">
        <i class="mb-4 text-heading ti ti-mail ti-32px"></i>
        <h5>Email</h5>
        <p>Setting SMTP Email</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#referAndEarn" onclick="location.href='{{ url('admin/setting/email') }}';" > Change </button>
      </div>
    </div>
  </div>
  <!--/  Email -->
  
  <!--  Email -->
  <div class="col-12 col-sm-6 col-lg-4 mb-6">
    <div class="card">
      <div class="card-body text-center">
        <i class="mb-4 text-heading ti ti-mail ti-32px"></i>
        <h5>Bid</h5>
        <p>Setting Bid</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#referAndEarn" onclick="location.href='{{ url('admin/setting/bid') }}';" > Change </button>
      </div>
    </div>
  </div>
  <!--/  Email -->

 

</div>



@endsection
