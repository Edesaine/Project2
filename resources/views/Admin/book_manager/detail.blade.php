<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Detail a book</title>
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
<?php
$url='book'
?>
    <!-- MENU SIDEBAR-->
@include('admin.layouts.sidebar')
<!-- END MENU SIDEBAR-->

<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- HEADER DESKTOP-->
    @include('admin.layouts.header')


    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status')}}</div>
                @endif
                <a href="{{ url('book/index') }}" class="btn btn-primary float-end">Back</a>
                <h2 style="text-align: center"> Detail Book</h2>
                    <br>
                    <hr>
            <div class="row">

            <div style="background: whitesmoke" class="col-4 offset-1">
                <img src="{{ asset($book->image) }}" style="width: 330px;height:500px" alt="{{$book->name}}">
            </div>

                <div style="background: whitesmoke" class="col-6">
                    <span style="font-size: 25px"> Name :</span><span style="margin-left:10px;font-size: 25px;text-align: right">{{$book->name}}</span>
                    <br>

                    Price : <span style="margin-left:10px;text-align: right">{{$book->price}} $</span>
                    <br>

                    Quantity :@if($book->quantity==0)
                        <span style="margin-left:10px;text-align: right">Sold out</span>
                    @else
                        <span style="margin-left:10px;text-align: right">{{$book->quantity}}</span>
                    @endif
                    <br>
                    Status:  @if($book->status==0)
                        <span style="margin-left:10px;text-align: right">Available now</span>
                    @else
                        <span style="margin-left:10px;text-align: right">Unavailable</span>
                    @endif
                    <br>
                    Publisher:  <span style="margin-left:10px;text-align: right">{{$pub->name}}</span>
                    <br>
                    Author:   @foreach($authors as $author)
                        @if ($loop->first)
                            <span style="margin-left:10px;text-align: right">{{ $author->name }}@if (!$loop->last),@endif</span>
                        @else
                            <span style="text-align: right">{{ $author->name }}@if (!$loop->last),@endif.</span>
                        @endif
                    @endforeach
                    <br>
                    Category :  @foreach($categories as $category)
                        @if ($loop->first)
                            <span style="margin-left:10px;text-align: right">{{ $category->name }}@if (!$loop->last),@endif</span>
                        @else
                            <span style="text-align: right">{{ $category->name }}@if (!$loop->last),@endif.</span>
                        @endif
                    @endforeach
                    <br>
                    Description : <span style="margin-left:10px;text-align: right">{{$book->description}}</span>




                </div>


            </div>
                    <br>
                    <br>
                <a style="margin-left: 35%"  class="btn btn-primary" href="{{url('book/'.$book->id.'/additional-information')}}">
                    EDIT AUTHOR AND CATEGORY
                </a>
                <br>
                <br>
                <br>
                <br>

    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->




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
