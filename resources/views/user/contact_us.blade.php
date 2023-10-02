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
					<li><a href="javaScript:;"><i class="fa-solid fa-envelope fa-2x"></i>+27 123 123 1234</a></li>
					<li><a href="javaScript:;"><i class="fa-solid fa-phone fa-2x"></i>info@onlineaupair.co.za</a></li>
				</ul>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<form class="contact-form">
					<h3>Contact Form</h3>
					<div class="form-imput">
						<input type="text" id="" name="name" placeholder="Name & Surname" class="form-field" required>
					</div>
					<div class="form-imput">
						<input type="number" id="" name="numbers" placeholder="Contact Number" class="form-field" required>
					</div>
					<div class="form-imput">
						<input type="email" id="" name="mail" placeholder="Email Address" class="form-field" required>
					</div>
					<div class="form-imput">
						<textarea id="" name="message" placeholder="Message" class="form-field" rows="5" required></textarea>
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