@extends('layouts.main')

@section('content')
<div class="banner-section">
    <div class="banner-img">
        <img src="{{ asset('front/images/bannerImg2.png') }}" alt="">
    </div>
    <div class="banner-content bottomRight">
        <div class="container">
            <h2>family</h2>
        </div>
    </div>
</div>

<div class="steps-section" id="howWorks">
    <div class="container">
        <div class="title-main mb-5">
            <h2>family registration</h2>
        </div>
        <div class="subTitleBox text-center mb-5">
            <h3>how it works:</h3>
        </div>
        <ul class="step-list">
            <li class="step-item">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="step-img">
                        <img src="{{ asset('front/images/step1.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="step-contentBox">
                        <p>REGISTER AS A FAMILY AND FILL OUT THE REGISTRATION FORM.</p>
                    </div>
                </div>
            </li>
            <li class="step-item">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="step-img">
                        <img src="{{ asset('front/images/step2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="step-contentBox">
                        <p>SELECT YOUR PREFERRED PACKAGE (SELF PLACEMENT OR PRIVATE PLACEMENT) AND CONTINUE TO PAYMENT.</p>
                    </div>
                </div>
            </li>
            <li class="step-item">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="step-img">
                        <img src="{{ asset('front/images/step3.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="step-contentBox">
                        <p>VIEW ALL THE CANDIDATES THAT MEET YOUR REQUIREMENTS AND SCHEDULE INTERVIEWS.</p>
                    </div>
                </div>
            </li>
            <li class="step-item">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="step-img">
                        <img src="{{ asset('front/images/step4.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="step-contentBox">
                        <p>FIND THE PERFECT MATCH FOR YOUR FAMILY.</p>
                    </div>
                </div>
            </li>
        </ul>
        <div class="btn-main text-center">
            <a href="{{ route('family-register') }}" class="btn btn-primary round" id="available-candidates">register my family now</a>
        </div>
    </div>
</div>

<div class="available-candidates">
    <div class="container">
        <div class="title-main mb-5">
            <h2>available candidates</h2>
        </div>
        @include('flash.flash-message')
        <div class="candidate-slider">
            @if(isset($candidates))
                @foreach($candidates as $candidate_list)
                    <a href="{{ url('candidate-detail/'. $candidate_list['id']) }}">
                        <div class="candidate-slide">
                            <div class="candidate-img">
                                @if(isset($candidate_list["profile"]))
                                    <img src="{{ url('../storage/app/public/uploads/'.$candidate_list["profile"]) }}" alt="">
                                @else
                                    <img src="{{ url('../storage/app/public/uploads/user-profile.png') }}" alt="">
                                @endif
                            </div>
                            <div class="candidate-detail">
                                <h4>{{ $candidate_list['name'] }}</h4>
                                <h5>{{ ucfirst($candidate_list['role']) }}</h5>
                                <h6>{{ $candidate_list['ethnicity'] }}</h6>
                                <div class="rating">
                                    <span>
                                        @if(isset($candidate_list->review_rating_count) && is_string($candidate_list->review_rating_count))
                                            @for($i = 0; $i < 5; $i++)
                                                @if($i < max(explode(",", $candidate_list->review_rating_count)))
                                                    <i class="fa-solid fa-star"></i>
                                                @else
                                                    <i class="fa-regular fa-star"></i>
                                                @endif
                                            @endfor
                                        @else
                                            @for($i=0; $i<5; $i++)
                                                <i class="fa-regular fa-star"></i>
                                            @endfor
                                        @endif 
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        <div class="btn-main text-center">
            <a href="{{ route('all-candidates') }}" class="btn btn-primary round">view all candidates</a>
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
@endsection
