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

    <style>
        .canvasjs-chart-credit
        {
            display: none;
        }
    </style>

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

            var q11 = new CanvasJS.Chart("q1",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Quality of Spa Reservation"
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
                            $q1 = "select c_q1, count(c_q1), avg(c_q1) from customers where c_q1 <> 0 group by c_q1 having count(c_q1) > 0";
                            $get_q1 = mysqli_query($link, $q1);
                            while($row_q1 = mysqli_fetch_array($get_q1, MYSQLI_ASSOC))
                            {
                                if($row_q1['c_q1'] == 1)
                                {
                                    $q111 = "Very Poor";
                                }
                                elseif($row_q1['c_q1'] == 2)
                                {
                                    $q111 = "Poor";
                                }
                                elseif($row_q1['c_q1'] == 3)
                                {
                                    $q111 = "Average";
                                }
                                elseif($row_q1['c_q1'] == 4)
                                {
                                    $q111 = "Very Good";
                                }
                                elseif($row_q1['c_q1'] == 5)
                                {
                                    $q111 = "Excellent";
                                }
                        ?>
                        { y: <?php echo $row_q1['avg(c_q1)']; ?>, indexLabel: "<?php echo $q111; ?>" },
                        <?php
                            }
                        ?>
                    ]
                }
                ]
            });

            var q22 = new CanvasJS.Chart("q2",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Spa Receptionist Service"
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
                            $q2 = "select c_q2, count(c_q2), avg(c_q2) from customers where c_q2 <> 0 group by c_q2 having count(c_q2) > 0";
                            $get_q2 = mysqli_query($link, $q2);
                            while($row_q2 = mysqli_fetch_array($get_q2, MYSQLI_ASSOC))
                            {
                                if($row_q2['c_q2'] == 1)
                                {
                                    $q222 = "Very Poor";
                                }
                                elseif($row_q2['c_q2'] == 2)
                                {
                                    $q222 = "Poor";
                                }
                                elseif($row_q2['c_q2'] == 3)
                                {
                                    $q222 = "Average";
                                }
                                elseif($row_q2['c_q2'] == 4)
                                {
                                    $q222 = "Very Good";
                                }
                                elseif($row_q2['c_q2'] == 5)
                                {
                                    $q222 = "Excellent";
                                }
                        ?>
                        { y: <?php echo $row_q2['avg(c_q2)']; ?>, indexLabel: "<?php echo $q222; ?>" },
                        <?php
                            }
                        ?>
                    ]
                }
                ]
            });

            var q33 = new CanvasJS.Chart("q3",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Treatment Room / Area Ambience"
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
                            $q3 = "select c_q3, count(c_q3), avg(c_q3) from customers where c_q3 <> 0 group by c_q3 having count(c_q3) > 0";
                            $get_q3 = mysqli_query($link, $q3);
                            while($row_q3 = mysqli_fetch_array($get_q3, MYSQLI_ASSOC))
                            {
                                if($row_q3['c_q3'] == 1)
                                {
                                    $q333 = "Very Poor";
                                }
                                elseif($row_q3['c_q3'] == 2)
                                {
                                    $q333 = "Poor";
                                }
                                elseif($row_q3['c_q3'] == 3)
                                {
                                    $q333 = "Average";
                                }
                                elseif($row_q3['c_q3'] == 4)
                                {
                                    $q333 = "Very Good";
                                }
                                elseif($row_q3['c_q3'] == 5)
                                {
                                    $q333 = "Excellent";
                                }
                        ?>
                        { y: <?php echo $row_q3['avg(c_q3)']; ?>, indexLabel: "<?php echo $q333; ?>" },
                        <?php
                            }
                        ?>
                    ]
                }
                ]
            });

            var q44 = new CanvasJS.Chart("q4",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Therapist Consultation skill"
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
                            $q3 = "select c_q4, count(c_q4), avg(c_q4) from customers where c_q4 <> 0 group by c_q4 having count(c_q4) > 0";
                            $get_q3 = mysqli_query($link, $q3);
                            while($row_q3 = mysqli_fetch_array($get_q3, MYSQLI_ASSOC))
                            {
                                if($row_q3['c_q4'] == 1)
                                {
                                    $q333 = "Very Poor";
                                }
                                elseif($row_q3['c_q4'] == 2)
                                {
                                    $q333 = "Poor";
                                }
                                elseif($row_q3['c_q4'] == 3)
                                {
                                    $q333 = "Average";
                                }
                                elseif($row_q3['c_q4'] == 4)
                                {
                                    $q333 = "Very Good";
                                }
                                elseif($row_q3['c_q4'] == 5)
                                {
                                    $q333 = "Excellent";
                                }
                        ?>
                        { y: <?php echo $row_q3['avg(c_q4)']; ?>, indexLabel: "<?php echo $q333; ?>" },
                        <?php
                            }
                        ?>
                    ]
                }
                ]
            });

            var q55 = new CanvasJS.Chart("q5",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Quality of Treatment"
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
                            $q3 = "select c_q5, count(c_q5), avg(c_q5) from customers where c_q5 <> 0 group by c_q5 having count(c_q5) > 0";
                            $get_q3 = mysqli_query($link, $q3);
                            while($row_q3 = mysqli_fetch_array($get_q3, MYSQLI_ASSOC))
                            {
                                if($row_q3['c_q5'] == 1)
                                {
                                    $q333 = "Very Poor";
                                }
                                elseif($row_q3['c_q5'] == 2)
                                {
                                    $q333 = "Poor";
                                }
                                elseif($row_q3['c_q5'] == 3)
                                {
                                    $q333 = "Average";
                                }
                                elseif($row_q3['c_q5'] == 4)
                                {
                                    $q333 = "Very Good";
                                }
                                elseif($row_q3['c_q5'] == 5)
                                {
                                    $q333 = "Excellent";
                                }
                        ?>
                        { y: <?php echo $row_q3['avg(c_q5)']; ?>, indexLabel: "<?php echo $q333; ?>" },
                        <?php
                            }
                        ?>
                    ]
                }
                ]
            });

            var q66 = new CanvasJS.Chart("q6",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Quality of time spent"
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
                            $q3 = "select c_q6, count(c_q6), avg(c_q6) from customers where c_q6 <> 0 group by c_q6 having count(c_q6) > 0";
                            $get_q3 = mysqli_query($link, $q3);
                            while($row_q3 = mysqli_fetch_array($get_q3, MYSQLI_ASSOC))
                            {
                                if($row_q3['c_q6'] == 1)
                                {
                                    $q333 = "Very Poor";
                                }
                                elseif($row_q3['c_q6'] == 2)
                                {
                                    $q333 = "Poor";
                                }
                                elseif($row_q3['c_q6'] == 3)
                                {
                                    $q333 = "Average";
                                }
                                elseif($row_q3['c_q6'] == 4)
                                {
                                    $q333 = "Very Good";
                                }
                                elseif($row_q3['c_q6'] == 5)
                                {
                                    $q333 = "Excellent";
                                }
                        ?>
                        { y: <?php echo $row_q3['avg(c_q6)']; ?>, indexLabel: "<?php echo $q333; ?>" },
                        <?php
                            }
                        ?>
                    ]
                }
                ]
            });

            var q77 = new CanvasJS.Chart("q7",
            {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Over all Spa Experience"
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
                            $q3 = "select c_q7, count(c_q7), avg(c_q7) from customers where c_q7 <> 0 group by c_q7 having count(c_q7) > 0";
                            $get_q3 = mysqli_query($link, $q3);
                            while($row_q3 = mysqli_fetch_array($get_q3, MYSQLI_ASSOC))
                            {
                                if($row_q3['c_q7'] == 1)
                                {
                                    $q333 = "Very Poor";
                                }
                                elseif($row_q3['c_q7'] == 2)
                                {
                                    $q333 = "Poor";
                                }
                                elseif($row_q3['c_q7'] == 3)
                                {
                                    $q333 = "Average";
                                }
                                elseif($row_q3['c_q7'] == 4)
                                {
                                    $q333 = "Very Good";
                                }
                                elseif($row_q3['c_q7'] == 5)
                                {
                                    $q333 = "Excellent";
                                }
                        ?>
                        { y: <?php echo $row_q3['avg(c_q7)']; ?>, indexLabel: "<?php echo $q333; ?>" },
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
            q11.render();
            q22.render();
            q33.render();
            q44.render();
            q55.render();
            q66.render();
            q77.render();
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
            e.q11.render();
            e.q22.render();
            e.q33.render();
            e.q44.render();
            e.q55.render();
            e.q66.render();
            e.q77.render();
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
                        <div class="card-icon bg-primary">
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
                        <div class="card-icon bg-primary">
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
                        <div class="card-icon bg-primary">
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
                        <div class="card-icon bg-primary">
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
                        <div class="card-icon bg-primary">
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
                        <div class="card-icon bg-primary">
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

                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div id="returnChart" class="card" style="height: 300px; width: 100%;"></div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div id="q1" class="card" style="height: 300px; width: 100%;"></div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div id="q2" class="card" style="height: 300px; width: 100%;"></div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div id="q3" class="card" style="height: 300px; width: 100%;"></div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div id="q4" class="card" style="height: 300px; width: 100%;"></div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div id="q5" class="card" style="height: 300px; width: 100%;"></div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div id="q6" class="card" style="height: 300px; width: 100%;"></div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                    <div id="q7" class="card" style="height: 300px; width: 100%;"></div>
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