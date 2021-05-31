<?php

include('admin_header.php');
include('navbar.php');
include('sidebar.php');

?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-6 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="position-relative">
                                        <canvas id="turnover-current" height="125"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="position-relative">
                                        <canvas id="turnover-months" height="125"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="position-relative">
                                        <canvas id="popular-products" height="125"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="position-relative">
                                        <canvas id="best-customers" height="125"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include('admin_footer.php') ?>

    <script src="js/dashboard.js"></script>