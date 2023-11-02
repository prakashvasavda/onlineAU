@extends('layouts.main')
@section('content')
@include('flash.front-message')
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
				{{-- <h2>Find babysitting jobs</h2> --}}
				{{-- <p>26 families matching your search</p> --}}
			</div>

			<div class="title-main mb-5">
	            <h2>Favorites</h2>
	        </div>

	        <div class="search-box profileSrc">
	        	<form class="w-100 d-flex flex-row justify-content-center align-items-center">
		        	<div class="form-input">
		        		<input type="text" name="" placeholder="Search here" class="form-field">
					</div>
					<div class="form-input-btn">
						<a href="javaScript:;" class="btn src-icon"><i class="fa fa-search"></i></a>
					</div>
				</form>
	        </div>

			<div class="row result-list">
				@if(isset($candidates) && !empty($candidates))
					@foreach($candidates as $key => $value)
						@if(isset($value->candidate_favorited_by) && is_string($value->candidate_favorited_by))
							@if(in_array($user->id, explode(",", $value->candidate_favorited_by)))
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
									<a href="{{ route('candidate-detail', ['id' => $value->id]) }}">
										<div class="card">
										    <div class="row g-0">
										        <div class="col-md-4">
										        	@if(isset($value->profile))
										            	<img src="{{ url('../storage/app/public/uploads/'.$value->profile) }}" alt="">
										            @else
										            	<img src="{{ url('../storage/app/public/uploads/user-profile.png') }}" alt="">
										            @endif
										        </div>
										        <div class="col-md-8">
										            <div class="card-body">
										            	<div class="pos-icon">
										            		<div class="spinner-border" role="status" id="spinner{{$value->id}}" style="display: none;">
															  <span class="visually-hidden">Loading...</span>
															</div>

										            		@if(isset($value->candidate_favorited_by) && is_string($value->candidate_favorited_by))
										            			@if(in_array($user->id, explode(",", $value->candidate_favorited_by)))
										            				<i class="fa-solid fa-heart" id="favBtn{{$value->id}}" onclick="storeFamilyFavoriteCandidate(event, '{{ $value->id }}')"></i>
										            			@else
										            				<i class="fa-regular fa-heart" id="favBtn{{$value->id}}"  onclick="storeFamilyFavoriteCandidate(event, '{{ $value->id }}')"></i>
										            			@endif
										            		@else
										            				<i class="fa-regular fa-heart" id="favBtn{{$value->id}}"  onclick="storeFamilyFavoriteCandidate(event, '{{ $value->id }}')"></i>
										            		@endif
										            	</div>
										                <h5 class="card-title">{{ $value->name }}</h5>
										                <p class="card-text">{{ $value->area }}</p>
										                <p class="card-text">
										                	<small>
										                		<span>
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
							@endif
						@endif
					@endforeach
				@endif
			</div>


			<div class="title-main mb-5">
	            <h2>All Candidates</h2>
	        </div>

	        <div class="row result-list">
				@if(isset($candidates) && !empty($candidates))
					@foreach($candidates as $key => $value)
						@if(!isset($value->candidate_favorited_by) || !in_array($user->id, explode(",", $value->candidate_favorited_by)))
							<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
								<a href="{{ route('candidate-detail', ['id' => $value->id]) }}">
									<div class="card">
									    <div class="row g-0">
									        <div class="col-md-4">
									        	@if(isset($value->profile))
									            	<img src="{{ url('../storage/app/public/uploads/'.$value->profile) }}" alt="">
									            @else
									            	<img src="{{ url('../storage/app/public/uploads/user-profile.png') }}" alt="">
									            @endif
									        </div>
									        <div class="col-md-8">
									            <div class="card-body">
									            	<div class="pos-icon">
									            		<div class="spinner-border" role="status" id="spinner{{$value->id}}" style="display: none;">
														  <span class="visually-hidden">Loading...</span>
														</div>

									            		@if(isset($value->candidate_favorited_by) && is_string($value->candidate_favorited_by))
									            			@if(in_array($user->id, explode(",", $value->candidate_favorited_by)))
									            				<i class="fa-solid fa-heart" id="favBtn{{$value->id}}" onclick="storeFamilyFavoriteCandidate(event, '{{ $value->id }}')"></i>
									            			@else
									            				<i class="fa-regular fa-heart" id="favBtn{{$value->id}}" onclick="storeFamilyFavoriteCandidate(event, '{{ $value->id }}')"></i>
									            			@endif
									            		@else
									            				<i class="fa-regular fa-heart" id="favBtn{{$value->id}}" onclick="storeFamilyFavoriteCandidate(event, '{{ $value->id }}')"></i>
									            		@endif
									            	</div>
									                <h5 class="card-title">{{ $value->name }}</h5>
									                <p class="card-text">{{ $value->area }}</p>
									                <p class="card-text">
									                	<small>
									                		<span>
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
						@endif
					@endforeach
				@endif
			</div>

		</div>
	</div>
	<div class="favorites-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
					<div class="card verticalBox">
					  <img src="https://onlineaupairs.co.za/storage/app/public/uploads/user-profile.png" class="img-fluid card-img-top" alt="">
					  <div class="card-body">
					  	<div class="pos-icon">
					  		<a href="javaScript:;" class="wishBtn"><i class="fa-regular fa-heart"></i></a>
					  	</div>
					    <p class="text-capitalize mb-1"><span>name</span>: JANE</p>
					    <p class="text-capitalize mb-1"><span>age</span>: 28</p>
					    <p class="text-capitalize mb-1"><span>area</span>: Nebraska, Grand Island</p>
					    <p class="text-capitalize mb-1"><span>availability</span>: date</p>
					    <p class="text-capitalize mb-1"><span>years experience</span>: 2 years</p>
					    <p class="text-center mt-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></p>
					  </div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
					<div class="card verticalBox">
					  <img src="https://onlineaupairs.co.za/storage/app/public/uploads/user-profile.png" class="img-fluid card-img-top" alt="">
					  <div class="card-body">
					  	<div class="pos-icon">
					  		<a href="javaScript:;" class="wishBtn"><i class="fa-regular fa-heart"></i></a>
					  	</div>
					    <p class="text-capitalize mb-1"><span>name</span>: JANE</p>
					    <p class="text-capitalize mb-1"><span>age</span>: 28</p>
					    <p class="text-capitalize mb-1"><span>area</span>: Nebraska, Grand Island</p>
					    <p class="text-capitalize mb-1"><span>availability</span>: date</p>
					    <p class="text-capitalize mb-1"><span>years experience</span>: 2 years</p>
					    <p class="text-center mt-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></p>
					  </div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
					<div class="card verticalBox">
					  <img src="https://onlineaupairs.co.za/storage/app/public/uploads/user-profile.png" class="img-fluid card-img-top" alt="">
					  <div class="card-body">
					  	<div class="pos-icon">
					  		<a href="javaScript:;" class="wishBtn"><i class="fa-regular fa-heart"></i></a>
					  	</div>
					    <p class="text-capitalize mb-1"><span>name</span>: JANE</p>
					    <p class="text-capitalize mb-1"><span>age</span>: 28</p>
					    <p class="text-capitalize mb-1"><span>area</span>: Nebraska, Grand Island</p>
					    <p class="text-capitalize mb-1"><span>availability</span>: date</p>
					    <p class="text-capitalize mb-1"><span>years experience</span>: 2 years</p>
					    <p class="text-center mt-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></p>
					  </div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
					<div class="card verticalBox">
					  <img src="https://onlineaupairs.co.za/storage/app/public/uploads/user-profile.png" class="img-fluid card-img-top" alt="">
					  <div class="card-body">
					  	<div class="pos-icon">
					  		<a href="javaScript:;" class="wishBtn"><i class="fa-regular fa-heart"></i></a>
					  	</div>
					    <p class="text-capitalize mb-1"><span>name</span>: JANE</p>
					    <p class="text-capitalize mb-1"><span>age</span>: 28</p>
					    <p class="text-capitalize mb-1"><span>area</span>: Nebraska, Grand Island</p>
					    <p class="text-capitalize mb-1"><span>availability</span>: date</p>
					    <p class="text-capitalize mb-1"><span>years experience</span>: 2 years</p>
					    <p class="text-center mt-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></p>
					  </div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
					<div class="card verticalBox">
					  <img src="https://onlineaupairs.co.za/storage/app/public/uploads/user-profile.png" class="img-fluid card-img-top" alt="">
					  <div class="card-body">
					  	<div class="pos-icon">
					  		<a href="javaScript:;" class="wishBtn"><i class="fa-regular fa-heart"></i></a>
					  	</div>
					    <p class="text-capitalize mb-1"><span>name</span>: JANE</p>
					    <p class="text-capitalize mb-1"><span>age</span>: 28</p>
					    <p class="text-capitalize mb-1"><span>area</span>: Nebraska, Grand Island</p>
					    <p class="text-capitalize mb-1"><span>availability</span>: date</p>
					    <p class="text-capitalize mb-1"><span>years experience</span>: 2 years</p>
					    <p class="text-center mt-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></p>
					  </div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
					<div class="card verticalBox">
					  <img src="https://onlineaupairs.co.za/storage/app/public/uploads/user-profile.png" class="img-fluid card-img-top" alt="">
					  <div class="card-body">
					  	<div class="pos-icon">
					  		<a href="javaScript:;" class="wishBtn"><i class="fa-regular fa-heart"></i></a>
					  	</div>
					    <p class="text-capitalize mb-1"><span>name</span>: JANE</p>
					    <p class="text-capitalize mb-1"><span>age</span>: 28</p>
					    <p class="text-capitalize mb-1"><span>area</span>: Nebraska, Grand Island</p>
					    <p class="text-capitalize mb-1"><span>availability</span>: date</p>
					    <p class="text-capitalize mb-1"><span>years experience</span>: 2 years</p>
					    <p class="text-center mt-3"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></p>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
function storeFamilyFavoriteCandidate(event, candidate_id){
	event.preventDefault();
    var family_id = {{ session()->has('frontUser') ? session()->get('frontUser')->id : 0 }};
    var role = "{{ session()->has('frontUser') ? session()->get('frontUser')->role : " " }}";

    if(family_id != 0 && role == "family"){
    	$('#favBtn'+candidate_id).css('display', 'none');
		$('#spinner'+candidate_id).css('display', 'block');

        $.ajax({
            url: "{{ url('store-family-favourite-candidate') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}', 
                candidate_id: candidate_id,
                family_id: family_id,
            },
            success: function(response) {
            	$('#spinner'+candidate_id).css('display', 'none');
                if(response.message == "success"){
                    $('#favBtn'+candidate_id).removeClass("fa-regular").addClass("fa-solid").css('display', 'block');
                }else{
                    $('#favBtn'+candidate_id).removeClass("fa-solid").addClass("fa-regular").css('display', 'block');
                }
            }
        });
    }
}
</script>
@endsection
