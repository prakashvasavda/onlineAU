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
			
			<div class="search-box profileSrc">
	        	<form method="GET" id="search_form" action="{{ route('search') }}" class="w-100 d-flex flex-row justify-content-center align-items-center">
		        	@csrf
		        	<div class="form-input">
		        		<input type="text" placeholder="Enter Area or City" id="search-field" class="form-field address-input" name="search_query" required>
		        		<input type="hidden" name="type" value="candidate">
					</div>
					<div class="form-input-btn">
						<a href="#" onclick="document.getElementById('search_form').submit(); return false;" class="btn src-icon"><i class="fa fa-search"></i></a>
					</div>
				</form>
	        </div>

			<div class="favorites-section">
				<div class="container">
					<div class="row">
						@if(isset($candidates) && count($candidates) > 0)
							@foreach($candidates as $key => $value)
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
									<a href="{{ route('candidate-detail', ['id' => $value->id]) }}">
										<div class="card verticalBox">
										 	@if(isset($value->profile))
								            	<img src="{{ asset('uploads/profile/'.$value->profile) }}" alt="">
								            @else
								            	<img src="{{ asset('uploads/profile/user-profile.png') }}" alt="">
								            @endif
										  	<div class="card-body">
											  	<div class="pos-icon">
											  		<span>
											  			@if(session()->has('frontUser') && session()->get('frontUser')->role == "family")
									            			@if(isset($value->candidate_favorited_by) && is_string($value->candidate_favorited_by))
									            				@if(in_array($user->id, explode(",", $value->candidate_favorited_by)))
									            					<i class="fa-solid fa-heart" id="favBtn{{$value->id}}" onclick="storeFamilyFavoriteCandidate(event, '{{ $value->id }}')"></i>
									            				@else
									            					<i class="fa-regular fa-heart" id="favBtn{{$value->id}}" onclick="storeFamilyFavoriteCandidate(event, '{{ $value->id }}')"></i>
									            				@endif
									            			@else
									            				<i class="fa-regular fa-heart" id="favBtn{{$value->id}}" onclick="storeFamilyFavoriteCandidate(event, '{{ $value->id }}')"></i>
									            			@endif
									            		@elseif(session()->has('frontUser') && session()->get('frontUser')->role != "family")
									         				<span class="disabled-heart"><i class="far fa-heart"></i></span>
									            		@else
									            			<i class="fa-regular fa-heart" onclick="event.preventDefault(); window.location.href = '{{ route('user-login') }}';"></i>
									            		@endif		
											  		</span>
											  	</div>
											    <p class="text-capitalize mb-1"><span>name</span>: {{ ucfirst($value->name) }}</p>
											    <p class="text-capitalize mb-1"><span>age</span>: {{ $value->age }}</p>
											    <p class="text-capitalize mb-1" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis"><span>area</span>: {{ ucfirst($value->area) }}</p>
											    <p class="text-capitalize mb-1"><span>available from</span>: {{$value->available_date}}</p>
											    <p class="text-capitalize mb-1"><span>years experience</span>: {{ $value->childcare_experience }}</p>
											    <p class="text-center mt-3">
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
											    </p>
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
				</div>
			</div>

			<div class="mb-4">
				<nav aria-label="Page navigation example">
				  	<ul class="pagination justify-content-center">
				    	{{ isset($candidates) ? $candidates->links() : null }}
				  </ul>
				</nav>
			</div>
			

			
			@if(request()->is('candidates/*'))
				<div class="btn-main text-center mb-4">
		            <a href="{{ route('candidates') }}" class="btn btn-primary round">view all candidates</a>
		        </div>
		    @endif
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

	    if(family_id != 0){
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
