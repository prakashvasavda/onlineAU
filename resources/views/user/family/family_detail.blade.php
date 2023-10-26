@extends('layouts.main')
@section('content')
@include('flash.front-message')
<div class="candidate-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="candidate-img">
                    @if(isset($family->profile))
                        <img src="{{ url('../storage/app/public/uploads/'.$family->profile) }}" alt="">
                    @else
                        <img src="{{ url('../storage/app/public/uploads/user-profile.png') }}" alt="">
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <div class="candidate-content">
                    <h3>NAME: {{ strtoupper($family->name) }}<br>
                        LOCATION: {{ strtoupper($family->family_address) }}<br>
                        SPECIALITY: {{ strtoupper($family->role) }}<br>
                        HOURLY RATE: R{{ strtoupper($family->salary_expectation) }}
                    </h3>
                </div>
            </div>
            @if(isset($loginUser) && !empty($loginUser) && $loginUser->role != 'family')
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <div class="candidate-contact">
                        <p class="mb-2"><a href="javaScript:;" class="btn icon-with-text btn-link p-0" onclick="storeCandidateFavoriteFamily()"><i class="{{ isset($favourite) ? 'fa-solid' : 'fa-regular' }} fa-heart" id="favourite_button"></i>Save</a></p>
                        {{-- <a href="javaScript:;" class="btn btn-primary round">CONTACT {{ isset($family->name) ? explode(' ', $family->name)[0] : '' }}</a> --}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="review-section">
    <div class="container">
        <h2>
            @if(isset($reviews->review_rating_count))
                @for($i=0; $i< 5; $i++)
                    @if($i < $reviews->review_rating_count)
                        <i class="fa-solid fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
            @else
                @for($i=0; $i< 5; $i++)
                    <i class="far fa-star"></i>
                @endfor
            @endif
            <span>{{ isset($reviews->total_reviews) ? $reviews->total_reviews : 0 }} Reviews</span>
        </h2>

        <p>
            <span>{{ isset($reviews->review_note) ? $reviews->review_note : 'No review' }}</span>
        </p>
        
        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 me-auto">
            <form class="mt-5" name="family_review_form" action="{{ route('store-family-review') }}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="candidate_id" value="{{ $loginUser->id }}">
                <input type="hidden" name="family_id" value="{{ $family->id }}">
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
                    @if ($errors->has('review_rating_count'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('review_rating_count') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input mb-2">
                    <label for="write_review">Review</label>
                    <textarea id="review_note" name="review_note" placeholder="" class="form-field" rows="5"></textarea>
                    @if ($errors->has('review_note'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('review_note') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input-btn">
                    <input type="submit" class="btn btn-primary round" value="Submit">
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
                            <h4>{{ !empty($family->religion) ? strtoupper($family->religion) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/disabilities-icon1.png') }}" alt="">
                            <h4>disabilities:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($family->disabilities) ? strtoupper($family->disabilities) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/language-icon1.png') }}" alt="">
                            <h4>HOME LANGUAGE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($family->home_language) ? strtoupper($family->home_language) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/marital-status-icon1.png') }}" alt="">
                            <h4>MARITAL STATUS:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($family->marital_status) ? strtoupper($family->marital_status) : '-' }}</h4>
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
                            <h4>{{ !empty($family->drivers_license) ? strtoupper($family->drivers_license) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/vehicle-icon1.png') }}" alt="">
                            <h4>OWN VEHICLE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($family->vehicle) ? strtoupper($family->vehicle) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/years-experience-icon1.png') }}" alt="">
                            <h4>YEARS OF EXPERIENCE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($family->childcare_experience) ? strtoupper($family->childcare_experience) : '-' }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/dependants-icon1.png') }}" alt="">
                            <h4>DEPENDANTS</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($family->dependants) ? strtoupper($family->dependants) : '-' }}</h4>
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
                        <th>Morning: <span style="font-size: medium;">07:00 – 13:00</span></th>
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
                        <th>Afternoon: <span style="font-size: medium;">13:00 – 17:00</span></th>
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
                        <th>Evening: <span style="font-size: medium;">17:00 – 21:00</span></th>
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
                         <th>Night: <span style="font-size: medium;">21:00 – 00:00</span></th>
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
            {{-- <a href="javaScript:;" class="btn btn-primary round">CONTACT {{ isset($family->name) ? explode(' ', $family->name)[0] : '' }}</a> --}}
            <a href="{{ route('view-families') }}" class="btn btn-primary round">BACK TO ALL FAMILIES</a>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
function storeCandidateFavoriteFamily(){
    var candidate_id = {{ isset($loginUser->role) ? $loginUser->id : 0 }};
    if(candidate_id != 0){
        $.ajax({
            url: "{{ url('store-candidate-favorite-family') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}', 
                family_id: {{ $family->id }},
                candidate_id: candidate_id,
            },
            success: function(response) {
                if(response.message == "success"){
                    $('#favourite_button').removeClass("fa-regular").addClass("fa-solid");
                }else{
                    $('#favourite_button').removeClass("fa-solid").addClass("fa-regular"); 
                }
            }
        });
    }
}
</script>
@endsection
