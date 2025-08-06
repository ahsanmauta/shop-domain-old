@php
	use Illuminate\Contracts\Session\Session;
@endphp
	
@if (session('success'))
<div class="row mb-6">
<div class="col-md">
    <div class="card">
	<div class="card-body">
		<div class="alert alert-outline-success" role="alert">
          {{ session('success') }}
        </div>
	</div>
	</div>
</div>
</div>
@endif

@if (session('gagal'))
<div class="row mb-6">
<div class="col-md">
    <div class="card">
	<div class="card-body">
		<div class="alert alert-outline-danger" role="alert">
          {{ session('gagal') }}
        </div>
	</div>
	</div>
</div>
</div>
@endif

@if (session('peringatan'))
<div class="row mb-6">
<div class="col-md">
    <div class="card">
	<div class="card-body">
		<div class="alert alert-outline-warning" role="alert">
          {{ session('peringatan') }}
        </div>
	</div>
	</div>
</div>
</div>
@endif

@if (session('info'))
<div class="row mb-6">
<div class="col-md">
    <div class="card">
	<div class="card-body">
		<div class="alert alert-outline-info" role="alert">
          {{ session('peringatan') }}
        </div>
	</div>
	</div>
</div>
</div>
@endif