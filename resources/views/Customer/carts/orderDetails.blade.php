<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Order Details Table with Search Filter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    <style type="text/css">
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }
        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            margin: 30px auto;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-wrapper .btn {
            float: right;
            color: #333;
            background-color: #fff;
            border-radius: 3px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }
        .table-wrapper .btn:hover {
            color: #333;
            background: #f2f2f2;
        }
        .table-wrapper .btn.btn-primary {
            color: #fff;
            background: #03A9F4;
        }
        .table-wrapper .btn.btn-primary:hover {
            background: #03a3e7;
        }
        .table-wrapper .btn.btn-outline-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;

        }
        .table-wrapper .btn.btn-outline-danger:hover {
            color: #dc3545;
            background: #fff;
            border-color: #DE452D;
        }
        .table-title .btn {
            font-size: 13px;
            border: none;
        }
        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }
        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }
        .table-title {
            color: #fff;
            background: #4b5366;
            padding: 16px 25px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        .show-entries select.form-control {
            width: 60px;
            margin: 0 5px;
        }
        .table-filter .filter-group {
            float: right;
            margin-left: 15px;
        }
        .table-filter input, .table-filter select {
            height: 34px;
            border-radius: 3px;
            border-color: #ddd;
            box-shadow: none;
        }
        .table-filter {
            padding: 5px 0 15px;
            border-bottom: 1px solid #e9e9e9;
            margin-bottom: 5px;
        }
        .table-filter .btn {
            height: 34px;
        }
        .table-filter label {
            font-weight: normal;
            margin-left: 10px;
        }
        .table-filter select, .table-filter input {
            display: inline-block;
            margin-left: 5px;
        }
        .table-filter input {
            width: 200px;
            display: inline-block;
        }
        .filter-group select.form-control {
            width: 110px;
        }
        .filter-icon {
            float: right;
            margin-top: 7px;
        }
        .filter-icon i {
            font-size: 18px;
            opacity: 0.7;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }
        table.table tr th:first-child {
            width: 60px;
        }
        table.table tr th:last-child {
            width: 80px;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
        }
        table.table td a:hover {
            color: #2196F3;
        }
        table.table td a.view {
            width: 30px;
            height: 30px;
            color: #2196F3;
            border: 2px solid;
            border-radius: 30px;
            text-align: center;
        }
        table.table td a.view i {
            font-size: 22px;
            margin: 2px 0 0 1px;
        }
        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }
        .status {
            font-size: 30px;
            margin: 2px 2px 0 0;
            display: inline-block;
            vertical-align: middle;
            line-height: 10px;
        }
        .text-success {
            color: #10c469;
        }
        .text-info {
            color: #62c9e8;
        }
        .text-warning {
            color: #FFC107;
        }
        .text-danger {
            color: #ff5b5b;
        }
        .pagination {
            float: right;
            margin: 0 0 5px;
        }
        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }
        .pagination li a:hover {
            color: #666;
        }
        .pagination li.active a {
            background: #03A9F4;
        }
        .pagination li.active a:hover {
            background: #0397d6;
        }
        .pagination li.disabled i {
            color: #ccc;
        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
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

<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Order#{{$order->id}} <b>Details</b></h2>
                </div>

            </div>
        </div>
        <div class="table-filter">
            <div class="row">
                <div class="col-sm-9">
                    <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    <div class="filter-group">
                        <label>Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="filter-group">
                        {{--<label>Location</label>
                        <select class="form-control">
                            <option>All</option>
                            <option>Berlin</option>
                            <option>London</option>
                            <option>Madrid</option>
                            <option>New York</option>
                            <option>Paris</option>
                        </select>--}}
                    </div>
                    <div class="filter-group">
                        <label>Status</label>
                        <select class="form-control">
                            <option>Any</option>
                            <option>Delivered</option>
                            <option>Shipped</option>
                            <option>Pending</option>
                            <option>Cancelled</option>
                        </select>
                    </div>
                    <span class="filter-icon"><i class="fa fa-filter"></i></span>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Order date</th>
                <th>Receiver name</th>
                <th>Receiver address</th>
                <th>Receiver phone</th>
                <th>Status</th>
                <th>Total books</th>
                <th>Amount</th>
                <th>Shipping method</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$order->date_buy}}</td>
                <td>{{$order->receiver_name}}</td>
                <td>{{$order->receiver_address}}</td>
                <td>{{$order->receiver_phone}}</td>
                <td>
                    @switch($order->status)
                        @case(0)
                            <span style="color: #e67e22;font-weight: bold">Pending</span>
                            @break
                        @case(1)
                            <span style="font-size: 18px" class="status text-danger">Cancelled</span>
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
                <td>{{$order_item}}</td>
                <td>{{$order_amount}}</td>
                <td>{{ $order->payment->name }}</td>

                <td>
                    @if (!in_array($order->status, [1, 2, 3, 4]))
                        <form action="{{ route('Customer.carts.cancelOrder', $order->id) }}" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button type="submit" style="font-size: 14px" class="btn btn-outline-danger">Cancel order</button>
                        </form>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
        <div class="w-50 border rounded p-3 overflow-y-auto" style="width: 1500px;height: 350px">
            @foreach($order_details as $detail)
                <div class="d-flex mb-3 ">
                    <div class="border rounded p-3 object-fit-fill
                             overflow-hidden w-25 me-3">
                        <img src="{{asset($detail->image)}}" width="80px"
                             height="110px">
                    </div>
                    <div class="flex-fill d-flex flex-column justify-content-between">
                        <div>
                            {{$detail->name}}
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                ${{$detail->sold_price}}
                            </div>
                            <div>
                                x {{$detail->sold_quantity}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex w-100 justify-content-between align-items-center">
        <a href="{{route('Customer.carts.orderHistory')}}" class="btn btn-primary">
            Back
        </a>


        <div class="clearfix">
            <ul class="pagination">
                <li class="page-item disabled"><a href="#">Previous</a></li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item active"><a href="#" class="page-link">4</a></li>
                <li class="page-item"><a href="#" class="page-link">5</a></li>
                <li class="page-item"><a href="#" class="page-link">6</a></li>
                <li class="page-item"><a href="#" class="page-link">7</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
            </ul>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">
                        Are you sure?
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You won't be able to revert this!
                </div>
               {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <a href="{{route('Customer.carts.cancelOrder', $order)}}" class="btn btn-danger">Cancel</a>
                </div>--}}
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><style>

</style>
</body>
</html>
