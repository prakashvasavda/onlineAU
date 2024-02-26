<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <ul class="about-candidate-box">
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/gender-icon1.png') }}" alt="">
                    <h4>GENDER:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->gender) ? $candidate->gender : '-' }}</h4>
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
                    <img src="{{ url('front/images/language-icon1.png') }}" alt="">
                    <h4>HOME LANGUAGE:</h4>
                </div>
                <div class="about-candidate-content">
                     <h4>{{ isset($candidate->home_language) ? ucfirst($candidate->home_language) : '-' }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/language-icon1.png') }}" alt="">
                    <h4>additional language:</h4>
                </div>
                <div class="about-candidate-content">
                     <h4>{{ isset($candidate->additional_language) ? ucfirst($candidate->additional_language) : '-' }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/firstAid-icon1.png') }}" alt="">
                    <h4>FIRST AID:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->first_aid) ? ucfirst($candidate->first_aid) : '-' }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/smoker_NonSmoker-icon1.png') }}" alt="">
                    <h4>SMOKER/NON SMOKER:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->smoker_or_non_smoker) ? str_replace("_", " ", $candidate->smoker_or_non_smoker) : '-' }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/medications-icon1.png') }}" alt="">
                    <h4>Chronical medication:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->chronical_medication) ? $candidate->chronical_medication : '-' }}</h4>
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
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/home-live-in-icon1.png') }}" alt="">
                    <h4>LIVE-IN OR LIVE-OUT:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->live_in_or_live_out) ? ucfirst(str_replace("_", "-", $candidate->live_in_or_live_out)) : '-' }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/ageGroup-icon1.png') }}" alt="">
                    <h4>AGES OF CHILDREN YOU WORKED WITH:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->child_ages) ? ucwords(str_replace("_", "-", $candidate->child_ages)) : '-' }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/experience_special_needs-icon1.png') }}" alt="">
                    <h4>EXPERIENCE WITH SPECIAL NEEDS:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->experience_special_needs) ? $candidate->experience_special_needs : "-" }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/Salary_HourlyRate-icon1.png') }}" alt="">
                    <h4>SALARY / Hourly rate:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ $candidate->salary_expectation ? "R".$candidate->salary_expectation : "-" }} / {{ $candidate->hourly_rate_pay ? "R".$candidate->hourly_rate_pay : "-" }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/availableDate-icon1.png') }}" alt="">
                    <h4>AVAILABLE FROM:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->available_date) ? $candidate->available_date : '-' }}</h4>
                </div>
            </li>
        </ul>
    </div>
</div>