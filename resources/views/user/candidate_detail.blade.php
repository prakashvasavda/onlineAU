@extends('layouts.main')
@section('content')
@include('flash.front-message')
<div class="candidate-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="candidate-img">
                     <img src="{{ url('../storage/app/public/uploads/'.$candidate->profile) }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <div class="candidate-content">
                    <h3>NAME: {{ strtoupper($candidate->name) }}<br>
                        AGE: {{ strtoupper($candidate->age) }}<br>
                        LOCATION: {{ strtoupper($candidate->area) }}<br>
                        SPECIALITY: {{ strtoupper($candidate->role) }}<br>
                        HOURLY RATE: R{{ strtoupper($candidate->salary_expectation) }}
                    </h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="candidate-contact">
                    <p class="mb-2"><a href="javaScript:;" class="btn icon-with-text btn-link p-0" onclick="CandidateFavourite()"><i class="{{ isset($favourite) ? 'fa-solid' : 'fa-regular' }} fa-heart" id="candidate_favourite"></i>Save</a></p>
                    <a href="javaScript:;" class="btn btn-primary round">CONTACT {{ isset($candidate->name) ? explode(' ', $candidate->name)[0] : '' }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="review-section">
    <div class="container">
        <h2>
            @if(isset($reviews->review_rating_count))
                @for($i=0; $i< $reviews->review_rating_count; $i++)
                     <i class="fa-solid fa-star"></i>
                @endfor
            @else
                @for($i=0; $i< 5; $i++)
                    <i class="far fa-star"></i>
                @endfor
            @endif
            <span>{{ isset($reviews->total_reviews) ? $reviews->total_reviews : 0 }} Reviews</span>
        </h2>

        <p>{{ isset($reviews->review_note) ? $reviews->review_note : 'No review' }}</p>
        <!-- write-review-form -->
        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 me-auto">
            <form class="mt-5" name="candidate_review_form" action="{{ route('store-candidate-reviews') }}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="reviewer_id" value="{{ isset($loginUser->role) && $loginUser->role == 'family' ? $loginUser->id : null }}">
                <input type="hidden" name="reviewer_role" value="{{ isset($loginUser->role) && $loginUser->role == 'family' ? $loginUser->role : null }}">
                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                <div class="form-input mb-2">
                    <div class="rating-star">
                        <input type="radio" name="review_rating_count" id="rating-5" value="5">
                        <label for="rating-5"></label>
                        <input type="radio" name="review_rating_count" id="rating-4" value="4">
                        <label for="rating-4"></label>
                        <input type="radio" name="review_rating_count" id="rating-3" value="3">
                        <label for="rating-3"></label>
                        <input type="radio" name="review_rating_count" id="rating-2" value="2">
                        <label for="rating-2"></label>
                        <input type="radio" name="review_rating_count" id="rating-1" value="1"> 
                        <label for="rating-1"></label>
                    </div>
                </div>
                <div class="form-input mb-2">
                    <label for="write_review">Review</label>
                    <textarea id="review_note" name="review_note" placeholder="" class="form-field" rows="5" @error('review_note') is-invalid @enderror"></textarea>
                    @error('review_note')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-input-btn">
                    <input type="submit" class="btn btn-primary round" value="Submit" {{ isset($reviews) ? 'disabled' : '' }}>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="about-candidate">
    <div class="container">
        <div class="title-main">
            <h3>About me</h3>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="about-candidate-box">
                    <li>
                        <div class="about-candidate-title">
                              <img src="{{ url('front/images/religion-icon1.png') }}" alt="">
                            <h4>religion:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($candidate->religion) ? strtoupper($candidate->religion) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/disabilities-icon1.png') }}" alt="">
                            <h4>disabilities:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($candidate->disabilities) ? strtoupper($candidate->disabilities) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/language-icon1.png') }}" alt="">
                            <h4>HOME LANGUAGE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($candidate->home_language) ? strtoupper($candidate->home_language) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/marital-status-icon1.png') }}" alt="">
                            <h4>MARITAL STATUS:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($candidate->marital_status) ? strtoupper($candidate->marital_status) : '-' }}</h4>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="about-candidate-box">
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/driving-licence-icon1.png') }}" alt="">
                            <h4>DRIVERS LICENSE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($candidate->drivers_license) ? strtoupper($candidate->drivers_license) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/vehicle-icon1.png') }}" alt="">
                            <h4>OWN VEHICLE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($candidate->vehicle) ? strtoupper($candidate->vehicle) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/years-experience-icon1.png') }}" alt="">
                            <h4>YEARS OF EXPERIENCE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($candidate->childcare_experience) ? strtoupper($candidate->childcare_experience) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/dependants-icon1.png') }}" alt="">
                            <h4>DEPENDANTS</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($candidate->dependants) ? strtoupper($candidate->dependants) : '-' }}</h4>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="candidate-availability">
    <div class="container">
        <div class="title-main">
            <h3>Availability</h3>
        </div>
        <div class="can-avail-table table-responsive">
            <table class="table table-borderless table-sm">
                <tbody>
                    <tr>
                        <td></td>
                        <th>Mo</th>
                        <th>Tu</th>
                        <th>We</th>
                        <th>Th</th>
                        <th>Fr</th>
                        <th>Sa</th>
                        <th>Su</th>
                    </tr>
                    <tr>
                        <th>Morning</th>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="mo_morning" id="" {{ in_array("mo_morning", $morning_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="tu_morning" id="" {{ in_array("tu_morning", $morning_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="we_morning" id="" {{ in_array("we_morning", $morning_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="th_morning" id="" {{ in_array("th_morning", $morning_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="fr_morning" id="" {{ in_array("fr_morning", $morning_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="sa_morning" id="" {{ in_array("sa_morning", $morning_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="su_morning" id="" {{ in_array("su_morning", $morning_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                    </tr>
                    <tr>
                        <th>Afternoon</th>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="mo_afternoon" id="" {{ in_array("mo_afternoon", $afternoon_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="tu_afternoon" id="" {{ in_array("tu_afternoon", $afternoon_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="we_afternoon" id="" {{ in_array("we_afternoon", $afternoon_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="th_afternoon" id="" {{ in_array("th_afternoon", $afternoon_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="fr_afternoon" id="" {{ in_array("fr_afternoon", $afternoon_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="sa_afternoon" id="" {{ in_array("sa_afternoon", $afternoon_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="su_afternoon" id="" {{ in_array("su_afternoon", $afternoon_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                    </tr>
                    <tr>
                        <th>Evening</th>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="mo_evening" id="" {{ in_array("mo_evening", $evening_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="tu_evening" id="" {{ in_array("tu_evening", $evening_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="we_evening" id="" {{ in_array("we_evening", $evening_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="th_evening" id="" {{ in_array("th_evening", $evening_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="fr_evening" id="" {{ in_array("fr_evening", $evening_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="sa_evening" id="" {{ in_array("sa_evening", $evening_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="su_evening" id="" {{ in_array("su_evening", $evening_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                    </tr>
                     <tr>
                        <th>Night</th>
                        <td>
                            <label><input type="checkbox" name="night[]" value="mo_night" id="" {{ in_array("mo_night", $night_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="tu_night" id="" {{ in_array("tu_night", $night_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="we_night" id="" {{ in_array("we_night", $night_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="th_night" id="" {{ in_array("th_night", $night_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="fr_night" id="" {{ in_array("fr_night", $night_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="sa_night" id="" {{ in_array("sa_night", $night_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="su_night" id="" {{ in_array("su_night", $night_availability ) ? 'checked' : 'disabled' }}></label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="btn-main d-flex flex-wrap justify-content-evenly align-items-center mt-5">
            <a href="javaScript:;" class="btn btn-primary round">CONTACT {{ isset($candidate->name) ? explode(' ', $candidate->name)[0] : '' }}</a>
            <a href="{{route('families')}}" class="btn btn-primary round">BACK TO ALL CANDIDATES</a>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
function CandidateFavourite(){
    var family_id = {{ isset($loginUser->role) && $loginUser->role == 'family' ? $loginUser->id : null }};
    if(family_id && !$("#candidate_favourite").hasClass("fa-solid")){
        $.ajax({
            url: "{{ url('store-candidate-favourite') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}', 
                candidate_id: {{ $candidate->id }},
                candidate_role: '{{ $candidate->role }}',
                family_id: {{ $loginUser->id }},
            },
            success: function(response) {
                if(response.message == "success"){
                    $('#candidate_favourite').removeClass("fa-regular").addClass("fa-solid");
                }
            }
        });
    }
}

</script>
@endsection
