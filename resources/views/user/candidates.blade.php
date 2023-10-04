@extends('layouts.main')

@section('content')
<div class="banner-section">
    <div class="banner-img">
        <img src="{{ asset('front/images/bannerImg3.png') }}" alt="">
    </div>
    <div class="banner-content centerLeft">
        <div class="container">
            <h2>candidates</h2>
        </div>
    </div>
</div>

<div class="steps-section-list">
    <div class="steps-section">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Au-Pairs</h2>
            </div>
            <div class="subTitleBox mb-5">
                <h3>how it works:</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-now">
                        <h3>Sign Up Now!</h3>
                        <a href="{{ route('candidate-register','au-pairs') }}" class="btn btn-white round">SIGN UP</a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <ul class="step-list">
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step1.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>REGISTER AS AN AU-APIR AND FILL OUT OUR APPLICATION FORM.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>COMPLETE AN ONLINE INTERVIEW AND REFERENCE CHECKS.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step3.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>ADD YOUR PROFILE TO THE DATA BASE AND APPLY FOR AVAILABLE POSITIONS.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="subTitleBox mb-4">
                <h3>REQUIREMENTS:</h3>
            </div>
            <ul class="requirements-list">
                <li>MATRIC</li>
                <li>RELIABLECAR</li>
                <li>DRIVERSLICENSE</li>
                <li>PREVIOUSCHILDCAREEXPERIENCE</li>
            </ul>
        </div>
    </div>
    <div class="steps-section">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Nannies</h2>
            </div>
            <div class="subTitleBox mb-5">
                <h3>how it works:</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-now">
                        <h3>Sign Up Now!</h3>
                        <a href="{{ route('candidate-register','nannies') }}" class="btn btn-white round">SIGN UP</a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <ul class="step-list">
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step1-white.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>REGISTER AS A NANNY AND FILL OUT OUR APPLICATION FORM.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step2-white.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>COMPLETE AN ONLINE INTERVIEW AND REFERENCE CHECKS.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step3-white.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>ADD YOUR PROFILE TO THE DATA BASE AND APPLY FOR AVAILABLE POSITIONS.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="subTitleBox mb-4">
                <h3>REQUIREMENTS:</h3>
            </div>
            <ul class="requirements-list">
                <li>MINIMUMOF2CONTACTABLEREFERENCES</li>
                <li>PREVIOUSCHILDCAREEXPERIENCE</li>
            </ul>
        </div>
    </div>
    <div class="steps-section">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Babysitters</h2>
            </div>
            <div class="subTitleBox mb-5">
                <h3>how it works:</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-now">
                        <h3>Sign Up Now!</h3>
                        <a href="{{ route('candidate-register','babysitters') }}" class="btn btn-white round">SIGN UP</a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <ul class="step-list">
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step1-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>REGISTER AS A NANNY AND FILL OUT OUR APPLICATION FORM.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step2-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>COMPLETE AN ONLINE INTERVIEW AND REFERENCE CHECKS.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step3-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>ADD YOUR PROFILE TO THE DATA BASE AND APPLY FOR AVAILABLE POSITIONS.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="subTitleBox mb-4">
                <h3>REQUIREMENTS:</h3>
            </div>
            <ul class="requirements-list">
                <li>MATRIC</li>
                <li>RELIABLECAR</li>
                <li>DRIVERSLICENSE</li>
                <li>PREVIOUSCHILDCAREEXPERIENCE</li>
            </ul>
        </div>
    </div>
    <div class="steps-section">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Petsitters</h2>
            </div>
            <div class="subTitleBox mb-5">
                <h3>how it works:</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="sign-now">
                        <h3>Sign Up Now!</h3>
                        <a href="{{ route('candidate-register','petsitters') }}" class="btn btn-white round">SIGN UP</a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <ul class="step-list">
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step1-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>REGISTER AS A PETSITTER AND FILL OUT OUR APPLICATION FORM.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step2-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>COMPLETE AN ONLINE INTERVIEW AND REFERENCE CHECKS.</p>
                                </div>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="step-img">
                                    <img src="{{ asset('front/images/step3-theme2.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="step-contentBox">
                                    <p>ADD YOUR PROFILE TO THE DATA BASE AND APPLY FOR AVAILABLE POSITIONS.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="subTitleBox mb-4">
                <h3>REQUIREMENTS:</h3>
            </div>
            <ul class="requirements-list">
                <li>MUSTBERESPONSIBLEANDRELIABLE</li>
                <li>MUSTHAVEFLEXIBLEHOURS</li>
                <li>PREVIOUSEXPERIENCEWILLBEBENEFICIAL</li>
                <li>MUSTLOVEANIMALS</li>
            </ul>
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
