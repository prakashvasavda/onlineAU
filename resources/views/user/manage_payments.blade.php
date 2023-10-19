@extends('layouts.main')
@section('content')

@if(isset($payment) && !empty($payment))
    <div class="single-form-section">
        <div class="container">
            <div class="title-main mb-5">
                <h2>Payments</h2>
            </div>
            <div class="row justify-content-center">
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
                        <p class="text-center"><a href="#">Manage subscription</a></p>
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
    <div class="pricing-plans no-banner">
        <div class="container">
            <div class="title-main">
                <h2>Pricing</h2>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12"></div>
                @if(isset($packages))
                    @foreach($packages as $key=>$price)
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <form method="POST" class="row" action="{{ route('payment-process') }}" id="pricing-form-{{$key}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $price['price'] }}">
                                <input type="hidden" name="item_name" value="{{ $price['name'] }}">
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
    </div>
@endif

@endsection
@section('script')
    <script type="text/javascript">
    </script>
@endsection
