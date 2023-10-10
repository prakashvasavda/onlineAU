@extends('layouts.main')

@section('content')
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

@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
