<?php
    include('session.php');
    include('layout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Customers | diva lounge spa</title>
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
                    <h1>Customers <span style="font-size: 0.6em; margin-left: 10px;">Feedback</span></h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">Cutomers Feedback</div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row mt-sm-4">

                        <?php
                            $customers = array();
                            $cust = "select * from customers order by c_id desc";
                            $get_cust = mysqli_query($link, $cust);
                            while($row_cust = mysqli_fetch_array($get_cust, MYSQLI_ASSOC))
                            {
                                $customers[] = $row_cust;
                            }
                            foreach($customers as $customer)
                            {
                        ?>

                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="card profile-widget">
                                <div class="profile-widget-header">
                                    <div class="profile-widget-items">
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-value"><?php echo $customer['c_name']; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-widget-description">
                                    <div class="profile-widget-name">
                                        <?php echo $customer['c_email']; ?> 
                                        <div class="text-muted d-inline font-weight-normal">
                                            <div class="slash"></div>
                                            <?php echo $customer['c_phone']; ?>
                                        </div>
                                    </div>
                                    <div class="card" style="box-shadow: 0 !important; margin-bottom: 0 !important;">
                                        <div class="card-header" style="padding: 0 !important; min-height: 20px !important;">
                                            <h4>Services used</h4>
                                        </div>
                                        <div class="card-body" style="padding: 0 !important">
                                            <ul class="list-group">
                                                <?php
                                                    $re = "select * from review_form where c_id = '".$customer['c_id']."'";
                                                    $get_re = mysqli_query($link, $re);
                                                    while($row_re = mysqli_fetch_array($get_re, MYSQLI_ASSOC))
                                                    {
                                                        $service = "select * from services where se_id = '".$row_re['se_id']."'";
                                                        $get_service = mysqli_query($link, $service);
                                                        $row_service = mysqli_fetch_array($get_service, MYSQLI_ASSOC);
                                                ?>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?php echo $row_service['se_name']; ?>
                                                        <span class="badge badge-primary badge-pill"><?php echo $row_re['rating']; ?>/5</span>
                                                    </li>
                                                <?php } ?>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <?php echo $customer['c_comment']; ?>
                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            }
                        ?>

                    </div>
                </div>
            </section>
        </div>

        <?php echo $footer; ?>
        </div>
    </div>

    <?php echo $script_tags; ?>

    <script type="text/javascript">
        $(document).ready(function()
        {
            $(".customers").addClass("active");
        });
    </script>
</body>
</html>