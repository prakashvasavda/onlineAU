@extends('layouts.main')
@section('content')
@include('flash.front-message')
<div class="candidate-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="candidate-img">
                    @if(isset($family->profile))
                        <img src="{{ asset('uploads/profile/'.$family->profile) }}" alt="">
                    @else
                        <img src="{{ asset('uploads/profile/user-profile.png') }}" alt="">
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <div class="candidate-content">
                    <h3>
                        SURNAME: {{ isset($family->surname) ? strtoupper($family->surname) : "-" }}<br>
                        CITY: {{ isset($family->family_city) ? strtoupper($family->family_city) : "-" }}<br>
                        START DATE: {{ isset($family->start_date) ? strtoupper($family->start_date) : "-" }}<br>
                        HOURLY RATE: {{ isset($family->hourly_rate_pay) ? $family->hourly_rate_pay : "-" }}<br>
                        SALARY: {{ isset($family->salary_expectation) ? "R".$family->salary_expectation : "-" }}<br>
                        WHAT FAMILY NEEDS: {{ isset($family->what_do_you_need) ? strtoupper(str_replace('_', '-', $family->what_do_you_need)) : "-" }}
                    </h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="candidate-contact">
                    @if(session()->has('frontUser'))
                        <a href="javaScript:;" class="btn btn-primary round" onclick="handleApplication(event)">INTERESTED</a>
                    @else
                        <a href="{{ route('user-login') }}" class="btn btn-primary round">INTERESTED</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-candidate">
    <div class="container">
        <div class="title-main mb-4">
            <h3 class="mb-2">About The Family</h3>
            <p class="text-start mb-2">{{ isset($family->family_description) ? $family->family_description : "-" }}</p>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="about-candidate-box">
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/dependants-icon1.png') }}" alt="">
                            <h4>Number of children:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($family->no_children) ? $family->no_children : "-" }}</h4>
                        </div>
                    </li>

                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/auPairs-icon1.png') }}" alt="">
                            <h4>Ages of children:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($family->age) ? str_replace("_", " - ", $family->age) : '-' }}</h4>
                        </div>
                    </li>

                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/childrens1.png') }}" alt="">
                            <h4>Gender of children:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($family->gender_of_children) ? str_replace('_', ' - ', $family->gender_of_children) : '-' }}</h4>
                        </div>
                    </li>

                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/language-icon1.png') }}" alt="">
                            <h4>Home Language:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($family->home_language) ? strtoupper($family->home_language) : '-' }}</h4>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <ul class="about-candidate-box">
                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/home-live-in-icon1.png') }}" alt="">
                            <h4>Live-in or live-out:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ !empty($family->live_in_or_live_out) ? strtoupper(str_replace('_', ' ', $family->live_in_or_live_out)) : '-' }}</h4>
                        </div>
                    </li>

                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/nannies-icon1.png') }}" alt="">
                            <h4>Duties of candidate:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($family->candidate_duties) ? strtoupper($family->candidate_duties) : '-' }}</h4>
                        </div>
                    </li>

                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/vehicle-icon1.png') }}" alt="">
                            <h4>Petrol Reimbursement:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($family->petrol_reimbursement) ? strtoupper(str_replace('_', ' ', $family->petrol_reimbursement)) : '-' }}</h4>
                        </div>
                    </li>

                    <li>
                        <div class="about-candidate-title">
                            <img src="{{ url('front/images/time.png') }}" alt="">
                            <h4>Duration Needed:</h4>
                        </div>
                        <div class="about-candidate-content">
                            <h4>{{ isset($family->duration_needed) ? strtoupper($family->duration_needed) : '-' }}</h4>
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
            <h3>Days and hours needed</h3>
        </div>
        <div class="table-responsive timeForm">
            <table class="table table-borderless table-sm">
                <tbody>
                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                        <tr id="{{ $day }}-row">
                            <td class="text-start"><input type="checkbox" disabled></td>
                            <td>{{ ucfirst($day) }}</td>
                            <td><input type="time" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][0] ?? null }}" disabled></td>
                            <td>to</td>
                            <td><input type="time" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][0] ?? null }}" disabled></td>
                        </tr>

                        @if(isset($calendars[$day]) && !empty($calendars[$day]) && is_array($calendars[$day]))
                            @foreach($calendars[$day]['start_time'] as $key => $value)
                                @if(isset($key) && $key >= 1 && isset($calendars[$day]['start_time'][$key]) && isset($calendars[$day]['end_time'][$key]))
                                    <tr id="{{ $day }}-row">
                                        <td class="text-start"><input type="checkbox" disabled></td>
                                        <td>{{ ucfirst($day) }}</td>
                                        <td><input type="time" name="{{ $day }}[start_time][]" value="{{ $calendars[$day]['start_time'][$key] }}" disabled></td>
                                        <td>to</td>
                                        <td><input type="time" name="{{ $day }}[end_time][]" value="{{ $calendars[$day]['end_time'][$key] }}" disabled></td>
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
            {{-- <a href="javaScript:;" class="btn btn-primary round">CONTACT {{ isset($family->name) ? explode(' ', $family->name)[0] : '' }}</a> --}}
            <a href="{{ route('view-families') }}" class="btn btn-primary round">BACK TO ALL FAMILIES</a>
        </div>
    </div>
</div>
@include ('user.includes.modal')
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

    /*send candidate application*/
    function handleApplication(event){
        event.preventDefault();
        var isLoggedIn         = "{{ session()->has('frontUser') ? true : false }}";
        var loggedInUserRole   = "{{ session()->has('frontUser') ? session()->get('frontUser')->role : null }}";

        if(!isLoggedIn){
            return false;
        }

        if(loggedInUserRole && (loggedInUserRole == "family" || loggedInUserRole == "family-petsitting")){
            var modalLabel    = "Warning";
            var modalIcon     = "<img src='{{ url('front/images/warning-icon1.png') }}' alt=''>"; 
            var message       = "Your need to be logged in as a candidate to be able to apply for the mentioned role"; 
            showModal(modalLabel, modalIcon, message, "{{ route('user-logout') }}", "Log Out");
            return false;
        }

        $.ajax({
            url: "{{ route('send-candidate-application') }}",
            type: "POST",
            data: {
                _token:     "{{ csrf_token() }}", 
                name:       "{{ session()->has('frontUser') ? session()->get('frontUser')->name : null }}",
                surname:    "{{ session()->has('frontUser') ? session()->get('frontUser')->surname : null }}",
                user_id:    "{{ session()->has('frontUser') ? session()->get('frontUser')->id : null }}",
                family_id:  "{{ $family->id ? $family->id : null }}",
                services:   "{{ $family->what_do_you_need ? $family->what_do_you_need : null }}",
            },
            success: function(response) {
                var modalLabel    = "Success";
                var modalIcon     = "<img src='{{ url('front/images/success-check-icon1.png') }}' alt=''>"; 
                var message       = "Your application have been sent to admin successfully"; 
                showModal(modalLabel, modalIcon, message, "{{ route('view-families') }}", 'Back to all families');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ', ' + error);
                console.log('XHR:', xhr);
            }
        });
    }

    function showModal(modalLabel, modalIcon, message, url, text){
        $("#alert-modal-label").html(modalLabel);
        $("#alert-modal-icon").html(modalIcon);
        $("#alert-modal-body").html(message);
        $("#alert-modal-action-btn").attr('href', url).text(text);
        $('#alert-modal').modal('show');
    }
</script>
@endsection
