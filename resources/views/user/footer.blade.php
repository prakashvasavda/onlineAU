<footer>
	<div class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="ftr-menu">
						<h5>Candidates</h5>
						<p class="fs-4 mb-2"><a href="javaScript:;" class="fs-4">How it works</a></p>
						<ul>
							<li><a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-aupairs-works">Au-Pairs</a></li>
							<li><a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-nannies-works">Nannies</a></li>
							<li><a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-babysitters-works">Babysitters</a></li>
							<li><a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-petsitters-works">Petsitters</a></li>
						</ul>
						<p class="fs-4 mt-2"><a href="{{ route('sign-up', ['service' => 'candidate']) }}" class="fs-4">Register as a candidate</a></p>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="ftr-menu">
						<h5>Family</h5>
						<ul>
							<li><a href="{{ route('sign-up', ['service' => 'family']) }}#howWorks">How it Works</a></li>
							<li><a href="{{ route('family-register', ['service' => 'family']) }}">Register my family</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="ftr-menu">
						<h5>Get In Touch</h5>
						<ul>
							<li>Call: <a href="javaScript:;">079 037 8053</a></li>
							<li>Email: <a href="javaScript:;" style="text-transform: lowercase !important;">info@onlineaupairs.co.za</a></li>
						</ul>
					</div>
				</div>
				<div class="col-12">
					<div class="logo-main">
	                    <a href="{{ route('home') }}"><img src="{{ asset('front/images/logo-white.png') }}" alt="logo"></a>
	                </div>
				</div>
			</div>
		</div>
	</div>
	<div class="cpyRight-section">
		<div class="container">
			<p>Copyright Online Au-Pairs 2023 - All Rights Reserved | Designed and Developed by <a href="https://octrotus.co.za/" target="_blank">Octrotus Online Solutions</a></p>
		</div>
	</div>
</footer>

{{-- whatsapp link icon --}}
<div class="wpIcon-wrapper">
	<a href="https://wa.link/yhhp5h" target="_blank">
		<img  src="{{ asset('front/images/whatsapp-icon.svg') }}" alt="whatsapp">
	</a>
</div>
{{-- end whatsapp link icon --}}