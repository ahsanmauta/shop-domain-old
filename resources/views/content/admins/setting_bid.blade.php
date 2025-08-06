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
  <form class="card-body" action="{{route('admin.setting-bid-save')}}" method="POST" enctype="multipart/form-data" >
  @csrf
  @method('POST')

          <h4 class="mb-1">Setting Bid</h4>
    
    <div class="row g-6">
      <div class="col-md-12">
        <label class="form-label" for="multicol-username">Min. Saldo</label>
        <input type="text" id="minSaldoBid" name="minSaldoBid" class="form-control" placeholder="" value="{{ config('variables.minSaldoBid') }}"  />
      </div>
    </div>

    <div class="pt-6">
      <button type="submit" class="btn btn-primary me-4">Submit</button>
      <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>
  </form>
</div>

         
@endsection
