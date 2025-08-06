@extends('layouts/layoutMaster')

@section('title', 'User List - Pages')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/moment/moment.js',
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/cleavejs/cleave.js',
  'resources/assets/vendor/libs/cleavejs/cleave-phone.js'
])
@endsection

@section('page-script')
@vite('resources/assets/js/app-general-table.js')
@endsection

@section('content')


<!-- Users List Table -->
<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title mb-0">Filters</h5>
    <div class="d-flex justify-content-between align-items-center row pt-4 gap-4 gap-md-0">
      <div class="col-md-4 user_role"></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead class="border-top">
        <tr>
          <th></th>
          <th></th>
          <th>User</th>
          <th>Address</th>
          <th>Saldo</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
	  
	<tbody>
    <tr class="odd">
        <td class="  control"></td>
        <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
        <td class="sorting_1">
            <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                    <div class="avatar avatar-sm me-4"><span class="avatar-initial rounded-circle bg-label-secondary">T</span></div>
                </div>
                <div class="d-flex flex-column"><a href="http://localhost:8000/app/user/view/account" class="text-heading text-truncate"><span class="fw-medium">tes</span></a><small>prajaw@gmail.com</small></div>
            </div>
        </td>
        <td><span class="text-truncate d-flex align-items-center text-heading">Jl. Tes saja</span></td>
        <td><span class="text-heading">10.00</span></td>
        <td></td>
        <td>
            <div class="d-flex align-items-center">
				<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill delete-record"><i class="ti ti-trash ti-md"></i></a>
				<a href="http://localhost:8000/app/user/view/account" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill"><i class="ti ti-eye ti-md"></i></a>
                <a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-md"></i></a>
                <div class="dropdown-menu dropdown-menu-end m-0"><a href="" class="dropdown-item ">Edit</a><a href="javascript:; " class="dropdown-item ">Suspend</a></div>
			</div>
		</td>
	  </tr>
	</tbody>	  
	  
    </table>
  </div>
</div>

@endsection
