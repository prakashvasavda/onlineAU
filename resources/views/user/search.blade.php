@extends('layouts.main')
@section('content')
<div class="search-section no-banner">
	{{-- <ul class="filter-option">
		<li><a href="javaScript:;">Type of babysitter needed</a></li>
		<li><a href="javaScript:;">Children</a></li>
		<li><a href="javaScript:;">Verifications</a></li>
		<li><a href="javaScript:;">More filters</a></li>
	</ul> --}}
	<div class="search-inner">
		<div class="container">
			<div class="title-main title-box">
				@if($type == "family")
					<h2>Find Family</h2>
					<p>{{ count($search) }} families matching your search</p>
				@else
					<h2>Find AU-PAIRS jobs</h2>
					<p>{{ count($search) }} AU-PAIRS matching your search</p>
				@endif
			</div>
			<div class="row result-list">
				@if(isset($search) && $search->isNotEmpty())
					@foreach($search as $value)
						@php
							$decoded_value = isset($value->what_do_you_need) && is_string($value->what_do_you_need) ? json_decode($value->what_do_you_need) : null;
							$what_do_you_need = !empty($decoded_value) && is_array($decoded_value) ? implode(", ", $decoded_value) : null;
						@endphp

						<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<a href="{{ $value->role == 'family' ? route('family-detail', ['id' => $value->id]) : route('candidate-detail', ['id' => $value->id]) }}">
								<div class="card">
								    <div class="row g-0">
								        <div class="col-md-4">
								           	<span class="user-profile-section">
										  		@if(isset($value->profile))
									            	<img src="{{ asset('uploads/profile/'.$value->profile) }}" alt="" style=" max-height: 225px; width:100%;">
									            @else
									            	<img src="{{ asset('uploads/profile/user-profile.png') }}" alt="" style=" max-height: 225px; width:100%">
									            @endif
										  	</span>
								        </div>
								        <div class="col-md-8">
								            <div class="card-body">
								            	@if($type != 'family')
									            	<div class="pos-icon">
									            		<i class="fa-regular fa-heart"></i>
									            	</div>
									            @endif

								                <h5 class="card-title">{{ ucwords($value->name) }}</h5>
								                <p class="card-text">{{ $type == 'family' ? ucwords($value->family_city) : ucwords($value->area) }}</p>
								                
								                @if($type == 'family')
													<p class="card-text"><span class="fw-bolder">Looking For: </span>{{ isset($what_do_you_need) ? ucwords(str_replace("_", "-", $what_do_you_need)) : "-" }}</p>
										        @else
										        	<p class="card-text">
									                	<small>
									                		<span class="user-reviews-section">
									                			@if(isset($value->review_rating_count) && is_string($value->review_rating_count))
											                	 	@for($i = 0; $i < 5; $i++)
																        @if($i < max(explode(",", $value->review_rating_count)))
																            <i class="fa-solid fa-star"></i>
																        @else
																            <i class="fa-regular fa-star"></i>
																        @endif
															   	 	@endfor
													            @else
													            	@for($i=0; $i<5; $i++)
													                	<i class="fa-regular fa-star"></i>
													                @endfor
												                @endif 
										                	</span>
										                	<span>{{ isset($value->total_reviews) ? $value->total_reviews : 0 }} Reviews</span>
										                </small>
										            </p>
										        @endif
								            </div>
								        </div>
								    </div>
								</div>
							</a>
						</div>
					@endforeach
				@else
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 d-block m-auto">
			           <img src="{{ url('front/images/error-notFound-icon1-x-size.png') }}" alt="">	
			    	</div>
				@endif
			</div>

			@if(isset($search) && isset($type) && isset($search_query))
				<div class="mb-4">
					<nav aria-label="Page navigation example">
					  	<ul class="pagination justify-content-center">
					    	{{ $search->appends(['type' => $type, 'search_query' => $search_query])->links() }}
					  	</ul>
					</nav>
				</div>
			@endif

		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
