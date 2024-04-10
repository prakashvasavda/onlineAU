@section('css')
<style>
 .alert-primary {
  --bs-alert-color: var(--white);
  --bs-alert-bg: var(--primary);
  --bs-alert-border-color: var(--primary);
 }
 .alert-secondary {
  --bs-alert-color: var(--gray-text);
  --bs-alert-bg: var(--secondary);
  --bs-alert-border-color: var(--secondary);
 }
 .alert-light {
  --bs-alert-color: var(--gray-text);
  --bs-alert-bg: var(--light-gray);
  --bs-alert-border-color: var(--light-gray);
 }
</style>
@endsection
@if ($message = Session::get('success'))
<div class="alert alert-primary alert-dismissible" role="alert">
  <p><strong>Success!</strong> {{ $message }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
  <p><strong>Error!</strong> {{ $message }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-secondary alert-dismissible" role="alert">
  <p><strong>Error!</strong> Please check the form below for errors
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif
