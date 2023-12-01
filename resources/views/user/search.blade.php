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
				@if(isset($search))
					@foreach($search as $value)
						<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<a href="{{ route('candidate-detail', ['id' => $value->id]) }}">
								<div class="card">
								    <div class="row g-0">
								        <div class="col-md-4">
								           	<span class="user-profile-section">
										  		@if(isset($value->profile))
									            	<img src="{{ url('../storage/app/public/uploads/'.$value->profile) }}" alt="" style=" max-height: 225px; width:100%;">
									            @else
									            	<img src="{{ url('../storage/app/public/uploads/user-profile.png') }}" alt="" style=" max-height: 225px; width:100%">
									            @endif
										  	</span>
								        </div>
								        <div class="col-md-8">
								            <div class="card-body">
								            	<div class="pos-icon"><i class="fa-regular fa-heart"></i></div>
								                <h5 class="card-title">{{ $value->name }}</h5>
								                <p class="card-text">{{  $value->role == "family" ? $value->family_address :  $value->area }}</p>
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
								            </div>
								        </div>
								    </div>
								</div>
							</a>
						</div>
					@endforeach
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
