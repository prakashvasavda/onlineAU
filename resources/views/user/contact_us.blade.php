@extends('layouts.main')
@section('content')
<div class="banner-section">
	<div class="banner-img">
		<img src="{{ asset('/front/images/bannerImg1.png') }}" alt="">
	</div>
	<div class="banner-content bottomRight">
		<div class="container">
			<h2>contact us</h2>
		</div>
	</div>
</div>

<div class="contact-section">
	<div class="container">
		<div class="title-main mb-5">
			<h2>get in touch with us</h2>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<ul class="contact-info">
					<li><a href="javaScript:;"><i class="fa-solid fa-envelope fa-2x"></i>079 037 8053</a></li>
					<li><a href="javaScript:;"><i class="fa-solid fa-phone fa-2x"></i>info@onlineaupairs.co.za</a></li>
				</ul>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				@include('flash.front-message')
				<form class="contact-form" name="frm" method="post" action="{{ route('store-contact') }}">
					@csrf
					<h3>Contact Form</h3>
					<div class="form-imput">
						<input type="text" id="" name="name" placeholder="Name & Surname" class="form-field @error('name') is-invalid @enderror" required>
						@if ($errors->has('name'))
		                    <span class="text-danger">
		                        <strong>{{ $errors->first('name') }}</strong>
		                    </span>
		                @endif
					</div>
					<div class="form-imput">
						<input type="number" id="" name="number" placeholder="Contact Number" class="form-field @error('name') is-invalid @enderror" required>
						@if ($errors->has('number'))
		                    <span class="text-danger">
		                        <strong>{{ $errors->first('number') }}</strong>
		                    </span>
		                @endif
					</div>
					<div class="form-imput">
						<input type="email" id="" name="email" placeholder="Email Address" class="form-field @error('name') is-invalid @enderror" required>
						@if ($errors->has('email'))
		                    <span class="text-danger">
		                        <strong>{{ $errors->first('email') }}</strong>
		                    </span>
		                @endif
					</div>
					<div class="form-imput">
						<textarea id="" name="message" placeholder="Message" class="form-field @error('name') is-invalid @enderror" rows="5" required></textarea>
						@if ($errors->has('message'))
		                    <span class="text-danger">
		                        <strong>{{ $errors->first('message') }}</strong>
		                    </span>
		                @endif
					</div>
					<div class="form-input-btn">
		                <input type="submit" class="btn btn-secondary round" value="Submit">
		            </div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
