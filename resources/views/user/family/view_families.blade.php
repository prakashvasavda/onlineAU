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
				{{-- <h2>Find babysitting jobs</h2> --}}
				{{-- <p>26 families matching your search</p> --}}
			</div>

			<div class="search-box profileSrc">
	        	<form method="post" id="search_form" action="{{ route('search') }}" class="w-100 d-flex flex-row justify-content-center align-items-center">
		        	@csrf
		        	<div class="form-input">
		        		<input type="text" placeholder="Enter Area or City" id="search-field" class="form-field address-input" name="search_query" required>
		        		<input type="hidden" name="type" value="family">
					</div>
					<div class="form-input-btn">
						<a href="#" onclick="document.getElementById('search_form').submit(); return false;" class="btn src-icon"><i class="fa fa-search"></i></a>
					</div>
				</form>
	        </div>

			<div class="favorites-section">
				<div class="container">
					<div class="title-main">
			            <h2>Favorites</h2>
			        </div>
					<div class="row">
						@if(isset($families) && !empty($families))
							@foreach($families as $key => $value)
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
									<a href="{{ route('family-detail', ['id' => $value->id]) }}">
										<div class="card verticalBox">
										  	<span class="user-profile-section">
										  		@if(isset($value->profile))
									            	<img src="{{ url('../storage/app/public/uploads/'.$value->profile) }}" alt="" style=" max-height: 225px; width:100%;">
									            @else
									            	<img src="{{ url('../storage/app/public/uploads/user-profile.png') }}" alt="" style=" max-height: 225px; width:100%">
									            @endif
										  	</span>
										  	<div class="card-body">
											  	<div class="pos-icon">
											  		<span class="user-favorite-section">
											  			@if(isset($value->family_favorited_by) && is_string($value->family_favorited_by))
									            			@if(in_array($user->id, explode(",", $value->family_favorited_by)))
									            				<i class="fa-solid fa-heart" id="favBtn{{$value->id}}" onclick="addCandidateFavoriteFamily(event, '{{ $value->id }}')"></i>
									            			@else
									            				<i class="fa-regular fa-heart" id="favBtn{{$value->id}}"  onclick="addCandidateFavoriteFamily(event, '{{ $value->id }}')"></i>
									            			@endif
									            		@else
									            				<i class="fa-regular fa-heart" id="favBtn{{$value->id}}"  onclick="addCandidateFavoriteFamily(event, '{{ $value->id }}')"></i>
									            		@endif
											  		</span>
											  	</div>
											    <p class="text-capitalize mb-1"><span>name</span>: {{ isset($value->name) ? strtoupper($value->name) : "-" }}</p>
											    <p class="text-capitalize mb-1"><span>area</span>: {{ isset($value->area) ? $value->area : "-" }}</p>
											    <p class="text-capitalize mb-1"><span>availability</span>: {{ isset($value->available_date) ? $value->available_date : "-" }}</p>
											    <p class="text-capitalize mb-1"><span>years experience</span>: {{ isset($value->childcare_experience) ? $value->childcare_experience : "-" }}</p>
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
						@endif
					</div>
				</div>
			</div>

			<div class="mb-4">
				<nav aria-label="Page navigation example">
				  	<ul class="pagination justify-content-center">
				    	{{ isset($families) ? $families->links() : null }}
				  </ul>
				</nav>
			</div>

		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
