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

    <script type="text/javascript">
        window.onload = function () {
            var branch = new CanvasJS.Chart("branchChart",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Customers in Branch"
                },
                legend:{
                    cursor: "pointer",
                    itemclick: explodePie
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    legendText: "{indexLabel}",
                    dataPoints: [
                        <?php
                            $branch = "select branch_id, count(branch_id) from customers group by branch_id having count(branch_id) > 0";
                            $get_branch = mysqli_query($link, $branch);
                            while($row_branch = mysqli_fetch_array($get_branch, MYSQLI_ASSOC))
                            {
                                $id = "select l_name from locations where l_id = '".$row_branch['branch_id']."'";
                                $get_id = mysqli_query($link, $id);
                                $row_id = mysqli_fetch_array($get_id, MYSQLI_ASSOC);
                        ?>
                        { y: <?php echo $row_branch['count(branch_id)']; ?>, indexLabel: "<?php echo $row_id['l_name']; ?>" },
                        <?php
                            }
                        ?>
                    ]
                }
                ]
            });

            var category = new CanvasJS.Chart("categoryChart",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Categories Rating"
                },
                legend:{
                    cursor: "pointer",
                    itemclick: explodePie
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    legendText: "{indexLabel}",
                    dataPoints: [
                        <?php
                            $branch = "select s_id, count(s_id), avg(rating) from review_form group by s_id having count(s_id) > 0";
                            $get_branch = mysqli_query($link, $branch);
                            while($row_branch = mysqli_fetch_array($get_branch, MYSQLI_ASSOC))
                            {
                                $id = "select s_name from categories where s_id = '".$row_branch['s_id']."'";
                                $get_id = mysqli_query($link, $id);
                                $row_id = mysqli_fetch_array($get_id, MYSQLI_ASSOC);
                        ?>
                        { y: <?php echo $row_branch['avg(rating)']; ?>, indexLabel: "<?php echo $row_id['s_name']; ?>" },
                        <?php
                            }
                        ?>
                    ]
                }
                ]
            });

            var return23 = new CanvasJS.Chart("returnChart",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "May Visit Again"
                },
                legend:{
                    cursor: "pointer",
                    itemclick: explodePie
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    legendText: "{indexLabel}",
                    dataPoints: [
                        <?php
                            $return2 = "select c_return, count(c_return), avg(c_return) from customers where c_return <> 0 group by c_return having count(c_return) > 0";
                            $get_return2 = mysqli_query($link, $return2);
                            while($row_return2 = mysqli_fetch_array($get_return2, MYSQLI_ASSOC))
                            {
                                if($row_return2['c_return'] == 1)
                                {
                                    $return1 = "Definitely";
                                }
                                elseif($row_return2['c_return'] == 2)
                                {
                                    $return1 = "May be";
                                }
                                elseif($row_return2['c_return'] == 3)
                                {
                                    $return1 = "Definitely Not";
                                }
                        ?>
                        { y: <?php echo $row_return2['avg(c_return)']; ?>, indexLabel: "<?php echo $return1; ?>" },
                        <?php
                            }
                        ?>
                    ]
                }
                ]
            });

            branch.render();
            category.render();
            return23.render();
        }

        function explodePie (e) {
            if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
            } else {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
            }
            e.branch.render();
            e.category.render();
            e.return23.render();
        }
    </script>

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
                            <h4>Total Feedback Forms</h4>
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

            <div class="row">
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div id="branchChart" class="card" style="height: 300px; width: 100%;"></div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div id="categoryChart" class="card" style="height: 300px; width: 100%;"></div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div id="returnChart" class="card" style="height: 300px; width: 100%;"></div>
                </div>

            </div>
        </div>

        <?php echo $footer; ?>
        </div>
    </div>

    <?php echo $script_tags; ?>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".dashboard").addClass("active");
        });
    </script>

</body>
</html>