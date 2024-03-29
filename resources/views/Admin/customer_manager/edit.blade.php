<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add Author</title>
</head>
<body>
@if(session('status'))
    <div class="alert alert-success">{{session('status')}}</div>
@endif
<div class="row">
    <h3 class="col-2 offset-5" style="text-align:center ">EDIT CUSTOMER</h3>
    <a href="/author" class="col-1 offset-4 btn btn-primary">Back</a>
</div>
<form action="{{ url('customer/'.$customers->id.'/edit') }}" method="POST">
    @csrf
    @method('PUT')
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{$customers->name}}">
    @error('name')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <br>
    <label>Phone Number</label>
    <input type="text" name="phone" class="form-control" value="{{$customers->phone}}">
    @error('phone')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <br>
    <label for="gender">Gender:</label>
    <input type="radio" name="gender" value="1" style="margin-left: 40px"> Male
    <input type="radio" name="gender" value="0" style="margin-left: 40px"> Female <br>
    @error('gender')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <br>
    <label for="email">Email:</label>
    <input type="email" class="form-control" name="email" required>
    @error('gender')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <div style="justify-content: center" class="row">
        <button style="width: 100px"  class="btn btn-dark" type="submit">Update</button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
