<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Management</title>
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
@if (session('success'))
    @include('partials.flashMsgSuccess')
@endif
{{--alert edit fail--}}
@if (session('failed'))
    @include('partials.flashMsgFail')
@endif
<body class="animsition">

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="margin-top: 5% ">
            <div class="modal-header">
                <h4 class="modal-title">New Customer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form enctype='multipart/form-data' action="{{ url('customer/index') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Customer Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="file">Choose Image:</label>
                        <input name="image" type="file" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <input type="radio" name="gender" value="1" style="margin-left: 40px"> Male
                        <input type="radio" name="gender" value="0" style="margin-left: 40px"> Female <br>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>

                    <input class="hidden invisible opacity-0" type="hidden"
                           name="account_status" value="1" readonly>

                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn btn-secondary" style="height:40px">ADD</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal" style="height:40px">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="page-wrapper">
    <?php
    $url = 'customer';
    ?>
    <!-- MENU SIDEBAR-->
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
                    <button type="button" class="btn btn-secondary "  data-toggle="modal" data-target="#myModal">
                        ADD A CUSTOMER
                    </button>
                    <BR>
                    <BR>

    <table cellpadding="2px" style="" class="table table-bordered table-striped">
        <tr style="height: 10px">
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($customer as $cus)
            <tr>

                <td>{{$cus->id}}</td>
                <td>{{$cus->name}}</td>
                <td>
                @if($cus->image)
                    <img src="{{ asset('storage/customers/image/' . $cus->image) }}" alt="Customer Image" style="width: 100px; height: auto;">
                @else
                    <img src="{{ asset('images/catmeme.jpg') }}" alt="Default Image" style="width: 100px; height: auto;">
                @endif
                </td>
                <td>{{$cus->email}}</td>
                <td>
                    <div style="width:100px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap; ">{{$cus->password}}</div>
                </td>
                <td>{{$cus->phone}}</td>
                <td>
                    @if($cus->gender==1)
                        Male
                    @endif
                    @if($cus->gender==0)
                        Female
                    @endif
                   </td>
                <td>{{$cus->address}}</td>

                <td>
                    @if($cus->account_status==1)
                        <span style="color: #00b26f;font-weight: bold">Active</span>
                    @endif
                    @if($cus->account_status==0)
                        <span style="color: #dc3545;font-weight: bold"> Locked</span>
                    @endif
                </td>

                <td>
                    <a href="{{url('customer/'.$cus->id.'/changestatus')}}" class="btn btn-secondary"
                       style="margin-top: 10px" onclick="return confirm('Are you sure ?')">Change Status</a>
                    <a href="{{url('customer/'.$cus->id.'/edit')}}"  style="margin-top: 10px" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
                    <div style="display:flex;justify-content: center">
                        {{$customer->links()}}
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
