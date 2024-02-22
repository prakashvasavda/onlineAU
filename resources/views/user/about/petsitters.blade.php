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
                    <img src="{{ url('front/images/language-icon1.png') }}" alt="">
                    <h4>HOME LANGUAGE:</h4>
                </div>
                <div class="about-candidate-content">
                     <h4>{{ $candidate->home_language ?? '-' }}</h4>
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
        </ul>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <ul class="about-candidate-box">
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/dependants-icon1.png') }}" alt="">
                    <h4>experience with animals:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ $candidate->experience_with_animals ?? "-" }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/Salary_HourlyRate-icon1.png') }}" alt="">
                    <h4>Hourly rate:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->hourly_rate_pay) ? "R".$candidate->hourly_rate_pay : "-" }}</h4>
                </div>
            </li>
            <li class="equalHeight">
                <div class="about-candidate-title">
                    <img src="{{ url('front/images/dependants-icon1.png') }}" alt="">
                    <h4>animals comfortable working with:</h4>
                </div>
                <div class="about-candidate-content">
                    <h4>{{ isset($candidate->animals_work_with) ? str_replace("_", " ", $candidate->animals_work_with) : '-' }}</h4>
                </div>
            </li>
        </ul>
    </div>
</div>