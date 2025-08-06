@php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
$currentRouteName = Route::currentRouteName();
$activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
$activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
$userid = (isset(Auth::user()->id))?Auth::user()->id:'0';
@endphp
<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0">
  <div class="container">
    <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8">
      <!-- Menu logo wrapper: Start -->
      <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4 me-xl-8" >
        <!-- Mobile menu toggle: Start-->
        <button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="ti ti-menu-2 ti-lg align-middle text-heading fw-medium"></i>
        </button>
        <!-- Mobile menu toggle: End-->
        <a href="{{url('')}}" class="app-brand-link">
          <span class="app-brand-logo demo"><img src="{{ url(config('variables.logo')) }}" width="30px"  /></span>
          <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{ config('variables.templateName') }}</span>
        </a>
      </div>
      <!-- Menu logo wrapper: End -->
      <!-- Menu wrapper: Start -->
      <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
        <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="ti ti-x ti-lg"></i>
        </button>
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link fw-medium" aria-current="page" href="{{route('users.pages-user')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="{{route('domains')}}" >Domains</a>
          </li>
          <li class="nav-item dropdown"  >
            <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">Deposit</a>
            <div class="dropdown-menu" style="top:55px;" >
              <a class="dropdown-item" href="{{route('users.deposit.create')}}">Deposit Money</a>
			  <a class="dropdown-item" href="{{route('users.paypal-deposit')}}">Deposit Paypal</a>
              <a class="dropdown-item" href="{{route('users.deposit.index')}}">My Deposits</a>
			  <a class="dropdown-item" href="{{route('users.payment.index')}}">My Payments</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">Withdraw</a>
            <div class="dropdown-menu" style="top:55px;" >
              <a class="dropdown-item" href="javascript:void(0)">Withdraw Money</a>
              <a class="dropdown-item" href="javascript:void(0)">My Withdrawals</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" >Auction</a>
            <div class="dropdown-menu" style="top:55px;" >
              <a class="dropdown-item" href="{{route('users.auction.create')}}">Create Auction</a>
              <a class="dropdown-item" href="{{route('users.auction.index')}}">My Auctions</a>
			  <a class="dropdown-item" href="{{route('users.bidlist')}}">My Bids</a>
              <a class="dropdown-item" href="{{route('users.bidwinnner')}}">Bid Winners</a>
            </div>
          </li>
		  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
            <div class="dropdown-menu" style="top:55px;" >
              @if(Auth::User()->admin==1)
			  <a class="dropdown-item" href="{{ route('admin.pages-admin')}}">Page Admin</a>
			  @endif
			  <a class="dropdown-item" href="{{ route('users.puser.edit',$userid)}}">Profile Setting</a>
			  <a class="dropdown-item" href="{{ route('change-password') }}">Change Password</a>
			  <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
          </li>
		  

        </ul>
      </div>
      <div class="landing-menu-overlay d-lg-none"></div>
      <!-- Menu wrapper: End -->
      <!-- Toolbar: Start -->
      <ul class="navbar-nav flex-row align-items-center ms-auto">
        @if($configData['hasCustomizer'] == true)
        <!-- Style Switcher -->
        <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-1">
          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <i class='ti ti-lg'></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                <span class="align-middle"><i class='ti ti-sun me-3'></i>Light</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                <span class="align-middle"><i class="ti ti-moon-stars me-3"></i>Dark</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                <span class="align-middle"><i class="ti ti-device-desktop-analytics me-3"></i>System</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- / Style Switcher-->
        @endif
        @if(!isset(Auth::user()->id))
		<!-- navbar button: Start -->
        <li>
          <a href="{{route('login')}}" class="btn btn-primary" target="_self"><span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span class="d-none d-md-block">Login/Register</span></a>
        </li>
        <!-- navbar button: End -->
		@else
		<li>
          <a href="{{route('users.pages-user')}}" class="btn btn-primary" target="_self"><span class="d-none d-md-block">Dashboard</span></a>
        </li>	
		@endif
      </ul>
      <!-- Toolbar: End -->
    </div>
  </div>
</nav>
<!-- Navbar: End -->
