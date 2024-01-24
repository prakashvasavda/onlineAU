@extends('layouts.main')
@section('content')
@include('flash.front-message')
@php
    $services = [
        "au-pairs"   => "au-pair",
        "nannies"    => "nanny",
    ]
@endphp

<div class="candidate-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="candidate-img">
                    @if(isset($candidate->profile))
                        <img src="{{ asset('uploads/profile/'.$candidate->profile) }}" alt="">
                    @else
                        <img src="{{ asset('uploads/profile/user-profile.png') }}" alt="">
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <div class="candidate-content">
                    <h3>
                        NAME:        {{ $candidate->name ? strtoupper($candidate->name)  : "-"  }}    <br>
                        AGE:         {{ $candidate->age  ? strtoupper($candidate->age)   : "-"  }}    <br>
                        LOCATION:    {{ $candidate->area ? strtoupper($candidate->area)  : "-"  }}    <br>
                        SPECIALITY:  {{ isset($services[$candidate->role]) ? strtoupper($services[$candidate->role])  : "-"  }} <br>
                         
                        @if($candidate->role == 'nannies' || $candidate->role == 'au-pairs')
                            SALARY: {{ $candidate->salary_expectation ? "R".strtoupper($candidate->salary_expectation) : "-" }}<br>
                        @else
                            HOURLY RATE: {{ $candidate->salary_expectation ? "R".strtoupper($candidate->salary_expectation) : "-" }}<br>
                        @endif
                       

                        @if(session()->has('frontUser') && session()->get('frontUser')->role == "family" && session()->get('frontUser')->user_subscription_status == "active")
                            @if(isset(session()->get('frontUser')->purchased_candidates) && in_array($candidate->role, explode(',', session()->get('frontUser')->purchased_candidates)))
                                <span id="candidate_contact" style="display: none;">
                                    CONTACT NUMBER: {{ $candidate->contact_number ? strtoupper($candidate->contact_number) : "-" }}<br>
                                    EMAIL: {{ strtoupper($candidate->email) }}
                                </span>
                            @endif
                        @endif
                    </h3>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="candidate-contact">
                    @if(session()->has('frontUser'))
                        <p class="mb-2"><a href="javaScript:;" class="btn icon-with-text btn-link p-0" onclick="storeFamilyFavoriteCandidate()"><i class="{{ isset($favourite) ? 'fa-solid' : 'fa-regular' }} fa-heart" id="candidate_favourite"></i>Save</a></p>
                        <a href="javaScript:;" class="btn btn-primary round" onclick="handleClick(event)">CONTACT {{ isset($candidate->name) ? explode(' ', $candidate->name)[0] : '' }}</a>
                    @else
                        <p class="mb-2"><a href="{{ route('user-login') }}" class="btn icon-with-text btn-link p-0"><i class="fa-regular fa-heart" id="candidate_favourite"></i>Save</a></p>
                        <a href="{{ route('user-login') }}" class="btn btn-primary round">CONTACT {{ isset($candidate->name) ? explode(' ', $candidate->name)[0] : '' }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-candidate">
    <div class="container">
        <div class="title-main mb-4">
            <h3 class="mb-2">About me</h3>
            <p class="text-start mb-2">{{ $candidate->about_yourself ? $candidate->about_yourself : "-" }}</p>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="about-candidate-box">
                    <li class="equalHeight">
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/religion-icon1.png') }}" alt="">
                            <h4>religion:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($candidate->religion) ? ucfirst($candidate->religion) : '-' }}</h4>
                        </div>
                    </li>
                    <li class="equalHeight">
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/disabilities-icon1.png') }}" alt="">
                            <h4>disabilities:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($candidate->disabilities) ? ucfirst($candidate->disabilities) : '-' }}</h4>
                        </div>
                    </li>
                    <li class="equalHeight">
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/language-icon1.png') }}" alt="">
                            <h4>HOME LANGUAGE:</h4>
                        </div>
                        <div class="about-candidate-content">
                             <h4>{{ isset($candidate->home_language) ? ucfirst($candidate->home_language) : '-' }}</h4>
                        </div>
                    </li>

                    <li class="equalHeight">
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/marital-status-icon1.png') }}" alt="">
                            <h4>MARITAL STATUS:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($candidate->marital_status) ? ucfirst($candidate->marital_status) : '-' }}</h4>
                        </div>
                    </li>

                    @if($candidate->role == 'nannies' || $candidate->role == 'au-pairs' ||  $candidate->role == 'babysitters')
                        <li class="equalHeight">
                            <div class="about-candidate-title">
                                <img src="{{ url('front/images/firstAid-icon1.png') }}" alt="">
                                <h4>FIRST AID:</h4>
                            </div>
                            <div class="about-candidate-content">
                                <h4>{{ isset($candidate->first_aid) ? ucfirst($candidate->first_aid) : '-' }}</h4>
                            </div>
                        </li>
                    @endif

                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="about-candidate-box">
                    <li class="equalHeight">
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/driving-licence-icon1.png') }}" alt="">
                            <h4>DRIVERS LICENSE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($candidate->drivers_license) ? ucfirst($candidate->drivers_license) : '-' }}</h4>
                        </div>
                    </li>
                    <li class="equalHeight">
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/vehicle-icon1.png') }}" alt="">
                            <h4>OWN VEHICLE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($candidate->vehicle) ? ucfirst($candidate->vehicle) : '-' }}</h4>
                        </div>
                    </li>
                    <li class="equalHeight">
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/years-experience-icon1.png') }}" alt="">
                            <h4>YEARS OF EXPERIENCE:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($candidate->childcare_experience) ? ucfirst($candidate->childcare_experience) : '-' }}</h4>
                        </div>
                    </li>
                    <li class="equalHeight">
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/dependants-icon1.png') }}" alt="">
                            <h4>DEPENDANTS</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($candidate->dependants) ? ucfirst($candidate->dependants) : '-' }}</h4>
                        </div>
                    </li>

                    @if($candidate->role == 'au-pairs' ||  $candidate->role == 'nannies')
                        <li class="equalHeight">
                            <div class="about-candidate-title">
                                <img src="{{ url('front/images/home-live-in-icon1.png') }}" alt="">
                                <h4>LIVE-IN OR LIVE-OUT:</h4>
                            </div>
                            <div class="about-candidate-content">
                                <h4>{{ isset($candidate->live_in_or_live_out) ? ucfirst($candidate->live_in_or_live_out) : '-' }}</h4>
                            </div>
                        </li>
                    @endif
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
                            <label><input type="checkbox" name="morning[]" value="mo_morning" id="" {{ in_array("mo_morning", $morning_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="tu_morning" id="" {{ in_array("tu_morning", $morning_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="we_morning" id="" {{ in_array("we_morning", $morning_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="th_morning" id="" {{ in_array("th_morning", $morning_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="fr_morning" id="" {{ in_array("fr_morning", $morning_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="sa_morning" id="" {{ in_array("sa_morning", $morning_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="morning[]" value="su_morning" id="" {{ in_array("su_morning", $morning_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                    </tr>
                    <tr>
                        <th>Afternoon: <span style="font-size: medium;">13:00 – 17:00</span></th>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="mo_afternoon" id="" {{ in_array("mo_afternoon", $afternoon_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="tu_afternoon" id="" {{ in_array("tu_afternoon", $afternoon_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="we_afternoon" id="" {{ in_array("we_afternoon", $afternoon_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="th_afternoon" id="" {{ in_array("th_afternoon", $afternoon_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="fr_afternoon" id="" {{ in_array("fr_afternoon", $afternoon_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="sa_afternoon" id="" {{ in_array("sa_afternoon", $afternoon_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="afternoon[]" value="su_afternoon" id="" {{ in_array("su_afternoon", $afternoon_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                    </tr>
                    <tr>
                        <th>Evening: <span style="font-size: medium;">17:00 – 21:00</span></th>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="mo_evening" id="" {{ in_array("mo_evening", $evening_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="tu_evening" id="" {{ in_array("tu_evening", $evening_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="we_evening" id="" {{ in_array("we_evening", $evening_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="th_evening" id="" {{ in_array("th_evening", $evening_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="fr_evening" id="" {{ in_array("fr_evening", $evening_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="sa_evening" id="" {{ in_array("sa_evening", $evening_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="evening[]" value="su_evening" id="" {{ in_array("su_evening", $evening_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                    </tr>
                     <tr>
                        <th>Night: <span style="font-size: medium;">21:00 – 00:00</span></th>
                        <td>
                            <label><input type="checkbox" name="night[]" value="mo_night" id="" {{ in_array("mo_night", $night_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="tu_night" id="" {{ in_array("tu_night", $night_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="we_night" id="" {{ in_array("we_night", $night_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="th_night" id="" {{ in_array("th_night", $night_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="fr_night" id="" {{ in_array("fr_night", $night_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="sa_night" id="" {{ in_array("sa_night", $night_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                        <td>
                            <label><input type="checkbox" name="night[]" value="su_night" id="" {{ in_array("su_night", $night_availability ) ? 'checked' : '' }} disabled></label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="btn-main d-flex flex-wrap justify-content-evenly align-items-center mt-5">
            @if(session()->has('frontUser'))
                <a href="#" class="btn btn-primary round" id="bottom-contact-btn" onclick="handleClick(event)">CONTACT {{ isset($candidate->name) ? explode(' ', $candidate->name)[0] : '' }}</a>
                <a href="{{ route('view-candidates') }}" class="btn btn-primary round">BACK TO ALL CANDIDATES</a>
            @else
                <a href="{{ route('user-login') }}" class="btn btn-primary round">CONTACT {{ isset($candidate->name) ? explode(' ', $candidate->name)[0] : '' }}</a>
                <a href="{{ route('candidates') }}" class="btn btn-primary round">BACK TO ALL CANDIDATES</a>
            @endif
        </div>
    </div>
</div>



<div class="review-section">
    <div class="container mb-5">
        <h2>
            @if(isset($reviews->review_rating_count) && is_numeric($reviews->review_rating_count))
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

        <p>{{ isset($reviews->review_note) ? $reviews->review_note : 'No review' }}</p>
        <!-- write-review-form -->
        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 me-auto">
            @if(session()->has('frontUser') && session()->get('frontUser')->role == "family")
                <form class="mt-5" name="candidate_review_form" action="{{ route('store-candidate-reviews') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="family_id" value="{{ isset($loginUser->role) && $loginUser->role == 'family' ? $loginUser->id : null }}">
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
            @endif
        </div>
    </div>
</div>
@include ('user.includes.modal')
@endsection

@section('script')
@parent
<script type="text/javascript">
function storeFamilyFavoriteCandidate(){
    var family_id = {{ isset($loginUser->id) ? $loginUser->id : 0 }};
    var role      = "{{ isset($loginUser->role) ? $loginUser->role : " " }}";

    if(family_id != 0 && role == "family"){
        $.ajax({
            url: "{{ url('store-family-favourite-candidate') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}', 
                candidate_id: {{ $candidate->id }},
                family_id: family_id,
            },
            success: function(response) {
                if(response.message == "success"){
                    $('#candidate_favourite').removeClass("fa-regular").addClass("fa-solid");
                }else{
                    $('#candidate_favourite').removeClass("fa-solid").addClass("fa-regular");
                }
            }
        });
    }
}

(function () {
    equalHeight(false);
})();

window.onresize = function(){
    equalHeight(true);
}

function equalHeight(resize) {
    var elements = document.getElementsByClassName("equalHeight"),
        allHeights = [],
        i = 0;
    if(resize === true){
      for(i = 0; i < elements.length; i++){
        elements[i].style.height = 'auto';
      }
    }
    for(i = 0; i < elements.length; i++){
      var elementHeight = elements[i].clientHeight;
      allHeights.push(elementHeight);
    }
    for(i = 0; i < elements.length; i++){
      elements[i].style.height = Math.max.apply( Math, allHeights) + 'px';
      if(resize === false){
        elements[i].className = elements[i].className + " show";
      }
    }
}

function handleClick(event){
    event.preventDefault();
    var purchaseCandidates = "{{ session()->has('frontUser') && isset(session()->get('frontUser')->purchased_candidates) ? session()->get('frontUser')->purchased_candidates : null }}";
    var candidateService   = "{{ isset($candidate->role) ? $candidate->role : null }}";
    var candidates         = purchaseCandidates ? purchaseCandidates.split(",") : null;
    var paymentStatus      = "{{ (session()->has('frontUser') && session()->get('frontUser')->user_subscription_status == "active") ? true : false }}";
    var loggedInUserRole   = "{{ session()->get('frontUser')->role }}";

    if(loggedInUserRole && loggedInUserRole !== "family"){
        showModal('You need to be logged in as a family user to contact this candidate', "{{ route('user-logout') }}", 'Log Out');
        return false;
    }
    
    if(!candidates ||candidates.length == 0 || !paymentStatus){
        showModal('Please complete your subscription and payment process', "{{ route('packages') }}", 'Go to Package');
        return false;
    }

    if(!candidates.includes(candidateService)){
        showModal("The candidate you've selected is not included in the purchased package", "{{ route('packages') }}", 'Go to Package');
        return false;
    }

    $("#candidate_contact").css("display", "block");
    event.target.id == "bottom-contact-btn" ? $(window).scrollTop(0) : false;
}

function showModal(message, url, text){
    $("#alert-modal-label").html("Warning");
    $("#alert-modal-icon").html("<img src='{{ url('front/images/warning-icon1.png') }}' alt=''>");
    $("#alert-modal-body").html(message);
    $("#alert-modal-action-btn").attr('href', url).text(text);
    $('#alert-modal').modal('show');
}

</script>
@endsection
