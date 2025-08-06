@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Domains - Pages')

@section('vendor-style')
<link rel="stylesheet" href="{{ url('css/line-awesome.min.css') }}">
<link rel="stylesheet" href="{{ url('css/jquery-ui.css') }}">
@vite([
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])

<link rel="stylesheet" href="{{ url('css/maindomain.css') }}">
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])

@endsection

@section('page-script')
   
   <script src="{{ url('js/jquery-3.7.1.min.js') }}"></script>
   <script src="{{ url('js/jquery-ui.js') }}"></script>


<script>

    (function($){
        'use strict';

        let page = null;

        $('.DomainPaginate').val(20);

        $('.action-sidebar-open').on('click', function(){
          $('.action-sidebar').addClass('active');
        });

        $('.action-sidebar-close').on('click', function(){
          $('.action-sidebar').removeClass('active');
        });

        $('.action-widget__title').each(function(){
          let ele = $(this).siblings('.action-widget__body');
          $(this).on('click', function(){
            ele.slideToggle();
          });
        });

        $('.slider-range').each(function(){
          var rangeSlider = $(this);
          var maxValue = rangeSlider.attr('data-max');

          var slideAmount = $(this).siblings('.amount__field').children('.range-amount');

          $(rangeSlider).slider({
            range: true,
            min: 1.00000000,
            max: 200.00000000,
            values: [1.00000000, 200.00000000],
            slide: function( event, ui ) {
              $(slideAmount).val( "$" + ui.values[ 0 ] + " to $" + ui.values[ 1 ] );
              $('input[name=min_price]').val(ui.values[ 0 ]);
              $('input[name=max_price]').val(ui.values[ 1 ]);
            },
            change: function(){
                fetchDomain();
            }
          });

          $(slideAmount).val( "$" + $(rangeSlider).slider( "values", 0 ) +
            " to $" + $(rangeSlider).slider( "values", 1 ) );
        });

        $('.myExtention, .list_short, .searchBtn').on('click', function () {
            if($('#all-checkbox').is(':checked')){
                $("input[type='checkbox'][name='extension']").not(this).prop('checked', false);
            }
            fetchDomain();
        });

        $('.DomainPaginate').on('change',function(e){
            fetchDomain();
        });

        function fetchDomain(){
            let data = {};
            data.sort = $("input[type='radio'][name='list_sort']:checked").val();
            data.min = $('input[name="min_price"]').val();
            data.max = $('input[name="max_price"]').val();
            data.search = $('.mySearch').val();
            data.paginateValue = $('.DomainPaginate').find(":selected").val();
            data.extensions = [];

            $.each($("input[name=extension]:checked"), function() {
                if($(this).val()){
                    data.extensions.push($(this).val());
                }
            });
            //let url =  `https://script.viserlab.com/afterlab/domain/filter`;
			let url =  `{{ route('domains-filter') }}`;
			
            if(page){
                url = `{{ route('domains-filter') }}?page=${page}`;
            }
            $.ajax({
                method: "get",
                url:url,
                data: data,
                success: function(response){
                    $('#showDomain').html(response);
                }
            });
        }

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            page = $(this).attr('href').split('page=')[1];
            fetchDomain();
        });
		

    })(jQuery);
	

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
			<h5 class="card-title m-0 me-2">All Domains</h5>
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
			
			
			<div class="main-wrapper">
					<div class="pt-50 pb-50">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 pe-xl-4">
								<div class="action-sidebar">
									<button type="button" class="action-sidebar-close"><i class="las la-times"></i></button>
									<div class="action-widget pt-0 pb-2">
										<div class="action-widget__body">
											<h4>Filter</h4>
										</div>
									</div>
									<div class="action-widget">
										<h4 class="action-widget__title">Keyword</h4>
										<div class="action-widget__body">
											<div class="search-form-inline">
												<input type="text" name="search" value="" class="form--control form-control-sm mySearch" placeholder="Search here" id="search">
												<button class="search-form-inline__btn searchBtn">
													<i class="las la-search"></i>
												</button>
											</div>
										</div>
									</div>
									<div class="action-widget">
										<h4 class="action-widget__title">Domain Extensions</h4>
										<div class="action-widget__body">
											<div class="row">
												<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="all-checkbox" value="" checked="">
														<label class="form-check-label" for="all-checkbox">
															All                                        </label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-1" value=".com">
														<label class="form-check-label" for="chekbox-1">
															.com
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-2" value=".net">
														<label class="form-check-label" for="chekbox-2">
															.net
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-3" value=".org">
														<label class="form-check-label" for="chekbox-3">
															.org
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-4" value=".io">
														<label class="form-check-label" for="chekbox-4">
															.io
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-5" value=".me">
														<label class="form-check-label" for="chekbox-5">
															.me
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-6" value=".info">
														<label class="form-check-label" for="chekbox-6">
															.info
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-7" value=".dev">
														<label class="form-check-label" for="chekbox-7">
															.dev
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-8" value=".in">
														<label class="form-check-label" for="chekbox-8">
															.in
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-9" value=".bd">
														<label class="form-check-label" for="chekbox-9">
															.bd
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-10" value=".uk">
														<label class="form-check-label" for="chekbox-10">
															.uk
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-11" value=".bd.edu">
														<label class="form-check-label" for="chekbox-11">
															.bd.edu
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-12" value=".co">
														<label class="form-check-label" for="chekbox-12">
															.co
														</label>
													</div>
												</div>
																				<div class="col-lg-4">
													<div class="form-check custom--checkbox">
														<input class="form-check-input myExtention" type="checkbox" name="extension" id="chekbox-13" value=".sg">
														<label class="form-check-label" for="chekbox-13">
															.sg
														</label>
													</div>
												</div>
																			</div>
										</div>
									</div>
									<div class="action-widget">
										<h4 class="action-widget__title">Listing Sort</h4>
										<div class="action-widget__body">

											<div class="form-check custom--radio mb-2">
												<input class="list_short form-check-input" type="radio" name="list_sort" id="all" value="" checked="">
												<label class="form-check-label" for="all">All</label>
											</div>

											<div class="form-check custom--radio mb-2">
												<input class="list_short form-check-input" type="radio" name="list_sort" id="sort2" value="id_desc">
												<label class="form-check-label" for="sort2">Newly Listed</label>
											</div>

											<div class="form-check custom--radio mb-2">
												<input class="list_short form-check-input" type="radio" name="list_sort" id="sort3" value="id_asc">
												<label class="form-check-label" for="sort3">Ending Soon</label>
											</div>
											<div class="form-check custom--radio mb-2">
												<input class="list_short form-check-input" type="radio" name="list_sort" id="sort4" value="price_asc">
												<label class="form-check-label" for="sort4">Low to High</label>
											</div>
											<div class="form-check custom--radio mb-2">
												<input class="list_short form-check-input" type="radio" name="list_sort" id="sort5" value="price_desc">
												<label class="form-check-label" for="sort5">High to Low</label>
											</div>
										</div>
									</div>
									<div class="action-widget">
										<div class="price-slider">
											<div class="slider-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-max="200"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
											<div class="amount__field">
												<label>Price</label>
												<input type="text" class="range-amount" readonly="">
												<input type="hidden" name="min_price" value="1">
												<input type="hidden" name="max_price" value="200">
											</div>
										</div>
									</div>
									<br>
								</div>
							</div>
							<div class="col-xl-9 col-lg-9">
								<div class="row gy-2 align-items-center mb-3">
									<div class="col-sm-3 d-lg-none">
										<button type="button" class="action-sidebar-open"><i class="las la-sliders-h"></i>Filter</button>
									</div>
									<div class="col-lg-9 col-sm-6 col-7 text-lg-start text-sm-center">
									</div>
									<div class="col-lg-3 col-sm-3 col-5">
										<div class="d-flex align-items-center">
											<span class="mx-1">
												Showing                            </span>
											<select class="select select-sm DomainPaginate">
												<option value="" selected="" disabled="">Select One</option>
												<option value="5">5 items per page</option>
												<option value="10">10 items per page</option>
												<option value="20">20 items per page</option>
												<option value="40">40 items per page</option>
												<option value="60">60 items per page</option>
												<option value="80">80 items per page</option>
												<option value="100">100 items per page</option>
											</select>
										</div>
									</div>
								</div>

								<div class="domain-list-table-wrapper">
									<h6 class="search-value-show mb-2">
															</h6>
									<div class="domain-list-table-header">
										<div class="left">
											<div class="domain">Domain</div>
											<div class="traffic">Traffic</div>
											<div class="bid">Bid</div>
										</div>
										<div class="right">
											<div class="price">Price</div>
											<div class="action">Action</div>
										</div>
									</div>
									<div class="domain-list-table-body" id="showDomain">
										
										@php 
											echo $teks;
										@endphp

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			
			
		  </div>
		</div>
	  </div>
	  <!--/ Last Transaction -->
	</div>
  
</div>

@endsection
