<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet" media="all">
</head>

<body>
<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
    <div class="wrapper wrapper--w680">
        <div class="card card-4">
            <div class="card-body">
                <h2 class="title">Registration Form</h2>
                <form method="POST" action="{{route('Customer.account.registerProcess')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label for="name" class="label">Your name <label>
                                <input class="input--style-4" type="text" name="name" id="name"
                                       value="{{old('name')}}" required>
                                @if($errors->has('name'))
                                    {{ $errors->first('name')}}
                                @endif
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group">
                                <label for="email" class="label">Your email address</label>
                                <input class="input--style-4" type="email" name="email" id="email"
                                       value="{{old('email')}}" required>
                                @if($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row row-space">
                        <div class="col-2">
                                 <div class="input-group">
                                      <label for="phone" class="label">Your phone Number</label>
                                      <input class="input--style-4" type="number" name="phone" id="phone"
                                             value="{{old('phone')}}" required>
                                      @if($errors->has('phone'))
                                        {{ $errors->first('phone') }}
                                      @endif
                                 </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group">
                                <label for="address" class="label">Your address</label>
                                <input class="input--style-4" type="text" name="address" id="address"
                                       value="{{old('address')}}" required>
                                @if($errors->has('address'))
                                    {{ $errors->first('address') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row row-space">

                         <div class="col-2">
                             <div class="input-group">
                                <label for="password" class="label">Password</label>
                                <input class="input--style-4" type="text" name="password" id="password"
                                       value="{{old('password')}}" required>
                                @if($errors->has('password'))
                                    {{ $errors->first('password') }}
                                @endif
                             </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group">
                                <label for="password_2" class="label">Re-enter password</label>
                                <input class="input--style-4" type="text" name="password_2" id="password_2"
                                       value="{{old('password_2')}}" required>
                                @if($errors->has('password_2'))
                                    {{ $errors->first('password_2') }}
                                @endif
                            </div>
                        </div>
                    </div>

                        <div class="col-2">
                            <div class="input-group" >
                                <label for="gender" class="label">Choose</label>
                                <input type="radio" name="gender" value="0" id="gender" style="margin-left: 40px">Male
                                <input type="radio" name="gender" value="1" id="gender" style="margin-left: 40px">Female
                            </div>
                        </div>

                    <input class="hidden invisible opacity-0" type="hidden"
                           name="account_status" value="1" readonly>

                    <div class="p-t-15">
                        <button class="btn btn--radius-2 btn--blue" type="submit">Sign Up</button>
                    </div>

                    <p class="text-center">You have an account ?
                        <a data-toggle="tab" href="{{route('Customer.account.login')}}">Login now!</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Jquery JS-->
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
