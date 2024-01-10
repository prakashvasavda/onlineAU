@extends('layouts.main')
@section('content')
<div class="pricing-plans no-banner">
    <div class="container">
        <div class="alert alert-primary alert-dismissible" role="alert">
            <p><strong>Success!</strong> Please add your preferred packages to your basket and proceed to checkout. After payment has been received, your profile will be activated, and you will be granted access!</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        <div class="row row-gap-5 justify-content-center">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="pricing-plans-main">
                    <div class="title-main">
                        <h2>au-pairs</h2>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="aupairs_first">
                            <form method="POST" id="form_one" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="1500">
                                <input type="hidden" name="item_name" value="au-pair self placement package">
                                <input type="hidden" name="end_date" value="60">
                                <a href="#" onclick="return false; document.getElementById('form_one').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">SELF PLACEMENT PACKAGE</div>
                                        <div class="price-box display-6">R 1500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You are your own agent.</li>
                                            <li><i class="fa-solid fa-circle"></i>Full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>3 Month warranty</li>
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract available upon request.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('au-pair self placement package', 'aupairs_first')" data-id="first_package" class="btn btn-primary round">Add to Cart</a>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="aupairs_second">
                            <form method="POST" id="form_two" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="3000">
                                <input type="hidden" name="item_name" value="au-pair private placement package">
                                <input type="hidden" name="end_date" value="365">
                                <a href="#" onclick="return false; document.getElementById('form_two').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">PRIVATE PLACEMENT PACKAGE</div>
                                        <div class="price-box display-6">R 3000</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>We assign an agent to you.</li>
                                            <li><i class="fa-solid fa-circle"></i>We find the perfect candidate for your specific needs.</li>
                                            <li><i class="fa-solid fa-circle"></i>3 Month warranty</li>
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract available upon request.</li>
                                            <li><i class="fa-solid fa-circle"></i>Admin fee will be applicable</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="{{ route('contact-us') }}" class="btn btn-primary round">Contact Us</a>
                                        </div>
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
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="nannies_first">
                            <form method="POST" id="form_three" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="3000">
                                <input type="hidden" name="item_name" value="nannies self placement package">
                                <input type="hidden" name="end_date" value="60">
                                <a href="#" onclick="return false; document.getElementById('form_three').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">SELF PLACEMENT PACKAGE</div>
                                        <div class="price-box display-6">R 1500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You are your own agent.</li>
                                            <li><i class="fa-solid fa-circle"></i>Full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>3 Month warranty</li>
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract available upon request.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('nannies self placement package', 'nannies_first')" class="btn btn-primary round">Add to Cart</a>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="nannies_second">
                            <form method="POST" id="form_four" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="3000">
                                <input type="hidden" name="item_name" value="nannies private placement package">
                                <input type="hidden" name="end_date" value="365">
                                <a href="#" onclick="return false; document.getElementById('form_four').submit(); return false;">
                                     <div class="pricing-box">
                                        <div class="name-box">PRIVATE PLACEMENT PACKAGE</div>
                                        <div class="price-box display-6">R 3000</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>We assign an agent to you.</li>
                                            <li><i class="fa-solid fa-circle"></i>We find the perfect candidate for your specific needs.</li>
                                            <li><i class="fa-solid fa-circle"></i>3 Month warranty</li>
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract available upon request.</li>
                                            <li><i class="fa-solid fa-circle"></i>Admin fee will be applicable</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="{{ route('contact-us') }}" class="btn btn-primary round">Contact Us</a>
                                        </div>
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
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="babysitters_first">
                            <form method="POST" id="form_five" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="250">
                                <input type="hidden" name="item_name" value="1 Month subscription">
                                <input type="hidden" name="end_date" value="30">
                                <a href="#" onclick="return false; document.getElementById('form_five').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">1 Month subscription</div>
                                        <div class="price-box display-6">R 250</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to a months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('babysitters 1 month subscription', 'babysitters_first')" class="btn btn-primary round">Add to Cart</a>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="babysitters_second">
                            <form method="POST" id="form_six" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="500">
                                <input type="hidden" name="item_name" value="2 Month subscription">
                                <input type="hidden" name="end_date" value="60">
                                <a href="#" onclick="return false; document.getElementById('form_six').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">2 Month subscription</div>
                                        <div class="price-box display-6">R 500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('babysitters 2 month subscription', 'babysitters_second')" class="btn btn-primary round">Add to Cart</a>
                                        </div>
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
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="petsitters_first">
                            <form method="POST" id="form_seven" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="250">
                                <input type="hidden" name="item_name" value="pet sitters 1 month package">
                                <input type="hidden" name="end_date" value="30">
                                <a href="javascript void(0)" onclick="return false; document.getElementById('form_seven').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">1 Month subscription</div>
                                        <div class="price-box display-6">R 250</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to a months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('pet sitters 1 month subscription', 'petsitters_first')" class="btn btn-primary round">Add to Cart</a>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="petsitters_second">
                            <form method="POST" id="form_eight" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="500">
                                <input type="hidden" name="item_name" value="pet sitter 2 month package">
                                <input type="hidden" name="end_date" value="60">
                                <a href="#" onclick="return false; document.getElementById('form_eight').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">2 Month subscription</div>
                                        <div class="price-box display-6">R 500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('pet sitters 2 month subscription', 'petsitters_second')" class="btn btn-primary round">Add to Cart</a>
                                        </div>
                                    </div>
                                </a>
                            </form>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-main text-center mt-5 d-none">
            <a href="{{ route('checkout') }}" class="btn btn-secondary round fw-bold">Checkout</a>
        </div>
    </div>
</div>
@include ('user.includes.modal')
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

    function addItemToCart(package_name, block_id){
        event.preventDefault();
        var checkUser = {{ session()->has('frontUser') || session()->has('guestUser') ? "true" : "false" }};
        
        if(checkUser == false){
            return false;
        }
        
        $('#'+block_id).css({
          'pointer-events': 'none',
          'opacity': '0.4'
        });
        
        $("#cart-modal").modal("show");
        $("#cart-modal-body").html('<img src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/AjaxLoader.gif">');

        $.ajax({
            type: "POST",
            url: "{{ url('cart') }}",
            data: {
                    _token: "{{ csrf_token() }}",
                    package_name:package_name,
                    block_id: block_id,
            },
            success: function (response) {
                $('.counterNumber').text(response.total_items);
                $("#cart-modal-body").html('Go to checkout or add another package');
            }
        });
    }
</script>
@endsection
