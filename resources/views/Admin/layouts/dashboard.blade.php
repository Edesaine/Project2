<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Title Page-->
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Fontfaces CSS-->
    <link href="{{asset('php css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="../../../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../../../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../../../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../../../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../../../vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../../../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../../../vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../../../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../../../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../../css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
<div class="page-wrapper">

    <!-- MENU SIDEBAR-->
    <?php
    $url='dashboard'
    ?>
    @include('admin.layouts.sidebar')
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
@include('admin.layouts.header')

        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">overview</h2>

                            </div>
                        </div>
                    </div>
                    <div class="row m-t-25">
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c1">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-account-o"></i>
                                        </div>
                                        <div class="text">
                                            <h2 id="customersCount">{{ $stats->customersCount }}</h2>
                                            <span>members online</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c2">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-shopping-cart"></i>
                                        </div>
                                        <div class="text">
                                            <h2 id="soldProductsCount">{{ $stats->soldProductsCount }}</h2>
                                            <span>Books Sold</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c3">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-calendar-note"></i>
                                        </div>
                                        <div class="text">
                                            <h2 id="ordersCount">{{ $stats->ordersCount }}</h2>
                                            <span>Orders this week</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="overview-item overview-item--c4" >
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-money"></i>
                                        </div>
                                        <div class="text">
                                            <h2 id="revenue">${{ number_format($stats->revenue, 2) }}</h2>
                                            <span>Total revenue</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="au-card recent-report">
                        <h3 class="title-2">Top 5 Bestselling Books</h3>
                        <br>
                    @foreach($topBooks as $book)
                            <div class="d-flex mb-3 ">
                                <div class="border rounded p-3 object-fit-fill
                             overflow-hidden w-10 me-1">
                                    <img src="{{ $book->image }}" width="80px"
                                         height="110px">
                                </div>
                                <div class="flex-fill d-flex flex-column justify-content-between">
                                    <div>
                                        {{ $book->name }}
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            ({{ $book->total_sold }} sold)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-9" style="max-width: 100%">
                            <h2 class="title-1 m-b-25">Statistics on sold products</h2>
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                    <tr>
                                        <th>Order_date</th>
                                        <th>Product name</th>
                                        <th class="text-right">Price</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Total price</th>
                                    </tr>
                                    </thead>
                                    @foreach($soldProducts as $productOrd)
                                    <tbody>
                                    <tr>
                                        <td>{{ $productOrd->order_date }}</td>
                                        <td>{{ $productOrd->product_name }}</td>
                                        <td class="text-right">${{ number_format($productOrd->price, 2) }}</td>
                                        <td class="text-right">{{ $productOrd->quantity }} </td>
                                        <td class="text-right">${{ number_format($productOrd->total_price, 2) }}</td>
                                    </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        {{--Bảng hiển thị top 5 khách hàng trong tháng--}}
                        <div class="au-card recent-report">
                            <h3 class="title-2">Top 5  Low Stock Books</h3>
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Book Name</th>
                                    <th>Image</th>
                                    <th>Number of books left in the store:</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lowStockBooks as $book)
                                    <tr>
                                        <td>{{ $book->name }}</td>
                                        <td><img src="{{ $book->image }}" alt="{{ $book->name }}" width="80" height="110"></td>
                                        <td>{{ $book->quantity }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="au-card recent-report">
                            <h3 class="title-2">Top 5 Customers of the Month</h3>
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Total book buy</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topCustomers as $customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->total_sold }} books</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="zmdi zmdi-account-calendar"></i>Tasks</h3>
                                    <button class="au-btn-plus" data-toggle="modal" data-target="#addTaskModal">
                                        <i class="zmdi zmdi-plus"></i>
                                    </button>
                                </div>
                                <div class="au-task js-list-load">
                                    <div class="au-task__title">
                                        <p>Tasks for Admins</p>
                                    </div>
                                    <div class="au-task-list js-scrollbar3">
                                        @foreach($tasks as $task)
                                            <div class="au-task__item au-task__item--{{ strtolower($task->status) }}">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">{{ $task->title }}</a>
                                                    </h5>
                                                    <span class="time">{{ $task->time }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="au-task__footer">
                                        <button class="au-btn au-btn-load js-load-btn">load more</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal thêm task mới -->
                        <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog"
                             aria-labelledby="addTaskModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('dashboard.addTask') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title">Task Title</label>
                                                <input type="text" class="form-control" id="title" name="title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Task Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="time">Time</label>
                                                <input type="time" class="form-control" id="time" name="time" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="date" class="form-control" id="date" name="date" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="primary">Primary</option>
                                                    <option value="success">Success</option>
                                                    <option value="danger">Danger</option>
                                                    <option value="warning">Warning</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="admin_id">Admin: </label>
                                                <input type="number" class="form-control" id="user_id" name="user_id" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Task</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
                                    <div class="bg-overlay bg-overlay--blue"></div>
                                    <h3>
                                        <i class="zmdi zmdi-comment-text"></i>New Messages</h3>
                                    <button class="au-btn-plus">
                                        <i class="zmdi zmdi-plus"></i>
                                    </button>
                                </div>
                                <div class="au-inbox-wrap js-inbox-wrap">
                                    <div class="au-message js-list-load">
                                        <div class="au-message__noti">
                                            <p>You Have
                                                <span>2</span>

                                                new messages
                                            </p>
                                        </div>
                                        <div class="au-message-list">
                                            <div class="au-message__item unread">
                                                <div class="au-message__item-inner">
                                                    <div class="au-message__item-text">
                                                        <div class="avatar-wrap">
                                                            <div class="avatar">
                                                                <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="name">John Smith</h5>
                                                            <p>Have sent a photo</p>
                                                        </div>
                                                    </div>
                                                    <div class="au-message__item-time">
                                                        <span>12 Min ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="au-message__item unread">
                                                <div class="au-message__item-inner">
                                                    <div class="au-message__item-text">
                                                        <div class="avatar-wrap online">
                                                            <div class="avatar">
                                                                <img src="images/icon/avatar-03.jpg" alt="Nicholas Martinez">
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="name">Nicholas Martinez</h5>
                                                            <p>You are now connected on message</p>
                                                        </div>
                                                    </div>
                                                    <div class="au-message__item-time">
                                                        <span>11:00 PM</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="au-message__item">
                                                <div class="au-message__item-inner">
                                                    <div class="au-message__item-text">
                                                        <div class="avatar-wrap online">
                                                            <div class="avatar">
                                                                <img src="images/icon/avatar-04.jpg" alt="Michelle Sims">
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="name">Michelle Sims</h5>
                                                            <p>Lorem ipsum dolor sit amet</p>
                                                        </div>
                                                    </div>
                                                    <div class="au-message__item-time">
                                                        <span>Yesterday</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="au-message__item">
                                                <div class="au-message__item-inner">
                                                    <div class="au-message__item-text">
                                                        <div class="avatar-wrap">
                                                            <div class="avatar">
                                                                <img src="images/icon/avatar-05.jpg" alt="Michelle Sims">
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="name">Michelle Sims</h5>
                                                            <p>Purus feugiat finibus</p>
                                                        </div>
                                                    </div>
                                                    <div class="au-message__item-time">
                                                        <span>Sunday</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="au-message__item js-load-item">
                                                <div class="au-message__item-inner">
                                                    <div class="au-message__item-text">
                                                        <div class="avatar-wrap online">
                                                            <div class="avatar">
                                                                <img src="images/icon/avatar-04.jpg" alt="Michelle Sims">
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="name">Michelle Sims</h5>
                                                            <p>Lorem ipsum dolor sit amet</p>
                                                        </div>
                                                    </div>
                                                    <div class="au-message__item-time">
                                                        <span>Yesterday</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="au-message__item js-load-item">
                                                <div class="au-message__item-inner">
                                                    <div class="au-message__item-text">
                                                        <div class="avatar-wrap">
                                                            <div class="avatar">
                                                                <img src="images/icon/avatar-05.jpg" alt="Michelle Sims">
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <h5 class="name">Michelle Sims</h5>
                                                            <p>Purus feugiat finibus</p>
                                                        </div>
                                                    </div>
                                                    <div class="au-message__item-time">
                                                        <span>Sunday</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-message__footer">
                                            <button class="au-btn au-btn-load js-load-btn">load more</button>
                                        </div>
                                    </div>
                                    <div class="au-chat">
                                        <div class="au-chat__title">
                                            <div class="au-chat-info">
                                                <div class="avatar-wrap online">
                                                    <div class="avatar avatar--small">
                                                        <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                    </div>
                                                </div>
                                                <span class="nick">
                                                        <a href="#">John Smith</a>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="au-chat__content">
                                            <div class="recei-mess-wrap">
                                                <span class="mess-time">12 Min ago</span>
                                                <div class="recei-mess__inner">
                                                    <div class="avatar avatar--tiny">
                                                        <img src="images/icon/avatar-02.jpg" alt="John Smith">
                                                    </div>
                                                    <div class="recei-mess-list">
                                                        <div class="recei-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                                        <div class="recei-mess">Donec tempor, sapien ac viverra</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="send-mess-wrap">
                                                <span class="mess-time">30 Sec ago</span>
                                                <div class="send-mess__inner">
                                                    <div class="send-mess-list">
                                                        <div class="send-mess">Lorem ipsum dolor sit amet, consectetur adipiscing elit non iaculis</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="au-chat-textfield">
                                            <form class="au-form-icon">
                                                <input class="au-input au-input--full au-input--h65" type="text" placeholder="Type a message">
                                                <button class="au-input-icon">
                                                    <i class="zmdi zmdi-camera"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

<!-- Jquery JS-->
<script src="../../../vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="../../../vendor/bootstrap-4.1/popper.min.js"></script>
<script src="../../../vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="../../../vendor/slick/slick.min.js">
</script>
<script src="../../../vendor/wow/wow.min.js"></script>
<script src="../../../vendor/animsition/animsition.min.js"></script>
<script src="../../../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="../../../vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="../../../vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="../../../vendor/circle-progress/circle-progress.min.js"></script>
<script src="../../../vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../../../vendor/chartjs/Chart.bundle.min.js"></script>
<script src="../../../vendor/select2/select2.min.js"></script>
<script {{--type="text/javascript"--}} src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<!-- Main JS-->
<script src="js/main.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

</body>
<style>
    /*.overview-item overview-item--c1 {
       max-height: 100px;
    }*/
</style>
</html>
<!-- end document-->
