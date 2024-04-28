<!doctype html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<style>
    body{margin-top:20px;
        background-color:#f2f6fc;
        color:#69707a;
    }
    .img-account-profile {
        height: 10rem;
    }
    .rounded-circle {
        border-radius: 50% !important;
    }
    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
    }
    .card .card-header {
        font-weight: 500;
    }
    .card-header:first-child {
        border-radius: 0.35rem 0.35rem 0 0;
    }
    .card-header {
        padding: 1rem 1.35rem;
        margin-bottom: 0;
        background-color: rgba(33, 40, 50, 0.03);
        border-bottom: 1px solid rgba(33, 40, 50, 0.125);
    }
    .form-control, .dataTable-input {
        display: block;
        width: 100%;
        padding: 0.875rem 1.125rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1;
        color: #69707a;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #c5ccd6;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.35rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .nav-borders .nav-link.active {
        color: #0061f2;
        border-bottom-color: #0061f2;
    }
    .nav-borders .nav-link {
        color: #69707a;
        border-bottom-width: 0.125rem;
        border-bottom-style: solid;
        border-bottom-color: transparent;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 0;
        padding-right: 0;
        margin-left: 1rem;
        margin-right: 1rem;
    }
</style>
    @include('Customer/Layout/user_menu')
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{route('home')}}" target="__blank">Home</a>
            <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-billing-page" target="__blank">Billing</a>
            <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page" target="__blank">Security</a>
            <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"  target="__blank">Notifications</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2" src="{{asset('images/catmeme.jpg')}}" alt="">
                    </div>

                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Customer name</label>
                                <input class="form-control" id="name" name="name" type="text" placeholder="Enter your username"
                                       value="{{$customer->name}}">
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email address</label>
                                <input class="form-control" id="email" type="email" placeholder="Enter your email address"
                                       name="email" value="{{$customer->email}}">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="phone">Phone number</label>
                                    <input class="form-control" id="phone" type="number" name="phone"
                                           placeholder="Enter your phone number" value="{{$customer->phone}}">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <div class="input-group" >
                                        <label for="gender" class="label">Choose</label>
                                        <input type="radio" name="gender" value="0" id="gender" style="margin-left: 40px"
                                               {{$customer->gender == 1 ? 'checked': ''}}>Male
                                        <input type="radio" name="gender" value="1" id="gender" style="margin-left: 40px"
                                               {{$customer->gender == 0 ? 'checked': ''}}>Female
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="address">Your address</label>
                                <input class="form-control" id="address" type="address" placeholder="Enter your email address"
                                       name="address" value="{{$customer->address}}">
                            </div>

                            <button class="btn btn-primary" type="submit">Save changes</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
