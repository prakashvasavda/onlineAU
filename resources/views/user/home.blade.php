@extends('layouts.main')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('front/css/search.css') }}">
@endsection
@section('content')
<div class="search-box search-elem">
    <a href="javaScript:;" class="close btn btn-primary round">x</a>
    <div class="inner row">
        <div class="col-lg-5 col-md-7 col-sm-12 col-xs-12 mx-auto">
            <div class="w-100 input-group d-flex flex-direction-row flex-wrap align-items-center">
                <select class="form-field" required>
                    <option disabled selected>Select</option>
                    <option value="candidate">Candidate</option>
                    <option value="family">Family</option>
                </select>
                <input type="text" placeholder="Search here" id="search-field" class="form-field">
                <div class="input-group-append">
                    <button id="" type="submit" class="submit btn btn-link text-secondary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    <h2>CANDIDATES</h2>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h2>family</h2>
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
                <a href="{{ route('candidate-register','petsitters') }}">
                    <div class="service-box">
                        <img src="{{ asset('front/images/petSitting-icon1.png') }}" alt="">
                        <h3 class="service-name">Pet Sitting</h3>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="{{ route('candidate-register','au-pairs') }}">
                    <div class="service-box">
                        <img src="{{ asset('front/images/auPairs-icon1.png') }}" alt="">
                        <h3 class="service-name">Au-Pairs</h3>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="{{ route('candidate-register','nannies') }}">
                    <div class="service-box">
                        <img src="{{ asset('front/images/nannies-icon1.png') }}" alt="">
                        <h3 class="service-name">nannies</h3>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="{{ route('candidate-register','babysitters') }}">
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
    (function ($) {
            $.fn.searchBox = function (ev) {

                var $searchEl = $('.search-elem');
                var $placeHolder = $('.placeholder');
                var $sField = $('#search-field');

                if (ev === "open") {
                    $searchEl.addClass('search-open')
                };

                if (ev === 'close') {
                    $searchEl.removeClass('search-open'),
                        $placeHolder.removeClass('move-up'),
                        $sField.val('');
                };

                var moveText = function () {
                    $placeHolder.addClass('move-up');
                }

                $sField.focus(moveText);
                $placeHolder.on('click', moveText);

                $('.submit').prop('disabled', true);
                $('#search-field').keyup(function () {
                    if ($(this).val() != '') {
                        $('.submit').prop('disabled', false);
                    }
                });
            }
        }(jQuery));

        $('.search-btn').on('click', function (e) {
            $(this).searchBox('open');
            e.preventDefault();
        });

        $('.close').on('click', function () {
            $(this).searchBox('close');
        });
</script>
@endsection
