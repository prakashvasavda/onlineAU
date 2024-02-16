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
                                                    @if($value['cancellation_allowed'] === 1 && $value['cancellation_request_status'] === 0 && !in_array($value['cancellation_approval_status'], [0,1], true))
                                                        <a href="JavaScript:;" class="remove" onclick="RequestCancellation({{ $value['id'] }}, {{ $value['cancellation_allowed'] }})">×</a>
                                                    @else
                                                        <a href="JavaScript:;" class="remove" onclick="invalidAction()">×</a>                        
                                                    @endif  
                                                </td>
                                                <td>{{ $value['name'] ?? null }}</td>
                                                <td>
                                                    @if($value['cancellation_allowed'] === 1)
                                                       <span class="badge bg-light text-dark">Applicable</span>
                                                    @else
                                                        <span class="badge bg-dark">Not Applicable</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value['cancellation_request_status'] === 1 && $value['cancellation_approval_status'] === 0)
                                                        <span class="badge bg-danger">Denied</span>
                                                    @elseif($value['cancellation_request_status'] == 1 && $value['cancellation_approval_status'] === 1)
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif($value['cancellation_request_status'] == 1 && $value['cancellation_approval_status'] === null)
                                                        <span class="badge bg-warning">pending</span>
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
    function invalidAction(){
        setTimeout(function () {
            showModal("Warning", "<img src='{{ url('front/images/warning-icon1.png') }}' alt=''>", "Subscription cancellation for this package is currently not permitted. Please reach out to the administrator for any concern.", "{{ route('contact-us') }}", "Contact Us");
        }, 500); // 5 milseconds delay
        return false;
    }

    function RequestCancellation(id, cancellationAllowed){
        if(!cancellationAllowed || cancellationAllowed == 0){
            return false;
        }

        setTimeout(function () {
            showModal("Warning", "<img src='{{ url('front/images/question-icon1.png') }}' alt=''>", "Are you sure you want to proceed with canceling your subscription for this package?", "#", "Yes", id);
        }, 500); // 5 milseconds delay
    }

    /*send request to the admin*/
    $(document).on('click', '#alert-modal-action-btn:contains("Yes")', function(event){
        event.preventDefault();
        $('#alert-modal').modal('hide');

        $.ajax({
            type: "POST",
            url: "{{ route('request-cancellation') }}",
            data: {
                id: $(this).data("id"),
                _token: "{{ csrf_token() }}",
                user_id: "{{ session()->get('frontUser')->id ?? null }}",
            },
            success: function (response) {
                if(response.status == 200){
                    // window.location.reload();
                    setTimeout(function () {
                        showModal("Success!", "<img src='{{ url('front/images/success-check-icon1.png') }}' alt=''>", "Your request has been submitted to the administrator. Kindly await approval. If you have any further inquiries, please feel free to contact us.", "{{ route('contact-us') }}", "Contact Us");
                    }, 500); // 5 milseconds delay
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    });

    /*show modal pop up*/
    function showModal(modalLabel, modalIcon, message, url, btnText, id=null){
        $("#alert-modal-label").html(modalLabel);
        $("#alert-modal-icon").html(modalIcon);
        $("#alert-modal-body").html(message);
        $("#alert-modal-action-btn").attr('href', url).attr("data-id", id).text(btnText);
        $('#alert-modal').modal('show');
    }

</script>
@endsection
