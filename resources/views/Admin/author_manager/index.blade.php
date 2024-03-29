<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Author</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<h1 style="text-align: center">Author</h1>
<a href="{{url('author/create')}}" class="btn btn-outline-dark">Add Author</a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Country</th>
        <td></td>
    </tr>
    @foreach($authors as $author)
    <tr>

            <td>{{$author->id}}</td>
            <td>{{$author->name}}</td>
            <td>{{$author->country}}</td>
            <td>
                <a href="{{url('author/'.$author->id.'/edit')}}" class="btn btn-primary">Edit</a>
                <a href="{{url('author/'.$author->id.'/delete')}}" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Delete</a>
            </td>

    </tr>
    @endforeach
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

