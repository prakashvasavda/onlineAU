@extends('layouts.main')
@section('content')
<style>
        .cart-tables-collaterals {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            row-gap: 30px;
        }
        .cart-table-sec-main {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            padding-right: 0;
        }
        .cart-collaterals-sec-main {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            padding-left: 0;
        }
        .cart-table-sec-main table {
            width: 100%;
            border: 1px solid var(--light-gray);
            border-radius: 3px;
        }
        .cart-table-sec-main table tr, .cart_totals table tr {
            font-size: 14px;
            line-height: 18px;
            font-family: var(--montserrat-font);
            font-weight: 500;
            color: var(--gray-text);
            text-transform: initial;
        }
        .cart-table-sec-main table tr th, .cart-table-sec-main table tr td {
            padding: 9px 12px;
            vertical-align: top;
            border: 1px solid var(--light-gray);
        }
        .cart-table-sec-main table tr a {
            color: var(--primary);
        }
        .cart-table-sec-main table tr a.remove {
            width: 25px;
            height: 25px;
            line-height: 25px;
            font-size: 25px;
            display: block;
            margin: 0 auto;
            text-align: center;
            background-color: var(--primary);
            color: var(--white);
            border-radius: 100%;
        }
        .cart-table-sec-main table tfoot td:first-child {
            text-align: right;
            font-weight: 700;
        }
        .cart-table-sec-main table tfoot td .amount {
            color: var(--primary);
            font-weight: 800;
        }
        .cart_totals {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            flex-flow: column;
            background-color: var(--light-gray);
            padding: 30px 0px;
        }
        .cart_totals .title-main {
            margin-bottom: 22px;
        }
        .cart_totals table {
            width: 100%;
        }
        .cart_totals table tbody tr {
            border-bottom: 1px solid var(--white);
        }
        .cart_totals table tbody tr:last-child {
            border-color: transparent;
        }
        .cart_totals table tr th, .cart_totals table tr td {
            width: 50%;
            padding: 9px 12px;
            vertical-align: middle;
        }
        .cart_totals .proceed-to-checkout {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 14px;
        }
        @media screen and (max-width:991px) {
            .cart-table-sec-main {
                width: 100%;
                padding-right: 0px;
            }
            .cart-collaterals-sec-main {
                width: 100%;
                padding-left: 0px;
            }
        }
        .badge {
            background-color: rgb(143,94,71);
            color: white;
            padding: 4px 8px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
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
                                                       <span class="badge">Applicable</span>
                                                    @else
                                                        <span class="badge">Not Applicable</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value['cancellation_request_status'] === 1 && $value['cancellation_approval_status'] === 0)
                                                        <span class="badge">Denied</span>
                                                    @elseif($value['cancellation_request_status'] == 1 && $value['cancellation_approval_status'] === 1)
                                                        <span class="badge">Approved</span>
                                                    @elseif($value['cancellation_request_status'] == 1 && $value['cancellation_approval_status'] === null)
                                                        <span class="badge">pending</span>
                                                    @else
                                                        <span class="badge">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($value['created_at'] ?? null)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value['end_date'] ?? null)) }}</td>
                                                <td>{{ $value['price'] ?? null }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="empty_row">
                                            <td class="text-center" colspan="7">No transactions available</td>
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
