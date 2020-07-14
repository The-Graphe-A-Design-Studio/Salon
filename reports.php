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
                    <h1>Report Analysis</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">Report Analysis</div>
                    </div>
                </div>
                <div class="section-body">

                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" placeholder="MM/DD/YYYY" class="form-control common_selector s_date" name="start_date"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" placeholder="MM/DD/YYYY" class="form-control common_selector e_date" name="end_date"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Branch</label>
                                <select class="form-control common_selector branch">
                                    <option>All</option>
                                    <?php
                                        $branch = "select * from locations";
                                        $get_branch = mysqli_query($link, $branch);
                                        while($row_branch = mysqli_fetch_array($get_branch, MYSQLI_ASSOC))
                                        {
                                    ?>
                                    <option value="<?php echo $row_branch['l_id']; ?>"><?php echo $row_branch['l_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-sm-4 filter_data">

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
            filter_data();
        
            function filter_data()
            {
                var action = 'fetch_data';
                var branch = branchw();
                var start_date = start_datee();
                var end_date = end_datee();
                alert(branch);
                alert(start_date);
                alert(end_date);
                $.ajax({
                    url:"processing/curd_report.php",
                    method:"POST",
                    data:{action:action, branch:branch, start_date:start_date, end_date:end_date},
                    success:function(data){
                        $('.filter_data').html(data);
                    }
                });
            }

            function branchw()
            {
                return $('.branch').find('option:selected').val();
            }

            function start_datee()
            {
                return $('.s_date').val();
            }

            function end_datee()
            {
                return $('.e_date').val();
            }

            $('.common_selector').on('keyup change',function(){
                alert("jdhfj");
                filter_data();
                branchw();
                start_datee();
                end_datee();
            });

            $(".reports").addClass("active");
        });
    </script>
</body>
</html>