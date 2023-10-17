@extends('layouts.main')
@section('content')
@include('flash.front-message')
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
				{{-- <h2>Find babysitting jobs</h2> --}}
				{{-- <p>26 families matching your search</p> --}}
			</div>
			<div class="row result-list">
				@if(isset($candidates) && !empty($candidates))
					@foreach($candidates as $key => $value)
						@if(isset($value->candidate_favourites_id) && !empty($value->candidate_favourites_id))
							<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
								<a href="{{ route('candidate-detail', ['id' => $value->id]) }}">
									<div class="card">
									    <div class="row g-0">
									        <div class="col-md-4">
									            <img src="{{ url('../storage/app/public/uploads/'.$value->profile) }}" alt="">
									        </div>
									        <div class="col-md-8">
									            <div class="card-body">
									            	<div class="pos-icon">
									            		<i class="{{ isset($value->candidate_favourites_id) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
									            	</div>
									                <h5 class="card-title">{{ $value->name }}</h5>
									                <p class="card-text">{{ $value->area }}</p>
									                <p class="card-text">
									                	<small>
									                		<span>
									                			@if(isset($value->review_rating_count) && !empty($value->review_rating_count))
												                	@for($i=0; $i<$value->review_rating_count; $i++)
													                	<i class="fa-solid fa-star"></i>
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
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">

</script>
@endsection
