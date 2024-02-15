@extends('layouts.main')
@section('content')
<div class="cart-checkout-main pricing-plans no-banner">
    <div class="container">
        <div class="row">
            <div class="cart-tables-collaterals">
                <div class="cart-table-sec-main">
                    <div class="w-100">
                        <div class="table-responsive">
                            <table class="shop_table">
                                <thead>
                                    <tr>
                                        <th class="product-remove"></th>
                                        <th class="product-name">Package Name</th>
                                        <th class="product-name">Cancelable</th>
                                        <th class="product-name">Cancellation Request Status</th>
                                        <th class="product-date">Created Date</th>
                                        <th class="product-date">Expire Date</th>
                                        <th class="product-price">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $temp = 0; @endphp
                                    @if(isset($subscriptions) && !empty($subscriptions))
                                        @foreach($subscriptions as $key => $value)
                                            @php 
                                                $total = $temp; 
                                                $total = $total + $value['price'] ?? 0; 
                                                $temp  = $total; 
                                            @endphp
                                            <tr id="row_{{ $value['id'] }}">
                                                <td class="product-remove">
                                                    <a href="JavaScript:;" class="remove" onclick="RequestCancellation({{ $value['id'] }}, {{ $value['cancellation_allowed'] }})">×</a>                        
                                                </td>
                                                <td>{{ $value['name'] ?? null }}</td>
                                                <td>
                                                    @if($value['cancellation_allowed'] == 1)
                                                       <span class="badge bg-light text-dark">Applicable</span>
                                                    @else
                                                        <span class="badge bg-dark">Not Applicable</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value['cancellation_request_status'] == 1 && $value['cancellation_approval_status'] == 0)
                                                        <span class="badge bg-danger">Pending</span>
                                                    @elseif($value['cancellation_request_status'] == 1 && $value['cancellation_approval_status'] == 1)
                                                        <span class="badge bg-success">Approved</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($value['created_at'] ?? null)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value['end_date'] ?? null)) }}</td>
                                                <td>{{ $value['price'] ?? null }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="empty_row">
                                            <td class="text-center" colspan="4">No package available</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">Total</td>
                                        <td><span class="amount total_amount"><bdi><span class="currencySymbol">R</span>{{ isset($total) ? number_format($total, 2, '.', '') : '0.00' }}</bdi></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include ('user.includes.modal')
@endsection
@section('script')
<script type="text/javascript">
    function RequestCancellation(id, cancellationAllowed){
        /*incase it is not applicable for  cancellation*/
        if(!cancellationAllowed || cancellationAllowed == 0){
            var modalLabel    = "Warning";
            var modalIcon     = "<img src='{{ url('front/images/warning-icon1.png') }}' alt=''>"; 
            var message       = "Subscription cancellation is not available for this package. If you have any queries, please contact the administrator";
            var url           = "{{ route('contact-us') }}";
            var btnText       = "Contact Us" 
            setTimeout(function () {
                showModal(modalLabel, modalIcon, message, url, btnText);
            }, 500); // 5 milseconds delay
            return false;
        }

        var modalLabel    = "Warning";
        var modalIcon     = "<img src='{{ url('front/images/question-icon1.png') }}' alt=''>"; 
        var message       = "Are you sure you want to proceed with canceling your subscription for this package?";
        var url           = "#";
        var btnText       = "Yes" 
        setTimeout(function () {
            showModal(modalLabel, modalIcon, message, url, btnText);
        }, 500); // 5 milseconds delay



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

    /*show modal pop up*/
    function showModal(modalLabel, modalIcon, message, url, btnText){
        $("#alert-modal-label").html(modalLabel);
        $("#alert-modal-icon").html(modalIcon);
        $("#alert-modal-body").html(message);
        $("#alert-modal-action-btn").attr('href', url).text(btnText);
        $('#alert-modal').modal('show');
    }

    $('#alert-modal-action-btn:contains("Yes")').on('click', function(){
        event.preventDefault();
        alert("true");
    });

</script>
@endsection
