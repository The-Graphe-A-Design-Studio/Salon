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
    <style>
        
        table { 
        width: 100%; 
        border-collapse: collapse; 
        }

        th { 
            background: #a5ce77; 
            color: #f4f6f9; 
            font-weight: bold;
            }

        td, th { 
            padding: 8px; 
            border: 1px solid #a5ce77; 
            text-align: center; 
            font-size: 1.1em;
            }

        /* 
        Max width before this PARTICULAR table gets nasty
        This query will take effect for any screen smaller than 760px
        and also iPads specifically.
        */
        @media 
        only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px)  {

            table { 
                width: 100%; 
            }

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr { 
                display: block; 
            }
            
            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr { 
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            
            tr { border: 1px solid #ccc; }
            
            td { 
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee; 
                position: relative;
                padding-left: 30%; 
            }

            .copy-td
            {
                padding-left: 0% !important;
            }

            .form-link
            {
                padding-left: 0 !important;
            }

            td:before { 
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                padding-right: 10px; 
                white-space: nowrap;
                /* Label the data */
                content: attr(data-column);

                color: #000;
                font-weight: bold;
            }

        }
    </style>
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
                    <h1>Customers</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">Customers</div>
                    </div>
                </div>
                <div class="section-body">

                    <div class="row">
                        <!-- <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Branch</label>
                                <select class="form-control common_selector branch">
                                    <option value="">All</option>
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
                        </div> -->
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control common_selector branch" placeholder="Search by name">
                            </div>
                        </div>
                        <!-- <div class="col-12 col-md-3">
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
                        </div> -->
                    </div>

                    <div class="container-fluid">
                        <div class="row filter_data"></div>
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
                var branch_id = <?php echo $branch_id_session; ?>;
                // alert(branch);
                // alert(start_date);
                // alert(end_date);
                $.ajax({
                    url:"processing/curd_all_customers.php",
                    method:"POST",
                    data:{action:action, branch:branch, branch_id:branch_id, start_date:start_date, end_date:end_date},
                    success:function(data){
                        $('.filter_data').html(data);
                    }
                });
            }

            function branchw()
            {
                return $('.branch').val();
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
                // alert("jdhfj");
                filter_data();
                branchw();
                start_datee();
                end_datee();
            });

            $(".all_customers").addClass("active");
        });
    </script>
</body>
</html>