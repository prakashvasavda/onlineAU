@extends('layouts.main')
@section('content')
<style type="text/css">
.pricing-plans .row form {
    height: 100%;
}
</style>

@if(isset($user_subscription) && now()->lt($end_date))
    <div class="single-form-section">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Payments</h2>
            </div>
            <div class="row justify-content-center align-items-stretch">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card border-light">
                        <h4 class="card-header">{{ isset($payment->name_first) ? $payment->name_first : '-' }}</h4>
                        <div class="card-body">
                            <p>{{ isset($payment->item_name) ? $payment->item_name : '-' }}<br></p>
                            <b>Date</b><br>
                            <p>{{ isset($payment->created_at) ? $payment->created_at : '-' }}</p>
                            <b>Amount</b><br>
                            <p>{{ isset($payment->amount_gross) ? $payment->amount_gross : '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card border-light">
                        <h4 class="card-header">Notes</h4>
                        <div class="card-body">
                            <p>[None added]</p>
                            <p><a class="show-dialog" href="#" data-bs-toggle="modal" data-bs-target="#dialog-invoice-notes">Add details for expense or tax declarations</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-input loader-overlay-wrapper">
                        <p class="mb-3 text-center">This is where you can download payment receipts for all completed bookings and your premium subscription.</p>
                        <div class="btn-main d-flex flex-wrap justify-content-center align-item-center">
                            <button class="btn btn-outline-primary round">
                                <i class="fa-solid fa-print"></i> Print
                            </button>
                            <a target="_blank" href="#" class="btn btn-outline-primary round ms-2">
                                <i class="fa-solid fa-download"></i> Download
                            </a>
                        </div>
                        <hr>
                        <p class="text-center">
                            <input type="checkbox" name="subscribe" id="subscribe_chkbx" {{ now()->lt($end_date) && isset($user_subscription->status) ? "checked" : " " }} id="" style="vertical-align: middle;" onclick="userSubscription()">
                            <a href="#" style="vertical-align: middle; pointer-events: none;">subscribe</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade dialog-invoice-notes" id="dialog-invoice-notes" tabindex="-1" aria-labelledby="dialog-invoice-notesLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header title-main">
                    <h3 class="modal-title p-0" id="dialog-invoice-notesLabel">Note</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-input">
                            <label for="editNotes">Add an address, Tax ID and any other details for expense or tax declarations.</label>
                            <textarea id="editNotes" name="invoice-notes-content" rows="5" class="form-field"></textarea>
                        </div>
                        <div class="form-input-btn mt-2">
                            <input type="submit" class="btn btn-primary round" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- <div class="pricing-plans no-banner">
        <div class="container">
            <div class="title-main">
                <h2>Pricing</h2>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12"></div>
                @if(isset($packages))
                    @foreach($packages as $key=>$price)
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" action="{{ route('payment-process') }}" id="pricing-form-{{$key}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $price['price'] }}">
                                <input type="hidden" name="item_name" value="{{ $price['name'] }}">
                                <input type="hidden" name="package" value="{{ $price['id'] }}">

                                <input type="hidden" name="custom_int1" value="{{ Session::has('frontUser') ? Session::get('frontUser')->id : '' }}">
                                <input type="hidden" name="name_first" value="{{ Session::has('frontUser') ? Session::get('frontUser')->name : '' }}">
                                <input type="hidden" name="name_last" value="{{ Session::has('frontUser') ? Session::get('frontUser')->name : '' }}">
                                <input type="hidden" name="email_address" value="{{ Session::has('frontUser') ? Session::get('frontUser')->email : '' }}">

                                <div class="pricing-card">
                                    <div class="heading">
                                        @if($key== 0)
                                            <span class="badge bg-secondary round">Popular</span>
                                        @endif
                                        <h4>{{ $price['name'] }}</h4>
                                        <p>for small websites or blogs</p>
                                    </div>

                                    <p class="price">{{ $price['price'] }}</p>
                                    <ul class="features">
                                        @if(isset($features))
                                            @foreach($features as $key=>$feature)
                                                @if($feature['package_id'] == $price['id'])
                                                    <li>
                                                        <i class="fa-solid fa-check"></i>
                                                        <strong>{{ $feature['title'] }}</strong>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                    <button type="submit" class="btn btn-primary round">SELECT</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                @endif
                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12"></div>
            </div>
        </div>
    </div> --}}

    <div class="pricing-plans no-banner">
        <div class="container">
            <div class="title-main">
                <h2>Pricing</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="pricing-card">
                        <div class="heading">
                            <h4>BASIC</h4>
                            <p>for small websites or blogs</p>
                        </div>
                        <p class="price">$2<sub>/month</sub></p>
                        <ul class="features">
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>1 domain</strong> name
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>10 GB</strong> of disk space
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>100GB </strong>of bandwidth
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>1 MySQL</strong> database
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>5 email</strong> accounts
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>cPanel</strong> control panel
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>Free SSL</strong> certificate
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>24/7</strong> support
                            </li>
                        </ul>
                        <a href="javaScript:;" class="btn btn-primary round">SELECT</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="pricing-card">
                        <div class="heading">
                            <span class="badge bg-secondary round">Popular</span>
                            <h4>STANDARD</h4>
                            <p>for medium-sized businesses</p>
                        </div>
                        <p class="price">$5<sub>/month</sub></p>
                        <ul class="features">
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>Unlimited</strong> domain name
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>50 GB</strong> of disk space
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>500GB </strong>of bandwidth
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>10 MySQL</strong> database
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>50 email</strong> accounts
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>cPanel</strong> control panel
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>Free SSL</strong> certificate
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>24/7</strong> support
                            </li>
                        </ul>
                        <a href="javaScript:;" class="btn btn-primary round">SELECT</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="pricing-card">
                        <div class="heading">
                            <h4>PREMIUM</h4>
                            <p>for small businesses</p>
                        </div>
                        <p class="price">$10<sub>/month</sub></p>
                        <ul class="features">
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>Unlimited</strong> domain name
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>100 GB</strong> of disk space
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>1TB </strong>of bandwidth
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>Unlimited MySQL</strong> database
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>Unlimited email</strong> accounts
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>cPanel</strong> control panel
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>Free SSL</strong> certificate
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>24/7 priority</strong> support
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <strong>Advanced</strong> security features
                            </li>
                        </ul>
                        <a href="javaScript:;" class="btn btn-primary round">SELECT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

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
