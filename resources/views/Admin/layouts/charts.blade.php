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
    $url='charts'
    ?>
    @include('admin.layouts.sidebar')
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
@include('admin.layouts.header')
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">overview</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="au-card recent-report">
                                        <div class="au-card-inner">
                                            <h3 class="title-2">recent reports</h3>
                                            <div id="chartContainer3" style="width: 100%; height: 350px;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="au-card chart-percent-card">
                                        <div class="au-card-inner">
                                            <h3 class="title-2 tm-b-5">Statistics on book genres sold</h3>
                                            <div id="chartContainer2" style="width: 100%; height: 350px;display: inline-block;"></div><br/>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="au-card chart-percent-card">
                                        <div class="au-card-inner">
                                            <h3 class="title-2 tm-b-5">Statistics on book authors sold</h3>
                                            <div id="chartContainer4"  style="width: 100%; height: 350px;display: inline-block;"></div><br/>
                                        </div>
                                    </div>
                                </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script>
        window.onload = function () {
            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,

                data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        legendText: "{label}",
                        indexLabel: "{label} - {y}%",
                        dataPoints: <?php echo json_encode($secondChartData, JSON_NUMERIC_CHECK); ?>
                    },
                ]
            });
            chart2.render();


            var chart3 = new CanvasJS.Chart("chartContainer3", {
                animationEnabled: true,

                axisX: {
                    valueFormatString: "DD MMM",
                    interval: 1,
                    intervalType: "day"
                },

                axisY: {
                    includeZero: false
                },

                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($firstChartData, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart3.render();

            var chart4 = new CanvasJS.Chart("chartContainer4", {
                animationEnabled: true,

                data: [
                    {
                        type: "pie",
                        showInLegend: true,
                        legendText: "{label}",
                        indexLabel: "{label} - {y}%",
                        dataPoints: <?php echo json_encode($thirdChartData, JSON_NUMERIC_CHECK); ?>
                    },
                ]
            });
            chart4.render();
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

</body>

</html>
