<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title Pagg-->
    <title>Oder Details</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Fontfaces CSS-->
    <link href="{{asset('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" media="all">

</head>
<body class="animsition">
<div class="page-wrapper">

    <!-- MENU SIDEBAR-->
    <?php
    $url='category'
    ?>

    @include('admin.layouts.sidebar')
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        @include('admin.layouts.header')
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <h1 style="text-align: center" class="col-4 offset-4">Order Details</h1>
                        <div class="col-3 offset-1" style="width: 100%;height: 120px">
                            @if($status->status==0)
                                <form enctype='multipart/form-data' action="{{ url('order/'.$id.'/details') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$id}}">
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label id="status" for="status">Status :
                                            <select name="status">
                                                <option selected value="0">
                                                    Pending
                                                </option>
                                                <option value="1">
                                                    Approved
                                                </option>
                                                <option value="2">
                                                    Delivering
                                                </option>
                                                <option value="3">
                                                    Completed
                                                </option>
                                                <option value="4">
                                                    Cancelled
                                                </option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary col-4 offset-3" style="height:40px">Save</button>
                                    </div>
                                </form>
                            @endif
                            @if($status->status==1)
                                <form enctype='multipart/form-data' action="{{ url('order/'.$id.'/details') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$id}}">
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label id="status" for="status">Status :
                                            <select name="status">
                                                <option selected value="1">
                                                    Approved
                                                </option>
                                                <option value="2">
                                                    Delivering
                                                </option>
                                                <option value="3">
                                                    Completed
                                                </option>
                                                <option value="4">
                                                    Cancelled
                                                </option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary col-4 offset-3" style="height:40px">Save</button>
                                    </div>
                                </form>
                            @endif
                                @if($status->status==2)
                                <form enctype='multipart/form-data' action="{{ url('order/'.$id.'/details') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$id}}">
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label id="status" for="status">Status :
                                            <select name="status">
                                                <option selected value="2">
                                                    Delivering
                                                </option>
                                                <option value="3">
                                                    Completed
                                                </option>
                                                <option value="4">
                                                    Cancelled
                                                </option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary col-4 offset-3" style="height:40px">Save</button>
                                    </div>
                                </form>
                            @endif
                                @if($status->status==3)
                                   <img style="width: 200px" src="{{asset('images/complete_stamp.png')}}">
                                @endif
                                @if($status->status==4)
                                    <img style="width: 180px" src="{{asset('images/cancelled_stamp.png')}}">
                                @endif
                        </div>
                    </div>
                    <a href="javascript:window.history.back();" class="btn btn-primary">Back</a>
                    <br>
                    <br>
                    <table  class="table table-light ">
                        <tr>
                            <th>Book Name</th>
                            <th>Image</th>
                            <th style="text-align: center">Quantity</th>
                            <th style="text-align: center">Sold Price</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td >{{$order->name}}</td>
                                <td>
                                    <div style="width: 100px"><img  src="{{ asset($order->image) }}" style="width: 60px;height:90px" alt=""></div>
                                </td>
                                <td style="text-align: center">{{$order->sold_quantity}}</td>
                                <td style="text-align: center">{{$order->sold_price}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <br>
                    <div style="display:flex;justify-content: center">
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Jquery JS-->
<script src="{{asset('vendor/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap JS-->
<script src="{{asset('vendor/bootstrap-4.1/popper.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
<!-- Vendor JS       -->
<script src="{{asset('vendor/slick/slick.min.js')}}">
</script>
<script src="{{asset('vendor/wow/wow.min.js')}}"></script>
<script src="{{asset('vendor/animsition/animsition.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
</script>
<script src="{{asset('vendor/counter-up/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('vendor/counter-up/jquery.counterup.min.js')}}">
</script>
<script src="{{asset('vendor/circle-progress/circle-progress.min.js')}}"></script>
<script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('vendor/chartjs/Chart.bundle.min.js')}}"></script>
<script src="{{asset('vendor/select2/select2.min.js')}}">
</script>

<!-- Main JS-->
<script src="{{asset('js/main.js')}}"></script>

</body>
</html>

