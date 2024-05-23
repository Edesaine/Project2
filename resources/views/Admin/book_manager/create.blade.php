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
    <title>Add a book</title>
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
                <h2 style="text-align: center"> Add Book</h2>
            </div>
            <form  class="col-8 offset-2" enctype='multipart/form-data' action="{{ url('book/create') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" >Book Name : </label>
                    <input id="name" type="text" name="name" class="form-control" value="" required>
                </div>

                <div class="form-group">
                    <label for="price" >Price :</label>
                    <input id="price" type="number" step="any" name="price" class="form-control"  required>
                </div>

                <div class="form-group">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity :</label>
                    <input id="quantity" type="number" name="quantity" class="form-control" value="" required>
                </div>

                <div class="form-group">
                    <label for="NumberOfPages" >Number of pages :</label>
                    <input id="NumberOfPages" type="number" name="NumberOfPages" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea  name="description" id="description" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="file">Choose Image:</label>
                    <input type="file" class="form-control-file" name="image">
                </div>

                <div class="form-group">
                    <label>Publisher :</label>
                    <select name="publisher_id">
                        <option disabled selected> - Choose - </option>
                        @foreach($publishers as $publisher)
                            <option value="<?= $publisher['id'] ?>">
                                    <?= $publisher['name'] ?>
                            </option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="NumberOfAuthors" class="block text-sm font-medium text-gray-700">Number of author</label>
                    <input min="1" id="NumberOfAuthors" type="number" name="NumberOfAuthors" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for="NumberOfCategories" class="block text-sm font-medium text-gray-700">Number of categories</label>
                    <input min="1" id="NumberOfCategories" type="number" name="NumberOfCategories" class="form-control" value="" required>
                </div>
                <br>
                <div class="form-group">
                    <button  type="submit" class="btn btn-outline-primary col-2 offset-5" style="height:40px">Add Item</button>
                </div>
                <br>
            </form>
        </div>
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
