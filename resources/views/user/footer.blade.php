<footer>
	<div class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="ftr-menu">
						<h5>Candidates</h5>
						<ul>
							<li><a href="{{ route('candidate-register','au-pairs') }}">Au-Pairs</a></li>
							<li><a href="{{ route('candidate-register','nannies') }}">Nannies</a></li>
							<li><a href="{{ route('candidate-register','babysitters') }}">Babysitters</a></li>
							<li><a href="{{ route('candidate-register','petsitters') }}">Petsitters</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="ftr-menu">
						<h5>Family</h5>
						<ul>
							<li><a href="{{ route('families') }}#howWorks">How it Works</a></li>
							<li><a href="{{ route('family-register') }}">Register my family</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="ftr-menu">
						<h5>Get In Touch</h5>
						<ul>
							<li>Call: <a href="javaScript:;">+27 123 123 1234</a></li>
							<li>Email: <a href="javaScript:;">info@onlineaupair.co.za</a></li>
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
			<p>Copyright Online Au-Pairs 2023 - All Rights Reserved | Designed and developed by <a href="https://gsdm.co.za/" target="_blank">GSDM Agency</a></p>
		</div>
	</div>
</footer>
