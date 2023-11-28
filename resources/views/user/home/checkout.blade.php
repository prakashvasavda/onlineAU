@extends('layouts.main')
@section('content')
 <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        #total {
            font-weight: bold;
        }

        #paymentButton {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #paymentButton:hover {
            background-color: #45a049;
        }
    </style>
<div class="pricing-plans no-banner">
    <div class="container">

    <h2 class="mb-5">Checkout</h2>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @if(session()->has('cart') && !empty(session()->get('cart')))
                    @php $temp = 0; @endphp
                    @foreach(session()->get('cart') as $key => $value)
                        @php 
                            $total = $temp;
                            $total = $total + (int) $value['amount'];
                            $temp  = $total; 
                        @endphp
                        <tr>
                            <td>{{ $value['item_name'] }}</td>
                            <td>{{ $value['amount'] }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <p id="total">Total: ${{ $total }}</p>

        <a href="{{ route('') }}" class="btn btn mt-3" id="paymentButton" onclick="proceedToPayment()">Proceed to Payment</a>

    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function addToCart(package_name){
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('cart') }}",
            data: {
                    _token: "{{ csrf_token() }}",
                    package_name:package_name,
            },
            success: function (response) {
                $('#cart_quantity').text(response.cart_total);
            }
        });
    }
</script>
@endsection
