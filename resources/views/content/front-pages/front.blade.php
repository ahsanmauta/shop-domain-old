@php
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
@endsection

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
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
@vite(['resources/assets/js/front-page-landing.js'])
@endsection


@section('content')
<div data-bs-spy="scroll" class="scrollspy-example">
  <!-- Hero: Start -->
  <section id="hero-animation">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <img src="{{asset('assets/img/front-pages/backgrounds/hero-bg.png')}}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-cover w-100 h-100" data-speed="1" />
      <div class="container">
        <div class="hero-text-box text-center position-relative">
          <h1 class="text-primary hero-title display-6 fw-extrabold">#1 marketplace to buy and sell Domains</h1>
          <h2 class="hero-sub-title h6 mb-6">
            Find the perfect web address, or earn money with domains you already own, on the world's largest domain name marketplace.
          </h2>
          <div class="landing-hero-btn d-inline-block position-relative">
            
            <a href="{{ route('domains') }}" class="btn btn-primary btn-lg">Buy Domain</a>
          </div>
		  <div class="landing-hero-btn d-inline-block position-relative">
            
            <a href="{{ route('users.auction.create') }}" class="btn btn-primary btn-lg">Sell Domain</a>
          </div>
        </div>
        <div id="heroDashboardAnimation" class="hero-animation-img">
          <a href="{{url('/app/ecommerce/dashboard')}}" target="_blank">
            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
              <img src="{{asset('assets/img/front-pages/landing-page/hero-dashboard-'.$configData['style'].'.png')}}" alt="hero dashboard" class="animation-img" data-app-light-img="front-pages/landing-page/hero-dashboard-light.png" data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
              <img src="{{asset('assets/img/front-pages/landing-page/hero-elements-'.$configData['style'].'.png')}}" alt="hero elements" class="position-absolute hero-elements-img animation-img top-0 start-0" data-app-light-img="front-pages/landing-page/hero-elements-light.png" data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="landing-hero-blank"></div>
  </section>
  <!-- Hero: End -->

  <!-- Useful features: Start -->
  <section id="Features" class="section-py landing-features">
    <div class="container">
      <div class="text-center mb-4">
        <span class="badge bg-label-primary">Useful Features</span>
      </div>
      <h4 class="text-center mb-1">
        <span class="position-relative fw-extrabold z-1">Why Choose Domain Sell?
          <img src="{{asset('assets/img/front-pages/icons/section-title-icon.png')}}" alt="laptop charging" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
      </h4>
      <p class="text-center mb-12"></p>
      <div class="features-icon-wrapper row gx-0 gy-6 g-sm-12">
        <div class="col-lg-3 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-4">
            <img src="{{asset('assets/img/front-pages/icons/laptop.png')}}" alt="laptop charging" />
          </div>
          <h5 class="mb-2">Awarded best support center</h5>
          <p class="features-icon-description">Four years in a row.</p>
        </div>
        <div class="col-lg-3 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-4">
            <img src="{{asset('assets/img/front-pages/icons/rocket.png')}}" alt="transition up" />
          </div>
          <h5 class="mb-2">Relentless dedication</h5>
          <p class="features-icon-description">Focused on providing a quality experience.</p>
        </div>
        <div class="col-lg-3 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-4">
            <img src="{{asset('assets/img/front-pages/icons/paper.png')}}" alt="edit" />
          </div>
          <h5 class="mb-2">Trusted by fortune 220 companies</h5>
          <p class="features-icon-description">Trust us with your business too.</p>
        </div>
        <div class="col-lg-3 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-4">
            <img src="{{asset('assets/img/front-pages/icons/check.png')}}" alt="3d select solid" />
          </div>
          <h5 class="mb-2">World's best domain platform</h5>
          <p class="features-icon-description">15 years of expertise.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Useful features: End -->


  <!-- FAQ: Start -->
  <section id="FAQ" class="section-py bg-body landing-faq">
    <div class="container">
      <div class="text-center mb-4">
        <span class="badge bg-label-primary">FAQ</span>
      </div>
      <h4 class="text-center mb-1">Frequently asked
        <span class="position-relative fw-extrabold z-1">questions
          <img src="{{asset('assets/img/front-pages/icons/section-title-icon.png')}}" alt="laptop charging" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
      </h4>
      <p class="text-center mb-12 pb-md-4">Browse through these FAQs to find answers to commonly asked questions.</p>
      <div class="row gy-12 align-items-center">
        <div class="col-lg-5">
          <div class="text-center">
            <img src="{{asset('assets/img/front-pages/landing-page/faq-boy-with-logos.png')}}" alt="faq boy with logos" class="faq-image" />
          </div>
        </div>
        <div class="col-lg-7">
          <div class="accordion" id="accordionExample">
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                  What are Total Receipts in domain reselling platform?
                </button>
              </h2>

              <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Culpa similique distinctio cupiditate amet. Odio eveniet totam quisquam ut dolor, deserunt excepturi ex illum optio, cumque in nesciunt quam odit fuga beatae accusamus quos, numquam officia assumenda molestiae ea quis! Ut illum harum eaque exercitationem laboriosam adipisci omnis expedita et qui.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                  What happens once I exhaust the initial deposit that I make?
                </button>
              </h2>
              <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Once you exhaust your initial deposit, you can refill your Account with any desired amount as and when required.
                </div>
              </div>
            </div>
            <div class="card accordion-item active">
              <h2 class="accordion-header" id="headingThree">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                  How can I move all of my existing services to Network Solutions?
                </button>
              </h2>
              <div id="accordionThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Culpa similique distinctio cupiditate amet. Odio eveniet totam quisquam ut dolor, deserunt excepturi ex illum optio, cumque in nesciunt quam odit fuga beatae accusamus quos, numquam officia assumenda molestiae ea quis! Ut illum harum eaque exercitationem laboriosam adipisci omnis expedita et qui.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour">
                  How does Network Solutions charge for renewals?
                </button>
              </h2>
              <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Culpa similique distinctio cupiditate amet. Odio eveniet totam quisquam ut dolor, deserunt excepturi ex illum optio, cumque in nesciunt quam odit fuga beatae accusamus quos, numquam officia assumenda molestiae ea quis! Ut illum harum eaque exercitationem laboriosam adipisci omnis expedita et qui.
                </div>
              </div>
            </div>
            <div class="card accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive">
                  How can Network Solutions help me if I run into technical issues?
                </button>
              </h2>
              <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Culpa similique distinctio cupiditate amet. Odio eveniet totam quisquam ut dolor, deserunt excepturi ex illum optio, cumque in nesciunt quam odit fuga beatae accusamus quos, numquam officia assumenda molestiae ea quis! Ut illum harum eaque exercitationem laboriosam adipisci omnis expedita et qui.
                </div>
              </div>
            </div>
			<div class="card accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive">
                  How can I move all of my existing services to Network Solutions?
                </button>
              </h2>
              <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Culpa similique distinctio cupiditate amet. Odio eveniet totam quisquam ut dolor, deserunt excepturi ex illum optio, cumque in nesciunt quam odit fuga beatae accusamus quos, numquam officia assumenda molestiae ea quis! Ut illum harum eaque exercitationem laboriosam adipisci omnis expedita et qui.
                </div>
              </div>
            </div>
			<div class="card accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive">
                  How can Network Solutions help me to get new customers?
                </button>
              </h2>
              <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Culpa similique distinctio cupiditate amet. Odio eveniet totam quisquam ut dolor, deserunt excepturi ex illum optio, cumque in nesciunt quam odit fuga beatae accusamus quos, numquam officia assumenda molestiae ea quis! Ut illum harum eaque exercitationem laboriosam adipisci omnis expedita et qui.
                </div>
              </div>
            </div>
			<div class="card accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive">
                  What are the best Network Solutions products?
                </button>
              </h2>
              <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Culpa similique distinctio cupiditate amet. Odio eveniet totam quisquam ut dolor, deserunt excepturi ex illum optio, cumque in nesciunt quam odit fuga beatae accusamus quos, numquam officia assumenda molestiae ea quis! Ut illum harum eaque exercitationem laboriosam adipisci omnis expedita et qui.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- FAQ: End -->


  <!-- Contact Us: Start -->
  <section id="Contact" class="section-py bg-body landing-contact">
    <div class="container">
      <div class="text-center mb-4">
        <span class="badge bg-label-primary">Contact US</span>
      </div>
      <h4 class="text-center mb-1">
        <span class="position-relative fw-extrabold z-1">Let's work
          <img src="{{asset('assets/img/front-pages/icons/section-title-icon.png')}}" alt="laptop charging" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
        together
      </h4>
      <p class="text-center mb-12 pb-md-4">Any question or remark? just write us a message</p>
      <div class="row g-6">
        <div class="col-lg-5">
          <div class="contact-img-box position-relative border p-2 h-100">
            <img src="{{asset('assets/img/front-pages/icons/contact-border.png')}}" alt="contact border" class="contact-border-img position-absolute d-none d-lg-block scaleX-n1-rtl" />
            <img src="{{asset('assets/img/front-pages/landing-page/contact-customer-service.png')}}" alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
            <div class="p-4 pb-2">
              <div class="row g-4">
                <div class="col-md-6 col-lg-12 col-xl-6">
                  <div class="d-flex align-items-center">
                    <div class="badge bg-label-primary rounded p-1_5 me-3"><i class="ti ti-mail ti-lg"></i></div>
                    <div>
                      <p class="mb-0">Email</p>
                      <h6 class="mb-0"><a href="mailto:prajaw@gmail.com" class="text-heading">prajaw@gmail.com</a></h6>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-12 col-xl-6">
                  <div class="d-flex align-items-center">
                    <div class="badge bg-label-success rounded p-1_5 me-3"><i class="ti ti-phone-call ti-lg"></i></div>
                    <div>
                      <p class="mb-0">Phone</p>
                      <h6 class="mb-0"><a href="tel:+6281515328045" class="text-heading">+62 81515328045</a></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="mb-2">Send a message</h4>
              <p class="mb-6">
                If you would like to discuss anything related to payment, account, licensing,<br class="d-none d-lg-block" />
                partnerships, or have pre-sales questions, you’re at the right place.
              </p>
              <form>
                <div class="row g-4">
                  <div class="col-md-6">
                    <label class="form-label" for="contact-form-fullname">Full Name</label>
                    <input type="text" class="form-control" id="contact-form-fullname" placeholder="john" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="contact-form-email">Email</label>
                    <input type="text" id="contact-form-email" class="form-control" placeholder="johndoe@gmail.com" />
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="contact-form-message">Message</label>
                    <textarea id="contact-form-message" class="form-control" rows="7" placeholder="Write a message"></textarea>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Send inquiry</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Us: End -->
</div>
@endsection
