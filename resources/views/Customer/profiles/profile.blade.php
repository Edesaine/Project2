<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinite Knowledge | Profile Page</title>
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
@if (session('success'))
    @include('partials.flashMsgSuccess')
@endif
{{--alert edit fail--}}
@if (session('failed'))
    @include('partials.flashMsgFail')
@endif
<div class="container light-style flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-4">
         My Account
    </h4>
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            <div class="col-md-3 pt-0">
                <div class="list-group list-group-flush account-settings-links">
                    <a class="list-group-item list-group-item-action active" data-toggle="list"
                       href="#">General</a>
                    <a class="list-group-item list-group-item-action"
                       href="{{route('Customer.changePassword')}}">Change password</a>
                    <a class="list-group-item list-group-item-action"
                       href="{{route('Customer.carts.orderHistory')}}">Order History</a>
                    <a class="list-group-item list-group-item-action"
                       href="{{route('Customer.carts.cart')}}">My Cart</a>
                    <a class="list-group-item list-group-item-action"
                       href="{{route('Customer.account.logout')}}">Sign Out</a>
                    <a class="list-group-item list-group-item-action"
                       href="#account-notifications">Notifications</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="account-general">
                        <div class="card-body media align-items-center">
                         <div class="card-body">
    <form method="post" action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
        <img
            src="{{ $customer->image != "" ? asset('storage/customers/image/' . $customer->image) : asset('images/catmeme.jpg') }}"
            alt="Image"
            class="d-block ui-w-80">

        <div class="media-body ml-4">
            <label class="btn btn-outline-primary" for="image">
                Upload new avatar
                <input type="file" id="image" name="image" class="account-settings-fileinput" value="" />
            </label> &nbsp;&nbsp;
            <img id="preview-image" src="{{ asset('storage/customers/image/') }}" alt="Selected Image"
                 class="d-block ui-w-80 mt-3" >
        </div>

                         </div>
                        <hr class="border-light m-0">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label" for="name" >Username</label>
                                <input type="text" id="name" name="name" class="form-control mb-1" value="{{$customer->name}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{$customer->email}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="phone" >Phone Number</label>
                                <input type="number" id="phone" name="phone" class="form-control mb-1" value="{{$customer->phone}}" required/>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control" value="{{$customer->address}}">
                            </div>

                            <div class="form-group">
                                    <label for="gender" class="label">Gender: </label>
                                    <input type="radio" name="gender" value="0" id="gender" style="margin-left: 40px"
                                        {{$customer->gender == 1 ? 'checked': ''}}>Male
                                    <input type="radio" name="gender" value="1" id="gender" style="margin-left: 40px"
                                        {{$customer->gender == 0 ? 'checked': ''}}>Female
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                <button type="button" class="btn btn-danger" >
                    <a  href="{{route('home')}}">Home</a>
                </button>
            </div>
    </form>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript"></script>
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>

</body>

</html>
