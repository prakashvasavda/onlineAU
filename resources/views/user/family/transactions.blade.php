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
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-date">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $temp = 0; @endphp
                                        @if(isset($payments) && !empty($payments))
                                            @foreach($payments as $key => $value)
                                                @php 
                                                    $total = $temp; 
                                                    $total = $total + $value['price']; 
                                                    $temp  = $total; 
                                                @endphp
                                                <tr>
                                                    <td>{{ $value['name'] }}</td>
                                                    <td>{{ $value['price'] }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($value['created_at'])); }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr id="empty_row">
                                                <td class="text-center" colspan="3">No package available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total</td>
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
@endsection
@section('script')
<script type="text/javascript">
    
</script>
@endsection
