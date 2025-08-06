@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'My Bids - Pages')

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
	  <!-- Last Transaction -->
	  <div class="col-lg-12 mb-12">
		<div class="card h-100">
		  <div class="card-header d-flex justify-content-between align-items-center">
			<h5 class="card-title m-0 me-2">Bid Winners</h5>
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
		  	@php
			use Illuminate\Support\Facades\Session;
			@endphp
			@if(Session::has('message'))
			<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
			@endif
		  <div class="table-responsive" style="margin:20px;" >
			<table class="table table-borderless border-top datatables-projects"  >
			  <thead class="border-bottom">
				<tr>
				  <th>&nbsp;</th>
				  <th>Bid Domain</th>
				  <th>Bid Price</th>
				  <th>Bid Date</th>
				</tr>
			  </thead>
			  <tbody>
				@foreach($auctions as $auction)
				<tr>
				  <td class="pt-5">
				  <div class="ms-auto">
					<div class="dropdown z-2">
					  <button type="button" class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md text-muted"></i></button>
					  <ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item" href="{{ route('bidview',$auction->idauction) }}">View Bids</a></li>
						<li><a class="dropdown-item" href="{{ route('users.payment',$auction->idauction) }}">Payment by duitku</a></li>
					  </ul>
					</div>
				  </div>
				  </td>
				  <td class="pt-5">
					<p class="mb-0 text-heading">{{ $auction->domain }}</p>
					<small>status : 
					@php
						
						$jumlahbids = App\Models\Bids::where('idauction',$auction->idauction)
										->get()
										->count();
										
										
					@endphp
					@if($auction->bidstatus==1 or $auction->bidstatus==null)
						<span class="badge bg-secondary bg-glow">open</span><span class="badge badge-center rounded-pill bg-label-primary">{{ $jumlahbids }}</span>
					@endif
					@if($auction->bidstatus==2)
						<span class="badge bg-warning bg-glow">win</span><span class="badge badge-center rounded-pill bg-label-primary">{{ $jumlahbids }}</span>
					@endif
					@if($auction->bidstatus==3)
						<span class="badge bg-success bg-glow">paid</span><span class="badge badge-center rounded-pill bg-label-primary">{{ $jumlahbids }}</span>
					@endif
					</small>
				  </td>
				  <td class="pt-5">
					<p class="mb-0 text-heading">${{ $auction->bidprice }}</p>
				  </td>
				  <td class="pt-5">
					<p class="mb-0 text-heading">{{ $auction->created_at }}</p>
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
