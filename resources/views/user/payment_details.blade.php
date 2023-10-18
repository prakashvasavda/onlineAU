@extends('layouts.main')

@section('content')
<div class="pricing-plans no-banner">
    <div class="container">
         
        <div class="title-main">
            <h2>Payment Details</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


       {{--  <div class="row">
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
        </div> --}}
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
