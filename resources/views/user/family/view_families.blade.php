@extends('layouts.main')
@section('content')
<div class="search-section no-banner">
	<ul class="filter-option">
		<li><a href="javaScript:;">Type of babysitter needed</a></li>
		<li><a href="javaScript:;">Children</a></li>
		<li><a href="javaScript:;">Verifications</a></li>
		<li><a href="javaScript:;">More filters</a></li>
	</ul>
	<div class="search-inner">
		<div class="container-fluid">
			<div class="title-main title-box">
				<h2>Find babysitting jobs</h2>
				<p>26 families matching your search</p>
			</div>
			<div class="row result-list">
				@if(isset($families) && !empty($families))
					@foreach($families as $key => $value)
						<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<a href="{{ route('family-detail', ['id' => $value->id]) }}">
								<div class="card">
								    <div class="row g-0">
								        <div class="col-md-4">
								        	<img src="{{ url('../storage/app/public/uploads/'.$value->profile) }}" class="img-fluid" alt="">
								        </div>
								        <div class="col-md-8">
								            <div class="card-body">
								            	<div class="pos-icon"><i class="fa-solid fa-heart"></i></div>
								                <h5 class="card-title">{{ $value->name }}</h5>
								                <p class="card-text">{{ $value->area }}</p>
								                <p class="card-text"><small><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> 12 Reviews</small></p>
								            </div>
								        </div>
								    </div>
								</div>
							</a>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
