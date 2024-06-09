<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="path/to/your/custom.css">
</head>

<body class="bg-light">
@if (session('success'))
    @include('partials.flashMsgSuccess')
@endif
{{--alert edit fail--}}
@if (session('failed'))
    @include('partials.flashMsgFail')
@endif
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6" style="flex: 0 0 60%; max-width: 60%">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{asset('images/logo.png')}}" alt="logo" class="img-fluid mb-4">
                    <h1 class="font-weight-bold text-danger mb-4">You Have Been Logged Out</h1>
                    <p class="mb-4">Thank you for using our website. Please <a
                            href="{{ route('Customer.account.login') }}">click here</a> to login back to our site.
                    </p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-dark">Home</a>
            </div>
        </div>
    </div>
</div>
</body>

</html>
