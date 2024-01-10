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
                                        <div class="name-box">SELF PLACEMENT PACKAGE test</div>
                                        <div class="price-box display-6">R 1500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You are your own agent.</li>
                                            <li><i class="fa-solid fa-circle"></i>Full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>3 Month warranty</li>
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('au-pair self placement package', 'aupairs_first')" data-id="first_package" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#cartBtnModal">Add to Cart</a>
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
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('au-pair private placement package', 'aupairs_second')" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#cartBtnModal">Add to Cart</a>
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
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('nannies self placement package', 'nannies_first')" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#cartBtnModal">Add to Cart</a>
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
                                            <li><i class="fa-solid fa-circle"></i>Template of employment contract.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('nannies private placement package', 'nannies_second')" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#cartBtnModal">Add to Cart</a>
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
                                <input type="hidden" name="item_name" value="self placement subscription">
                                <input type="hidden" name="end_date" value="30">
                                <a href="#" onclick="return false; document.getElementById('form_five').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">SELF PLACEMENT SUBSCRIPTION</div>
                                        <div class="price-box display-6">R 250</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to a months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('babysitters self placement subscription', 'babysitters_first')" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#cartBtnModal">Add to Cart</a>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="babysitters_second">
                            <form method="POST" id="form_six" action="{{ route('payment-process') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="500">
                                <input type="hidden" name="item_name" value="private placement subscription">
                                <input type="hidden" name="end_date" value="60">
                                <a href="#" onclick="return false; document.getElementById('form_six').submit(); return false;">
                                    <div class="pricing-box">
                                        <div class="name-box">PRIVATE PLACEMENT SUBSCRIPTION</div>
                                        <div class="price-box display-6">R 500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('babysitters private placement subscription', 'babysitters_second')" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#cartBtnModal">Add to Cart</a>
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
                                        <div class="name-box">SELF PLACEMENT SUBSCRIPTION</div>
                                        <div class="price-box display-6">R 250</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to a months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('pet sitters self placement subscription', 'petsitters_first')" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#cartBtnModal">Add to Cart</a>
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
                                        <div class="name-box">PRIVATE PLACEMENT SUBSCRIPTION</div>
                                        <div class="price-box display-6">R 500</div>
                                        <ul class="features">
                                            <li><i class="fa-solid fa-circle"></i>You have full access to all our available Candidates in your area for up to 2 months.</li>
                                            <li><i class="fa-solid fa-circle"></i>You will be responsible to pay the candidates hourly rate.</li>
                                        </ul>
                                        <div class="btn-main text-center p-4 pt-0">
                                            <a href="#" onclick="addItemToCart('pet sitters private placement subscription', 'petsitters_second')" class="btn btn-primary round" data-bs-toggle="modal" data-bs-target="#cartBtnModal">Add to Cart</a>
                                        </div>
                                    </div>
                                </a>
                            </form>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-main text-center mt-5">
            <a href="{{ route('checkout') }}" class="btn btn-secondary round fw-bold">Checkout</a>
        </div>
    </div>
</div>
@endsection
@section('script')

<div class="modal fade" id="cartBtnModal" tabindex="-1" aria-labelledby="cartBtnModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartBtnModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      </div>
      <div class="modal-body p-4">
        <h6 class="text-center pb-3">Go to checkout or add another package - content here</h6>
        <div class="btns-main d-flex flex-md-row justify-content-center align-items-center gap-3">
            <a href="javascript:;" class="btn btn-primary round">Go to Checkout</a>
            <a href="javascript:;" class="btn btn-secondary round">Another Package</a>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
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
            }
        });
    }
</script>
@endsection
