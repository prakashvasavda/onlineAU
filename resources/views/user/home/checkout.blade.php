@extends('layouts.main')
@section('content')
    <div class="cart-checkout-main pricing-plans no-banner">
        <div class="container">
            <div class="row">
                <div class="cart-tables-collaterals">
                    <div class="cart-table-sec-main">
                        <div class="w-100">
                            <div class="table-responsive">
                                <table class="shop_table" id="packageTable">
                                    <thead>
                                        <tr>
                                            <th class="product-remove"></th>
                                            <th class="product-name">Package</th>
                                            <th class="product-price">Price</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(session()->has('cart') && !empty(session()->get('cart')))
                                            @php $temp = 0; @endphp
                                            @foreach(session()->get('cart') as $key => $value)
                                                @php 
                                                    $total = $temp; 
                                                    $total = $total + $value['price']; 
                                                    $temp  = $total; 
                                                @endphp
                                                <tr id="row_{{ $value['id'] }}">
                                                    <td class="product-remove">
                                                        <a href="JavaScript:;" class="remove" onclick="removeItemFromCart({{$value['id']}})">×</a>                        
                                                    </td>
                                                    <td class="product-name" data-title="Product">
                                                        <a href="JavaScript:;">{{ strtoupper($value['item_name']) }}</a>
                                                    </td>
                                                    <td class="product-price" data-title="Price">
                                                        <span class="amount"><bdi><span class="currencySymbol">R</span>{{ $value['price'] }}</bdi></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr id="empty_row">
                                                <td class="text-center" colspan="3">No Item in the cart</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    <tfoot class="{{ session()->has('cart') && !empty(session()->get('cart')) ? '' : 'd-none' }}">
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td><span class="amount total_amount"><bdi><span class="currencySymbol">R</span>{{ isset($total) ? number_format($total, 2, '.', '') : '0.00' }}</bdi></span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="cart-collaterals-sec-main" style="height: 50%;">
                        <div class="cart_totals">
                            <div class="title-main">
                                <h3>Cart totals</h3>
                            </div>
                            <table class="shop_table shop_table_responsive">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td data-title="Subtotal"><span class="amount total_amount"><bdi><span class="currencySymbol">R</span>{{ isset($total) ? number_format($total, 2, '.', '') : '0.00' }}</bdi></span></td>
                                    </tr>
                                    <tr class="shipping-totals shipping">
                                        <th>Service Fee</th>
                                        <td data-title="Shipping">
                                            <p>Free</p>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td data-title="Total"><strong><span class="amount total_amount"><bdi><span class="currencySymbol">R</span>{{ isset($total) ? number_format($total, 2, '.', '') : '0.00' }}</bdi></span></strong> </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="proceed-to-checkout">
                                @if(session()->has('cart') && !empty(session()->get('cart')))
                                    <a href="{{ route('payment-process') }}" class="btn btn-primary round checkout-button">Proceed to checkout</a>
                                @else
                                    <a href="{{ route('packages') }}" class="btn btn-primary round checkout-button">Proceed to checkout</a>  
                                @endif
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
    function removeItemFromCart(id){
        event.preventDefault();
        $.ajax({
            url: "{{url('cart')}}/"+id,
            type: "DELETE",
            data: {_token: '{{csrf_token()}}', id:id},
            success: function(response){
                if(response.status === 200){
                    if(response.total_price <= 0){
                        $('#packageTable:has(tfoot):last tfoot').css({'display': 'none'});
                        $('#packageTable').append(
                            `<tr id="empty_row">
                                <td class="text-center" colspan="3">No Item in the cart</td>
                            </tr>`
                        );
                    }
                    $('.counterNumber').text(response.total_items);
                    $('.total_amount').text('R'+response.total_price);
                    $('#row_'+ response.id).remove();
                }
            }
        });
    }
</script>
@endsection
