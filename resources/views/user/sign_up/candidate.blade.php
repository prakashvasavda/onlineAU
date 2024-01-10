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
                    <div class="signUp d-flex flex-row align-items-center justify-content-end gap-3">
                        <h2 class="text-capitalize mb-0">I am a..</h2>
                        <ul class="banner-btn-list">
                            <li>
                                <a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-aupairs-works" class="btn btn-light">Au-Pair</a>
                            </li>
                            <li>
                                <a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-nannies-works" class="btn btn-light">Nanny</a>
                            </li>
                            <li>
                                <a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-babysitters-works" class="btn btn-light">Babysitter</a>
                            </li>
                            <li>
                                <a href="{{ route('sign-up', ['service' => 'candidate']) }}#how-petsitters-works" class="btn btn-light">Pet sitter</a>
                            </li>
                        </ul>
                    </div>
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
                                    <p>Register As An Au-pair And Fill Out Our Registration Form.</p>
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
                                    <p>You Will Then Have To Go Through The Screening Process. Which Will Include An Online Interview And Reference Checks.</p>
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
                                    <p>Create Your Profile And Apply For Available Positions.</p>
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
                        <li>19 Years Or Older.</li>
                        <li>Valid Driver’s License.</li>
                        <li>Own Reliable Vehicle.</li>
                        <li>Matric Certificate.</li>
                        <li>Minimum Of 2 Contactable References.</li>
                        <li>Clean Criminal Record.</li>
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
                                    <p>Register As A Nanny And Fill Out Our Registration Form.</p>
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
                                    <p>You Will Then Have To Go Through The Screening Process. Which Will Include An Online Interview And Reference Checks.</p>
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
                                    <p>Create Your Profile And Apply For Available Positions.</p>
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
                        <li>23 Years Or Older.</li>
                        <li>Minimum Of 2 Years’ Experience With Children.</li>
                        <li>Minimum Of 2 Contactable References.</li>
                        <li>Clean Criminal Record.</li>
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
                                    <p>Register As A Babysitter And Fill Out Our Registration Form.</p>
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
                                    <p>You Will Then Have To Go Through The Screening Process. Which Will Include An Online Interview And Reference Checks.</p>
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
                                    <p>Create Your Profile And Apply For Available Positions.</p>
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
                        <li>18 Years Or Older.</li>
                        <li>Valid Driver’s License.</li>
                        <li>Minimum Of 2 Contactable References.</li>
                        <li>Clean Criminal Record.</li>
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
                                    <p>Register As A Pet Sitter And Fill Out Our Registration Form.</p>
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
                                    <p>You Will Then Have To Go Through The Screening Process. Which Will Include An Online Interview And Reference Checks.</p>
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
                                    <p>Create Your Profile And Apply For Available Positions.</p>
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
                        <li>18 Years Or Older.</li>
                        <li>Experience With Animals.</li>
                        <li>Minimum Of 2 Contactable References.</li>
                        <li>Clean Criminal Record.</li>
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
