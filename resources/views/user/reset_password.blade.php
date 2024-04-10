@extends('layouts.user_login')

@section('content')
<div class="container">
  <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 mx-auto">
    <div class="title-main">
      <h3>Create New Password</h3>
    </div>    
    @include('flash.front-message')
    <form method="POST" class="row" action="{{ route('create-new-password') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $userEmail }}">
      <div class="form-input">
        <label>Password</label>
        <input type="password" class="form-field @error('password') is-invalid @enderror" name="password" placeholder="" required>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-input">
        <label>Confirm Password</label>
        <input type="password" class="form-field" name="password_confirmation" placeholder="" required>
        @error('password_confirmation')
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
