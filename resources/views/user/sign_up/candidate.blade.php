@extends('layouts.main')

@section('content')
<div class="banner-section py-5" style="background-image: url(' {{ asset("front/images/bannerImg3.png") }} ');">
    <div class="banner-img d-none">
        <img src="{{ asset('front/images/bannerImg3.png') }}" alt="">
    </div>
    <div class="banner-content centerLeft p-0 position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h2>Welcome candidates</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <ul class="banner-btn-list">
                        <li>
                            <a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-aupairs-works" class="btn btn-light">I am an Au-Pair</a>
                        </li>
                        <li>
                            <a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-nannies-works" class="btn btn-light">I am a Nanny</a>
                        </li>
                        <li>
                            <a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-babysitters-works" class="btn btn-light">I am a Babysitter</a>
                        </li>
                        <li>
                            <a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-petsitters-works" class="btn btn-light">I am a Pet sitter</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="steps-section-list">
    <div class="steps-section" id="how-aupairs-works">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Au-Pairs</h2>
            </div>
            <div class="row">
                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-now">
                        <h3>Sign Up Now!</h3>
                        <a href="{{ route('candidate-register','au-pairs') }}" class="btn btn-white round">SIGN UP</a>
                    </div>
                </div> -->
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 border-end">
                    <div class="subTitleBox mb-5">
                        <h3>how it works:</h3>
                    </div>
                    <ul class="step-list">
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step1.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>REGISTER AS AN AU-PAIR AND FILL OUT OUR REGISTRATION FORM.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>YOU WILL THEN HAVE TO GO THROUGH THE SCREENING PROCESS. WHICH WILL INCLUDE AN ONLINE INTERVIEW AND REFERENCE CHECKS.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step3.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>CREATE YOUR PROFILE AND APPLY FOR AVAILABLE POSITIONS.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="subTitleBox mb-5">
                        <h3>REQUIREMENTS:</h3>
                    </div>
                    <ul class="requirements-list">
                        <li>19 YEARS OR OLDER.</li>
                        <li>VALID DRIVER’S LICENSE.</li>
                        <li>OWN RELIABLE VEHICLE.</li>
                        <li>MATRIC CERTIFICATE.</li>
                        <li>MINIMUM OF 2 CONTACTABLE REFERENCES.</li>
                        <li>CLEAN CRIMINAL RECORD.</li>
                    </ul>
                </div>
            </div>
            <div class="sign-now text-center mt-5">
                <a href="{{ route('candidate-register','au-pairs') }}" class="btn btn-primary round">SIGN UP</a>
            </div>
        </div>
    </div>
    <div class="steps-section" id="how-nannies-works">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Nannies</h2>
            </div>
            <div class="row">
                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-now">
                        <h3>Sign Up Now!</h3>
                        <a href="{{ route('candidate-register','nannies') }}" class="btn btn-white round">SIGN UP</a>
                    </div>
                </div> -->
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 border-end">
                    <div class="subTitleBox mb-5">
                        <h3>how it works:</h3>
                    </div>
                    <ul class="step-list">
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step1-white.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>REGISTER AS A NANNY AND FILL OUT OUR REGISTRATION FORM.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step2-white.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>YOU WILL THEN HAVE TO GO THROUGH THE SCREENING PROCESS. WHICH WILL INCLUDE AN ONLINE INTERVIEW AND REFERENCE CHECKS.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step3-white.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>CREATE YOUR PROFILE AND APPLY FOR AVAILABLE POSITIONS.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="subTitleBox mb-5">
                        <h3>REQUIREMENTS:</h3>
                    </div>
                    <ul class="requirements-list">
                        <li>23 YEARS OR OLDER.</li>
                        <li>MINIMUM OF 2 YEARS’ EXPERIENCE WITH CHILDREN.</li>
                        <li>MINIMUM OF 2 CONTACTABLE REFERENCES.</li>
                        <li>CLEAN CRIMINAL RECORD.</li>
                    </ul>
                </div>
            </div>
            <div class="sign-now text-center mt-5">
                <a href="{{ route('candidate-register','nannies') }}" class="btn btn-white round">SIGN UP</a>
            </div>
        </div>
    </div>
    <div class="steps-section" id="how-babysitters-works">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Babysitters</h2>
            </div>
            <div class="row">
                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-now">
                        <h3>Sign Up Now!</h3>
                        <a href="{{ route('candidate-register','babysitters') }}" class="btn btn-white round">SIGN UP</a>
                    </div>
                </div> -->
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 border-end">
                    <div class="subTitleBox mb-5">
                        <h3>how it works:</h3>
                    </div>
                    <ul class="step-list">
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step1-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>REGISTER AS A BABYSITTER AND FILL OUT OUR REGISTRATION FORM.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step2-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>YOU WILL THEN HAVE TO GO THROUGH THE SCREENING PROCESS. WHICH WILL INCLUDE AN ONLINE INTERVIEW AND REFERENCE CHECKS.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step3-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>CREATE YOUR PROFILE AND APPLY FOR AVAILABLE POSITIONS.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="subTitleBox mb-5">
                        <h3>REQUIREMENTS:</h3>
                    </div>
                    <ul class="requirements-list">
                        <li>18 YEARS OR OLDER.</li>
                        <li>VALID DRIVER’S LICENSE.</li>
                        <li>MINIMUM OF 2 CONTACTABLE REFERENCES.</li>
                        <li>CLEAN CRIMINAL RECORD.</li>
                    </ul>
                </div>
            </div>
            <div class="sign-now text-center mt-5">
                <a href="{{ route('candidate-register','babysitters') }}" class="btn btn-white round">SIGN UP</a>
            </div>
        </div>
    </div>
    <div class="steps-section" id="how-petsitters-works">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Petsitters</h2>
            </div>
            <div class="row">
                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-now">
                        <h3>Sign Up Now!</h3>
                        <a href="{{ route('candidate-register','petsitters') }}" class="btn btn-white round">SIGN UP</a>
                    </div>
                </div> -->
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 border-end">
                    <div class="subTitleBox mb-5">
                        <h3>how it works:</h3>
                    </div>
                    <ul class="step-list">
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step1-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>REGISTER AS A PET SITTER AND FILL OUT OUR REGISTRATION FORM..</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step2-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>YOU WILL THEN HAVE TO GO THROUGH THE SCREENING PROCESS. WHICH WILL INCLUDE AN ONLINE INTERVIEW AND REFERENCE CHECKS.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step3-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>CREATE YOUR PROFILE AND APPLY FOR AVAILABLE POSITIONS.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="subTitleBox mb-5">
                        <h3>REQUIREMENTS:</h3>
                    </div>
                    <ul class="requirements-list">
                        <li>18 YEARS OR OLDER.</li>
                        <li>EXPERIENCE WITH ANIMALS.</li>
                        <li>MINIMUM OF 2 CONTACTABLE REFERENCES.</li>
                        <li>CLEAN CRIMINAL RECORD.</li>
                    </ul>
                </div>
            </div>
            <div class="sign-now text-center mt-5">
                <a href="{{ route('candidate-register','petsitters') }}" class="btn btn-white round">SIGN UP</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        
    });
</script>
@endsection
