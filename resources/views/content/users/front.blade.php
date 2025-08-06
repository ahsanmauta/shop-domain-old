@php
use Illuminate\Support\Facades\Auth;
use App\Models\Auctions;
use App\Models\Bids;
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Landing - Front Pages')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/nouislider/nouislider.scss',
  'resources/assets/vendor/libs/swiper/swiper.scss'
])
<link rel="stylesheet" href="{{ url('css/line-awesome.min.css') }}">
<link rel="stylesheet" href="{{ url('css/jquery-ui.css') }}">
@endsection

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
<link rel="stylesheet" href="{{ url('css/maindomain.css') }}">
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/nouislider/nouislider.js',
  'resources/assets/vendor/libs/swiper/swiper.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')

   <script src="{{ url('js/jquery-3.7.1.min.js') }}"></script>
   <script src="{{ url('js/jquery-ui.js') }}"></script>
   

@endsection


@section('content')
		
		<div class="container" style="margin-top:100px;min-height: calc(-457px + 100vh);" >
			
			<div class="col-xl-12">
				<div class="card">
				  <div class="d-flex align-items-end row">
					<div class="col-7">
					  <div class="card-body text-nowrap">
						<h5 class="card-title mb-0">Congratulations {{ Auth::user()->firstname }}! 🎉</h5>
						<p class="mb-2">You can sell and buy domain, please check your balance or saldo. Thanks</p>
						<h4 class="text-primary mb-1">&nbsp;</h4>
						<a href="{{route('users.auction.create')}}" class="btn btn-primary">Domain Sell</a>
					  </div>
					</div>
					<div class="col-5 text-center text-sm-left">
					  <div class="card-body pb-0 px-0 px-md-4">
						<img src="{{ url('assets/img/card-advance-sale.png')}}" width="120px"  alt="view sales">
					  </div>
					</div>
				  </div>
				</div>
			  </div>
  
            <div class="row gy-4">
                <div class="col-lg-4 pe-4">
                    <div class="user-widget">
                        <div class="user-widget__top-shape"></div>
                        <div class="user-details mb-4">
                            <div class="shape-1"></div>
                            <div class="shape-2"></div>
                            <div class="thumb">
                                <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/avatars/1.png') }}" alt="image">
                            </div>
                            <div class="content">
                                <h5 class="text-white">tessaja</h5>
                                <span class="text-white fs--14px"><i class="fas fa-map-marker-alt me-1 text--base"></i>
                                    Indonesia</span>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-lg-12 col-md-4"  >
                                <div class="d-widget"   >
                                    <div class="d-widget__icon">$</div>
                                    <div class="d-widget__content"> <span class="caption">BALANCE</span>
                                        <h4 class="amount">${{ number_format(Auth::user()->saldo,2,".",",") }} USD</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-4">
                                <div class="d-widget">
                                    <a href="{{route('users.auction.index')}}" class="d-widget__btn">
                                        View All                                    </a>
                                    <div class="d-widget__icon"> <i class="las la-clipboard-list"></i></div>
                                    <div class="d-widget__content"> <span class="caption">AUCTION DOMAINS</span>
                                        <h4 class="amount">{{ number_format($jml_domains,0,".",",") }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-4">
                                <div class="d-widget">
                                    <a href="{{route('users.bidlist')}}" class="d-widget__btn">
                                        View All                                    </a>
                                    <div class="d-widget__icon"> <i class="las la-gavel"></i></div>
                                    <div class="d-widget__content">
                                        <span class="caption">TOTAL BIDS</span>
                                        <h4 class="amount">{{ number_format($jml_bids,0,".",",") }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-lg-8">
                    <!--div class="notice">
                <div class="row notification-alert">
                    <div class="col-lg-12">
                        <div class="custom--card mb-4">
                            <div class="card-header justify-content-between d-flex flex-wrap notice_notify">
                                <h5 class="alert-heading">Please Allow / Reset Browser Notification <i class="las la-bell text--danger"></i></h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 small">If you want to get push notification then you have to allow notification from your browser</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div-->
                                                                <!--div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">KYC Verification required</h4>
                            <hr>
                            <p class="mb-0"></p>
                        </div-->
                    
                    <div class="custom--card">
                        <div class="card-header border-bottom-0">
                            <h6><i class="las la-clipboard-list"></i> Your Domain List</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-responsive--md">
                                <table class="table custom--table">
                                    <thead>
                                        <tr style="background-color:#002033;" >
                                            <th>Domain</th>
                                            <th>Price</th>
                                            <th>Total Bids</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @if($jml_domains==0)
											<tr>
                                                <td colspan=" 100%" class="text-center" data-label="Domain">Data not found
                                                </td>
                                            </tr>
											@else
												@foreach($domains as $domain)
													@php
														$jmlbids = Auctions::join('auctionbids', 'auctionbids.idauction', '=', 'auction.id')
															->where('auctionbids.iduser',Auth::user()->id)
															->where('auction.id',$domain->id)
															->get()
															->count();
													@endphp
													
													<tr>
														<th>{{ $domain->domain }}</th>
														<th>${{ number_format($domain->price,2,".",",") }} USD</th>
														<th>{{ $jmlbids }}</th>
														<th>{{ $domain->endtime }}</th>
														<th>
														@php
						
														$bidstatus = App\Models\Bids::selectRaw('max(bidstatus) as bidstatus,count(id) as jumlah')
																		->where('idauction',$domain->id)->first();
																		
																		
														@endphp
														@if($bidstatus->bidstatus==1 or $bidstatus->bidstatus==null)
															<span class="badge bg-secondary bg-glow">open</span><span class="badge badge-center rounded-pill bg-label-primary">{{ $bidstatus->jumlah }}</span>
														@endif
														@if($bidstatus->bidstatus==2)
															<span class="badge bg-warning bg-glow">win</span><span class="badge badge-center rounded-pill bg-label-primary">{{ $bidstatus->jumlah }}</span>
														@endif
														@if($bidstatus->bidstatus==3)
															<span class="badge bg-success bg-glow">paid</span><span class="badge badge-center rounded-pill bg-label-primary">{{ $bidstatus->jumlah }}</span>
														@endif
														</th>
														<th>
														
														<div class="ms-auto">
														<div class="dropdown z-2">
														  <button type="button" class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md text-muted"></i></button>
														  <ul class="dropdown-menu dropdown-menu-end">
															<li><a class="dropdown-item" href="{{ route('bidview',$domain->id) }}">View Bids</a></li>
															<li><a class="dropdown-item" href="{{ route('users.bidwinnners',$domain->id) }}">Bid Winners</a></li>
														  </ul>
														</div>
													  </div>
														
														</th>
													</tr>	
												@endforeach
											@endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="custom--card mt-3">
                        <div class="card-header border-bottom-0">
                            <h6><i class="las la-clipboard-list"></i> Bid Domain List</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-responsive--md" >
                                <table class="table custom--table" >
                                    <thead>
                                        <tr style="background-color:#002033;" >
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Ends</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @if($jml_bids==0)
											<tr>
                                                <td colspan=" 100%" class="text-center" data-label="Name">Data not found</td>
                                            </tr>
											@else
												@foreach($bids as $bid)
													<tr>
														<th>{{ $bid->domain }}</th>
														<th>${{ number_format($bid->bidprice,2,".",",") }} USD</th>
														<th>{{ $bid->endtime }}</th>
														<th>
														@php
						
														$bidstatus = App\Models\Bids::selectRaw('max(bidstatus) as bidstatus,count(id) as jumlah')
																		->where('idauction',$bid->id)->first();
																		
																		
														@endphp
														@if($bidstatus->bidstatus==1 or $bidstatus->bidstatus==null)
															<span class="badge bg-secondary bg-glow">open</span><span class="badge badge-center rounded-pill bg-label-primary">{{ $bidstatus->jumlah }}</span>
														@endif
														@if($bidstatus->bidstatus==2)
															<span class="badge bg-warning bg-glow">win</span><span class="badge badge-center rounded-pill bg-label-primary">{{ $bidstatus->jumlah }}</span>
														@endif
														@if($bidstatus->bidstatus==3)
															<span class="badge bg-success bg-glow">paid</span><span class="badge badge-center rounded-pill bg-label-primary">{{ $bidstatus->jumlah }}</span>
														@endif
														</th>
														<th>
														<div class="ms-auto" >
														<div class="dropdown z-2"  >
														  <button type="button" class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical ti-md text-muted"></i></button>
														  <ul class="dropdown-menu dropdown-menu-end" >
															<li><a class="dropdown-item" href="{{ route('bidview',$bid->idauction) }}">View Bids</a></li>
															<li><a class="dropdown-item" href="{{ route('users.payment',$bid->idauction) }}">Payment by duitku</a></li>
															<li><a class="dropdown-item" href="{{ route('users.paypal-payment',$bid->idauction) }}">Payment by paypal</a></li>
														  </ul>
														</div>
													  </div>
														</th>
													</tr>
												@endforeach
											@endif
											
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<br>
@endsection
