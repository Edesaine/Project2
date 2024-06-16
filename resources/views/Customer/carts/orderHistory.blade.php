<!doctype html>
<html lang="en">
<head>
    <title>Order History</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
@if (session('success'))
    @include('partials.flashMsgSuccessCenter')
@endif
{{--alert edit fail--}}
@if (session('failed'))
    @include('partials.flashMsgFailCenter')
@endif

@include('Customer/Layout/user_menu')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Your order history</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order date</th>
                            <th>Payment method</th>
                            <th>Total price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $ord)
                            <tr>
                            <th scope="row">{{$ord->id}}</th>
                            <td>
                                @php
                                    $day = substr($ord->date_buy, 8, 2);
                                    $month = substr($ord->date_buy, 5, 2);
                                    $year = substr($ord->date_buy, 0, 4);
                                    $orderDate = $month . ' / ' . $day . ' / ' . $year;
                                @endphp
                                {{$orderDate}}
                            </td>
                            <td>{{ $ord->payment->name }}</td>
                            <td>${{$ord->amount}}</td>
                            <td>
                                @switch($ord->status)
                                    @case(0)
                                        <span style="color: #e67e22;font-weight: bold">Pending</span>
                                        @break
                                    @case(1)
                                        <span style="color: #f1c40f;font-weight: bold">Approved</span>
                                        @break
                                    @case(2)
                                        <span style="color: #3498db;font-weight: bold">Delivering</span>
                                        @break
                                    @case(3)
                                        <span style="color: #2ecc71;font-weight: bold">Completed</span>
                                        @break
                                    @case(4)
                                        <span style="color: #e74c3c;font-weight: bold">Cancelled</span>
                                        @break
                                @endswitch
                            </td>

                            <td>
                                <a href="{{route('Customer.carts.orderDetails', $ord)}}" class="btn btn-primary">
                                    View order details
                                </a>
                                <br>
                                @if($ord->payment_id == 2)
                                    <a href="{{route('Customer.discharge')}}" class="btn btn-secondary" style="margin-top: 10px">
                                        Pay for your order
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

</body>
</html>

