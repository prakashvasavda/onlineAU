@extends('layouts.main')
@section('content')
@include('flash.front-message')
@php
    $services = [
        "au-pairs"   => "au-pair",
        "nannies"    => "nanny",
        "petsitters" => "petsitter",
        "babysitters"=> "babysitter",
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
                        <a href="javaScript:;" class="btn btn-primary round" onclick="handleClick(event)"  style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis">CONTACT {{ isset($candidate->name) ? explode(' ', $candidate->name)[0] : '' }}</a>
                    @else
                        <p class="mb-2"><a href="{{ route('user-login') }}" class="btn icon-with-text btn-link p-0"><i class="fa-regular fa-heart" id="candidate_favourite"></i>Save</a></p>
                        <a href="{{ route('user-login') }}" class="btn btn-primary round"  style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis">CONTACT {{ isset($candidate->name) ? explode(' ', $candidate->name)[0] : '' }}</a>
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
        @if (isset($candidate->role) && in_array($candidate->role, ['au-pairs', 'nannies', 'petsitters', 'babysitters']))
            @include("user.about.$candidate->role")
        @endif
    </div>
</div>

<div class="candidate-availability">
    <div class="container">
        <div class="title-main">
            <h3>Experience</h3>
        </div>
        <div class="table-responsive timeListTable">
            <table class="table mb-0 experiances-table">
                <thead>
                    <tr>
                        <th class="w-10">From</th>
                        <th class="w-10">To</th>
                        <th class="w-25">Heading </th>
                        <th class="w-50">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($candidate->previous_experience) && $candidate->previous_experience->isNotEmpty())
                        @foreach ($candidate->previous_experience as $key => $value)
                            <tr>
                                <td>{{ explode("-", $value->daterange)[0] ?? "-"  }}</td>
                                <td>{{ explode("-", $value->daterange)[1] ?? "-" }}</td>
                                <td>{{ $value->heading ?? "-" }}</td>
                                <td>{{ $value->description ?? "-" }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="4">No experiances available</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="candidate-availability">
    <div class="container">
        <div class="title-main">
            <h3>Availability</h3>
        </div>
        <div class="table-responsive timeForm">
            <table class="table table-borderless table-sm">
                <tbody>
                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                        <tr id="{{ $day }}-row">
                            <td class="text-start"><input type="checkbox" {{ isset($calendars[$day]['start_time'][0]) || isset($calendars[$day]['end_time'][0]) ? 'checked' : '' }} disabled></td>
                            <td>{{ ucfirst($day) }}</td>
                            <td><input type="text" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][0] ?? null }}" disabled></td>
                            <td>to</td>
                            <td><input type="text" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][0] ?? null }}" disabled></td>
                        </tr>

                        @if(isset($calendars[$day]) && !empty($calendars[$day]) && is_array($calendars[$day]))
                            @foreach($calendars[$day]['start_time'] as $key => $value)
                                @if(isset($key) && $key >= 1 && isset($calendars[$day]['start_time'][$key]) && isset($calendars[$day]['end_time'][$key]))
                                    <tr id="{{ $day }}-row">
                                        <td>&nbsp;</td>
                                        <td>{{ ucfirst($day) }}</td>
                                        <td><input type="text" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][$key] }}" disabled></td>
                                        <td>to</td>
                                        <td><input type="text" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][$key] }}" disabled></td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
            <p class="d-none" style="font-size: small; font-style: italic;">These hours are intended solely to provide a general indication of availability. Specific hours can be further discussed with the family as needed</p>
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
    var loggedInUserRole   = "{{ session()->has('frontUser') ? session()->get('frontUser')->role : null }}";

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
