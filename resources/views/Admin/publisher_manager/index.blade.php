<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Publisher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<h1 style="text-align: center">Publisher</h1>
<a href="{{url('publisher/create')}}" class="btn btn-outline-dark">Add Publisher</a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <td></td>
    </tr>
    @foreach($publishers as $publisher)
    <tr>

            <td>{{$publisher->id}}</td>
            <td>{{$publisher->name}}</td>
            <td>
                <a href="{{url('publisher/'.$publisher->id.'/edit')}}" class="btn btn-primary">Edit</a>
                <a href="{{url('publisher/'.$publisher->id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Delete</a>
            </td>

    </tr>
    @endforeach

</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

