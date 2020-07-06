<?php
    include('session.php');
    include('layout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard | diva lounge spa</title>
    <?php echo $head_tags; ?>

</head>
<body>
    <div id="app">
        <div class="main-wrapper">
        <?php
            echo $nav_bar;
            echo $side_bar;
        ?>

        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
            </section>
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Total Customers</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $cust = "select * from customers";
                                $cust_get = mysqli_query($link, $cust);
                                $count_cust = mysqli_num_rows($cust_get);

                                echo $count_cust;
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Link not Generated</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $cust = "select * from customers where c_status = '0'";
                                $cust_get = mysqli_query($link, $cust);
                                $count_cust = mysqli_num_rows($cust_get);

                                echo $count_cust;
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Total Pending</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $cust = "select * from customers where c_status = '2'";
                                $cust_get = mysqli_query($link, $cust);
                                $count_cust = mysqli_num_rows($cust_get);

                                echo $count_cust;
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Total Reviews</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $cust = "select * from customers where c_status = '1'";
                                $cust_get = mysqli_query($link, $cust);
                                $count_cust = mysqli_num_rows($cust_get);

                                echo $count_cust;
                            ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Total Categories</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $cust = "select * from categories";
                                $cust_get = mysqli_query($link, $cust);
                                $count_cust = mysqli_num_rows($cust_get);

                                echo $count_cust;
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon" style="background-color: #594bfc !important">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Total Services</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $cust = "select * from services";
                                $cust_get = mysqli_query($link, $cust);
                                $count_cust = mysqli_num_rows($cust_get);

                                echo $count_cust;
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Total Staffs</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $cust = "select * from staffs";
                                $cust_get = mysqli_query($link, $cust);
                                $count_cust = mysqli_num_rows($cust_get);

                                echo $count_cust;
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                            <h4>Total Branchs</h4>
                            </div>
                            <div class="card-body">
                            <?php
                                $cust = "select * from locations";
                                $cust_get = mysqli_query($link, $cust);
                                $count_cust = mysqli_num_rows($cust_get);

                                echo $count_cust;
                            ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php echo $footer; ?>
        </div>
    </div>

    <?php echo $script_tags; ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".dashboard").addClass("active");
        });
    </script>

</body>
</html>