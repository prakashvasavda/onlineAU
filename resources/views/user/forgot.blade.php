@extends('layouts.user_login')

@section('content')
<div class="container">
  <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 mx-auto">
    <div class="title-main">
      <h3>Forgot Password</h3>
    </div>    
    @include('flash.front-message')
    <form method="POST" class="row" action="{{ route('check-user') }}">
        @csrf
      <div class="form-input">
        <label>Email Address</label>
        <input type="email" class="form-field @error('email') is-invalid @enderror" name="email" placeholder="" required>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-input text-end">
          <p><a href="{{ route('user-login') }}">Login</a> ?</p>
      </div>
      <div class="form-input-btn mt-1">
          <input type="submit" class="btn btn-primary round" value="Submit">
      </div>        
    </form>
  </div>
</div>
@endsection
