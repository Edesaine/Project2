<!doctype html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
</head>
<style>
</style>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">LOGIN</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="wrap">
                    <div class="img" style="background-image: url({{asset('images/bg-1.jpg')}});"></div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">SIGN IN</h3>
                            </div>
                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-facebook"></span></a>
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-twitter"></span></a>
                                </p>
                            </div>
                        </div>
                        <form method="post" action="{{route('Customer.account.loginProcess')}}" class="signin-form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-3">
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                                <label class="form-control-placeholder" for="email">Your email</label>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" required>
                                <label class="form-control-placeholder" for="password">Your password</label>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                            </div>

                            <div class="form-group d-md-flex">
                                <div class="w-50 text-left">
                                    <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#">Forgot Password</a>
                                </div>
                            </div>

                             <p class="text-center">Not a member?
                                 <a data-toggle="tab" href="{{route('Customer.account.register')}}">Sign Up</a>
                             </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/popper.js')}}"></script>
<script src="{{asset('frontend/js/popper.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>

</body>
</html>

