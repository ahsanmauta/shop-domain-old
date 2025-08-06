@extends('layouts/layoutMaster')

@section('title', 'Editors - Forms')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/quill/typography.scss',
  'resources/assets/vendor/libs/quill/katex.scss',
  'resources/assets/vendor/libs/quill/editor.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/quill/katex.js',
  'resources/assets/vendor/libs/quill/quill.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/forms-selects.js','resources/assets/js/forms-editors.js'])
@endsection

@section('content')

<!-- Multi Column with Form Separator -->
<div class="card mb-6">
  <form class="card-body" action="{{ route('admin.emailsave') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" >
	@csrf

          <h4 class="mb-1">Send Email</h4>
    
    <div class="row g-6">
      <div class="col-md-12">
        <label class="form-label" for="multicol-username">Being Sent To</label>
		<select id="select2Multiple" class="select2 form-select" name="email[]" id="email" multiple >
			@foreach($users as $dt)
				<option value="{{ $dt->email }}">{{ $dt->firstname . ' ' . $dt->lastname }}</option>
			@endforeach
		</select>
      </div>
	  <div class="col-md-12">
        <label class="form-label" for="multicol-username">Subject</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="" value=""  />
      </div>
	  <div class="col-md-12">
        <label class="form-label" for="multicol-username">Message  </label>
		  <input type="hidden" name="message" id="message" value="" />

		  <!-- Full Editor -->
		  <div class="col-12">
			<div class="card">
			  <div class="card-body">
				<div id="full-editor">
				  <h6>Dear</h6>
				  <p> Cupcake ipsum dolor sit amet. Halvah cheesecake chocolate bar gummi bears cupcake. Pie macaroon bear claw. Soufflé I love candy canes I love cotton candy I love. </p>
				</div>
			  </div>
			</div>
		  </div>
		  <!-- /Full Editor -->
      </div>

    </div>
	
	<div class="pt-6">
      <button type="submit" class="btn btn-primary me-4">Submit</button>
      <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>


  </form>
</div>

<script>

  function validateForm() {
	  //var message = document.getElementById('full-editor').innerHTML;
	  var message = document.getElementsByClassName("ql-editor")[0].innerHTML;
	  document.getElementById('message').value = message;
	}

</script>
         
@endsection
