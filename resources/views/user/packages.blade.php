@extends('layouts.main')
@section('content')
<style>
    .py-5 {
        padding-top: 5rem!important;
        padding-bottom: 5rem!important;
    }
    .pt-5 {
        padding-top: 5rem!important;
    }
    .row.row-gap-5 {
        row-gap: 5rem;
    }
    .pricing-box {
        border: 1px solid var(--secondary);
        display: flex;
        flex-flow: column;
        height: 100%;
        word-break: break-all;
    }
    .pricing-box .name-box {
        background-color: var(--secondary);
        text-align: center;
        padding: 1.1rem;
        color: var(--white);
        text-transform: uppercase;
        font-family: var(--bellefair-font);
        font-size: 1.2rem;
        line-height: 1.3;
    }
    .pricing-box .price-box {
        background-color: var(--primary);
        text-align: center;
        padding: 0.7rem;
        color: var(--white);
        text-transform: uppercase;
        font-family: var(--montserrat-font);
        line-height: 1.3;
        font-weight: 600;
    }
    .pricing-box .features {
        flex: 1 0 auto;
        padding: 2rem 1.6rem;
        display: flex;
        flex-flow: column;
        gap: 8px;
    }
    .pricing-box .features li {
        color: var(--gray-text);
        text-transform: unset;
        font-family: var(--montserrat-font);
        font-size: 15px;
        line-height: 1.3;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
    }
    .pricing-box .features li svg, .pricing-box .features li i {
        margin-right: 8px;
        margin-top: 6px;
        width: 5px;
        height: 5px;
        font-size: 5px;
    }
    @media screen and (min-width: 992px) and (max-width: 1299px) {
        .pricing-plans .row .col-lg-6 .row .col-lg-4 {flex: 0 0 auto;width: 50%;}
    }
    @media screen and (max-width: 767px) {
        .py-5 {padding-top: 4rem!important;padding-bottom: 4rem!important;}
        .pt-5 {padding-top: 4rem!important;}
        .row.row-gap-5 {row-gap: 4rem;}
    }
</style>
<div class="pricing-plans no-banner">
    <div class="container">
        <div class="row row-gap-5 justify-content-center">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="pricing-plans-main">
                    <div class="title-main">
                        <h2>au-pairs</h2>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" id="form_one" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="1500">
                                <input type="hidden" name="item_name" value="au-pair self placement package">
                                <input type="hidden" name="end_date" value="60">
                                <a href="#" onclick="document.getElementById('form_one').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">SELF PLACEMENT PACKAGE</div>
                                        <div class="price-box display-6">R 1500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You are your own agent.</li>
                                            <li><i class="fa-solid fa-circle"></i>Full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>3 Month warranty</li>
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract.</li>
                                        </ul>
                                    </div>
                                </a>
                            </form>
                        </div>
                        

                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" id="form_two" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="3000">
                                <input type="hidden" name="item_name" value="au-pair private placement package">
                                <input type="hidden" name="end_date" value="365">
                                <a href="#" onclick="document.getElementById('form_two').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">PRIVATE PLACEMENT PACKAGE</div>
                                        <div class="price-box display-6">R 3000</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>We assign an agent to you.</li>
                                            <li><i class="fa-solid fa-circle"></i>We find the perfect candidate for your specific needs.</li>
                                            <li><i class="fa-solid fa-circle"></i>3 Month warranty</li>
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract.</li>
                                        </ul>
                                    </div>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="pricing-plans-main">
                    <div class="title-main">
                        <h2>nannies</h2>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" id="form_three" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="3000">
                                <input type="hidden" name="item_name" value="nannies self placement package">
                                <input type="hidden" name="end_date" value="60">
                                <a href="#" onclick="document.getElementById('form_three').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">SELF PLACEMENT PACKAGE</div>
                                        <div class="price-box display-6">R 1500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You are your own agent.</li>
                                            <li><i class="fa-solid fa-circle"></i>Full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>3 Month warranty</li>
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract.</li>
                                        </ul>
                                    </div>
                                </a>
                            </form>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" id="form_four" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="3000">
                                <input type="hidden" name="item_name" value="nannies private placement package">
                                <input type="hidden" name="end_date" value="365">
                                <a href="#" onclick="document.getElementById('form_four').submit(); return false;">
                                     <div class="pricing-box">
                                        <div class="name-box">PRIVATE PLACEMENT PACKAGE</div>
                                        <div class="price-box display-6">R 3000</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>We assign an agent to you.</li>
                                            <li><i class="fa-solid fa-circle"></i>We find the perfect candidate for your specific needs.</li>
                                            <li><i class="fa-solid fa-circle"></i>3 Month warranty</li>
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract.</li>
                                        </ul>
                                    </div>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="pricing-plans-main">
                    <div class="title-main">
                        <h2>babysitters</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" id="form_five" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="250">
                                <input type="hidden" name="item_name" value="babysitters 1 month package">
                                <input type="hidden" name="end_date" value="30">
                                <a href="#" onclick="document.getElementById('form_five').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">1 MONTH PACKAGE</div>
                                        <div class="price-box display-6">R 250</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to a months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                    </div>
                                </a>
                            </form>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" id="form_six" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="500">
                                <input type="hidden" name="item_name" value="babysitters 2 month package">
                                <input type="hidden" name="end_date" value="60">
                                <a href="#" onclick="document.getElementById('form_six').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">2 MONTH PACKAGE</div>
                                        <div class="price-box display-6">R 500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                    </div>
                                </a>
                            </form>   
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="pricing-plans-main">
                    <div class="title-main">
                        <h2>pet sitters</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" id="form_seven" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="250">
                                <input type="hidden" name="item_name" value="pet sitters 1 month package">
                                <input type="hidden" name="end_date" value="30">
                                <a href="#" onclick="document.getElementById('form_seven').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">1 MONTH PACKAGE</div>
                                        <div class="price-box display-6">R 250</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to a months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                    </div>
                                </a>
                            </form>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" id="form_eight" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="500">
                                <input type="hidden" name="item_name" value="pet sitter 2 month package">
                                <input type="hidden" name="end_date" value="60">
                                <a href="#" onclick="document.getElementById('form_eight').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">2 MONTH PACKAGE</div>
                                        <div class="price-box display-6">R 500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                    </div>
                                </a>
                            </form>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function userSubscription(){
        var status = $('#subscribe_chkbx').is(':checked') ? 1 : 0;
        $.ajax({
            type: "POST",
            url: "{{ route('cancel-user-subscription') }}",
            data: {
                    status:status,
                    _token: "{{ csrf_token() }}",
                    id: {{ isset($user_subscription->id) ? $user_subscription->id : 0 }}
            },
            success: function (response) {
                if(response === "success"){
                   location.reload();
                }
            }
        });
    }
</script>
@endsection
