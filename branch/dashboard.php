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
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary" style="background-color: #a5ce77d1 !important;">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                <h4>Total Customers</h4>
                                </div>
                                <div class="card-body">
                                <?php
                                    $cust = "select * from customers where branch_id = '$branch_id_session'";
                                    $cust_get = mysqli_query($link, $cust);
                                    $count_cust = mysqli_num_rows($cust_get);

                                    echo $count_cust;
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                <h4>Total Pending</h4>
                                </div>
                                <div class="card-body">
                                <?php
                                    $cust = "select * from customers where branch_id = '$branch_id_session' and c_status = '2'";
                                    $cust_get = mysqli_query($link, $cust);
                                    $count_cust = mysqli_num_rows($cust_get);

                                    echo $count_cust;
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success" style="background-color: #8bc251 !important;">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                <h4>Total Reviews</h4>
                                </div>
                                <div class="card-body">
                                <?php
                                    $cust = "select * from customers where branch_id = '$branch_id_session' and c_status = '1'";
                                    $cust_get = mysqli_query($link, $cust);
                                    $count_cust = mysqli_num_rows($cust_get);

                                    echo $count_cust;
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
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