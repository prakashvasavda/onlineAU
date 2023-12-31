@extends('layouts.main')
@section('css')
@endsection
@section('content')
<div class="banner-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-0">
                <div class="banner-img">
                    <img src="{{ asset('front/images/bannerImg4.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-0">
                <div class="banner-img">
                    <img src="{{ asset('front/images/bannerImg5.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="banner-content centerLeft">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h2><a href="{{ route('sign-up', ['service' => 'candidate']) }}">For CANDIDATES</a></h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h2><a href="{{ route('sign-up', ['service' => 'family']) }}">For family</a></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-section" id="aboutUs">
    <div class="container">
        <div class="contact-inner">
            <a href="{{ route('contact-us') }}" class="btn btn-primary round">contact us</a>
        </div>
    </div>
</div>

<div class="about-section" >
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="about-img">
                    <img src="{{ asset('front/images/about-img1.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="about-content title-main text-center">
                    <h2>about us</h2>
                    <p>WELCOME TO ONLINE AU-PAIRS, YOUR GATEWAY TO FINDING THE PERFECT CANDIDATE AND UNPARALLELED CHILDCARE EXPERIENCES. AS A AGENCY, WE ARE COMMITTED TO ENRICHING THE LIVES OF FAMILIES AND CANDIDATES ALIKE, CREATING BONDS THAT TRANSCEND BORDERS AND NURTURING FUTURES FILLED WITH SHARED MEMORIES AND GROWTH.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="services-section">
    <div class="container">
        <div class="title-main">
            <h2>Our Services</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="{{ route('candidates-service', ['service' => 'petsitters']) }}">
                    <div class="service-box">
                        <img src="{{ asset('front/images/petSitting-icon1.png') }}" alt="">
                        <h3 class="service-name">Pet Sitting</h3>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="{{ route('candidates-service', ['service' => 'au-pairs']) }}">
                    <div class="service-box">
                        <img src="{{ asset('front/images/auPairs-icon1.png') }}" alt="">
                        <h3 class="service-name">Au-Pairs</h3>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="{{ route('candidates-service', ['service' => 'nannies']) }}">
                    <div class="service-box">
                        <img src="{{ asset('front/images/nannies-icon1.png') }}" alt="">
                        <h3 class="service-name">nannies</h3>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="{{ route('candidates-service', ['service' => 'babysitters']) }}">
                    <div class="service-box">
                        <img src="{{ asset('front/images/babysitting-icon1.png') }}" alt="">
                        <h3 class="service-name">babysitting</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
