@extends('layouts.main')
@section('content')
@include('flash.front-message')
<div class="candidate-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="candidate-img">
                    @if(isset($family->profile))
                        <img src="{{ asset('storage/app/public/uploads/'.$family->profile) }}" alt="">
                    @else
                        <img src="{{ asset('storage/app/public/uploads/user-profile.png') }}" alt="">
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
        var isLoggedIn = "{{ session()->has('frontUser') ? true : false }}";
        
        if(!isLoggedIn){
            return false;
        }

        $.ajax({
            url: "{{ route('send-candidate-application') }}",
            type: "POST",
            data: {
                _token:     "{{ csrf_token() }}", 
                name:       "{{ session()->get('frontUser')->name }}",
                surname:    "{{ session()->get('frontUser')->surname }}",
                user_id:    "{{ session()->get('frontUser')->id }}",
                family_id:  "{{ $family->id }}",
                services:   "{{ $family->what_do_you_need }}",
            },
            success: function(response) {
                showModal('Your application have been sent to admin successfully');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ', ' + error);
            }
        });
    }

    function showModal(message){
        $("#alert-modal-label").html("Success");
        $("#alert-modal-icon").html("<img src='{{ url('front/images/success-check-icon1.png') }}' alt=''>");
        $("#alert-modal-body").html(message);
        $("#alert-modal-action-btn").attr('href', '{{ route('view-families') }}').text('Back to all families');
        $('#alert-modal').modal('show');
    }
</script>
@endsection
