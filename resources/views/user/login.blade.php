@extends('layouts.user_login')

@section('content')
<div class="container">
  <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 mx-auto">
    <div class="title-main">
      <h2>Welcome to Online Au-Pairs</h2>
      <h3>Login</h3>
    </div>
    <form method="POST" class="row" action="{{ route('check-login') }}">
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
      <div class="form-input">
          <label>Password</label>
          <input type="password" class="form-field @error('password') is-invalid @enderror" name="password" placeholder="" required>
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
      <div class="form-input text-end">
            <p>Forgot your <a href="#">Password</a> ?</p>
            <p>Not registered yet? <a href="{{ route('sign-up', ['service' => 'candidate']) }}">Please click here to register</a>.</p>
      </div>

      <!-- <div class="form-input d-flex flex-wrap justify-content-start align-items-center">
          <input type="checkbox" name="remember" id="rememberMe">
          <label for="rememberMe">Remember me</label>
      </div> -->
      <div class="form-input-btn mt-1">
          <input type="submit" class="btn btn-primary round" value="login">
      </div>        
    </form>
  </div>
</div>
@endsection
