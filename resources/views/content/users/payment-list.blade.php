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
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css" />
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script>
  new DataTable('.datatables-projects', {
    columnDefs: [
        {
            targets: [0],
            orderData: [0, 1]
        },
        {
            targets: [1],
            orderData: [1, 0]
        },
        {
            targets: [2],
            orderData: [2, 0]
        }
    ]
  });
</script>
@vite([
  'resources/assets/js/pages-auth.js'
])
@endsection

@section('content')
<div class="container-xxl">
	<div class="row" style="margin-top:100px;" >
	  <!-- Earning Reports -->
  <div class="col-lg-4 order-md-0 order-lg-0">
    <div class="card h-100">
      <div class="card-header pb-0 d-flex justify-content-between">
        <div class="card-title mb-0">
          <h5 class="mb-1">Information</h5>
          <p class="card-subtitle">Information Money Transaction</p>
        </div>
        
      </div>
      <div class="card-body">
        <div class="row align-items-center g-md-8">
          <div class="col-12 col-md-12 d-flex flex-column">
            <div class="d-flex gap-2 align-items-center mb-3 flex-wrap">
              <h2 class="mb-1">$
			  @php
				use Illuminate\Support\Facades\Auth;
				@endphp
				{{ Auth::user()->saldo }}
			</h2>
              <div class="badge rounded bg-label-success">{{ ($jmlDeposit>0)?number_format((($jmlDeposit-$jmlExpense)/$jmlDeposit)*100,2,".",","):'0' }} %</div>
            </div>

          </div>
          <div class="col-12 col-md-7 ps-xl-8">
            <div id="weeklyEarningReports"></div>
          </div>
        </div>
        <div class="border rounded p-5 mt-5">
          <div class="row gap-4 gap-sm-0">
            <div class="col-12 col-sm-6">
              <div class="d-flex gap-2 align-items-center">
                <div class="badge rounded bg-label-primary p-1"><i class="ti ti-currency-dollar ti-sm"></i></div>
                <h6 class="mb-0 fw-normal">Deposit</h6>
              </div>
              <h4 class="my-2">${{ $jmlDeposit }}</h4>
              <div class="progress w-75" style="height:4px">
                <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="d-flex gap-2 align-items-center">
                <div class="badge rounded bg-label-danger p-1"><i class="ti ti-brand-paypal ti-sm"></i></div>
                <h6 class="mb-0 fw-normal">Expense</h6>
              </div>
              <h4 class="my-2">${{ $jmlExpense }}</h4>
              <div class="progress w-75" style="height:4px">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
	  
	  
	  <!-- Last Transaction -->
	  <div class="col-lg-8 mb-8">
		<div class="card h-100">
		  <div class="card-header d-flex justify-content-between align-items-center">
			<h5 class="card-title m-0 me-2">My Payments</h5>
			<div class="dropdown">
			  <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="teamMemberList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="ti ti-dots-vertical ti-md text-muted"></i>
			  </button>
			  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="teamMemberList">
				<a class="dropdown-item" href="javascript:void(0);">Download</a>
				<a class="dropdown-item" href="javascript:void(0);">Refresh</a>
				<a class="dropdown-item" href="javascript:void(0);">Share</a>
			  </div>
			</div>
		  </div>
		  <div class="table-responsive" style="margin:20px;" >
			<table class="table table-borderless border-top datatables-projects"  >
			  <thead class="border-bottom">
				<tr>
				  <th>&nbsp;</th>
				  <th>Date</th>
				  <th>Payment Method</th>
				  <th>Note</th>
				  <th>Amount</th>
				</tr>
			  </thead>
			  <tbody>
				@foreach($payments as $payment)
				<tr>
				  <td class="pt-5">
				  <div class="ms-auto">
					<div class="dropdown z-2">
					  <button type="button" class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md text-muted"></i></button>
					  <ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item" href="#">Show Detail</a></li>
					  </ul>
					</div>
				  </div>
				  </td>
				  <td class="pt-5">
					<p class="mb-0 text-heading">{{ $payment->tanggal }}</p>		
				  </td>
				  <td class="pt-5">
					<p class="mb-0 text-heading">{{ $payment->tipebayar }}</p>
				  </td>
				  <td class="pt-5">
					<p class="mb-0 text-heading">{{ $payment->note }}</p>
				  </td>
				  <td class="pt-5">
					<p class="mb-0 text-heading">${{ $payment->amount }}</p>
				  </td>
				</tr>
				@endforeach
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	  <!--/ Last Transaction -->
	</div>
  
</div>

@endsection
