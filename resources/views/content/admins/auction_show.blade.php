@extends('layouts/layoutMaster')

@section('title', 'User View - Pages')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
  'resources/assets/vendor/libs/animate-css/animate.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-user-view.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/moment/moment.js',
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
  'resources/assets/vendor/libs/cleavejs/cleave.js',
  'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/modal-edit-user.js',
  'resources/assets/js/app-user-view.js',
  'resources/assets/js/app-user-view-account.js',
  'resources/assets/js/auction-show.js'
])
@endsection

@section('content')
<div class="row">
  <!-- User Sidebar -->
  <div class="col-xl-4 col-lg-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-6">
      <div class="card-body pt-12">
        <div class="user-avatar-section">
          <div class=" d-flex align-items-center flex-column">
            <img class="img-fluid rounded mb-4" src="{{ asset('assets/img/avatars/1.png') }}" height="120" width="120" alt="User avatar" />
            <div class="user-info text-center">
              <h5>{{ $userauction->firstname.' '.$userauction->lastname }}</h5>
              <span class="badge bg-label-secondary">{{ $userauction->email }}</span>
            </div>
          </div>
        </div>

        <h5 class="pb-4 border-bottom mb-4">Details</h5>
        <div class="info-container">
          <ul class="list-unstyled mb-6">
            <li class="mb-2">
              <span class="h6">Domain:</span>
              <span>{{ $auctions->domain }}</span>
			  <input type="hidden" name="idauction" id="idauction" value="{{ $auctions->id }}" />
            </li>
            <li class="mb-2">
              <span class="h6">Category:</span>
              <span>{{ $auctions->category }}</span>
            </li>
            <li class="mb-2">
              <span class="h6">Price:</span>
              <span>{{ $auctions->price }}</span>
            </li>
            <li class="mb-2">
              <span class="h6">Register:</span>
              <span>{{ $auctions->register }}</span>
            </li>
            <li class="mb-2">
              <span class="h6">End Time:</span>
              <span>{{ $auctions->endtime }}</span>
            </li>
            <li class="mb-2">
              <span class="h6">Country:</span>
              <span>{{ $auctions->country }}</span>
            </li>
            <li class="mb-2">
              <span class="h6">Traffic:</span>
              <span>{{ $auctions->traffic }}</span>
            </li>
            <li class="mb-2">
              <span class="h6">About:</span>
              <span>{{ $auctions->about }}</span>
            </li>
			<li class="mb-2">
              <span class="h6">Note:</span>
              <span>{{ $auctions->sellernote }}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /User Card -->

  </div>
  <!--/ User Sidebar -->


  <!-- User Content -->
  <div class="col-xl-8 col-lg-7 order-0 order-md-1">
    <!-- User Pills -->
    <div class="nav-align-top">
      <ul class="nav nav-pills flex-column flex-md-row flex-wrap mb-6 row-gap-2">
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="ti ti-user-check ti-sm me-1_5"></i>Bids</a></li>
      </ul>
    </div>
    <!--/ User Pills -->

    <!-- Project table -->
    <div class="card mb-6">
      <div class="card-datatable table-responsive">
        <table class="datatables-projects table border-top">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th>Bid User</th>
              <th>Bid Price</th>
              <th>Bid Status</th>
			  <th>Bid Date</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <!-- /Project table -->

  </div>
  <!--/ User Content -->
</div>


@endsection
