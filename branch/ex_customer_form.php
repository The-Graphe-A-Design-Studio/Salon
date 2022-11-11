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
        .table:not(.table-sm):not(.table-md):not(.dataTable) td, .table:not(.table-sm):not(.table-md):not(.dataTable) th
        {
            padding: 0.75rem !important;
        }
        table
        {
            width:100%;
            table-layout: fixed;
        }
        .tbl-header
        {
            background-color: rgb(139, 194, 81);
            border-radius: 3px 3px 0 0;
        }
        .tbl-content
        {
            max-height: 40vh;
            overflow-x:auto;
            border-radius: 0 0 3px 3px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03)
        }

        th { 
            background: #a5ce77; 
            color: #f4f6f9; 
            font-weight: bold;
            }

        td, th { 
            padding: 8px; 
            text-align: left; 
            font-size: 1.1em;
            }
        /* for custom scrollbar for webkit browser*/

        ::-webkit-scrollbar {
            width: 6px;
        } 
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        } 
        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
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
                    <h1>Create Link</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">Create Link</div>
                    </div>
                </div>

                <div class="section-body text-right">
                    <div class="buttons">
                        <a href="customer_form"><button class="btn btn-primary btn-lg">Add Customer</button></a>
                    </div>
                </div>
                
                <div class="section-body">
                    <form id="create_form_for_customer">
                        <div class="row mt-sm-4">

                            <div class="col-12 col-md-6 cl-lg-6">
                                <div class="tbl-header">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Whatsapp</th>
                                                <th class="text-center" style="width: 10%">#</th>
                                            </tr>
                                            <tr>
                                                <th><input type="text" class="form-control common_selector search_bar" name="name" placeholder="Search Name"></th>
                                                <th><input type="text" class="form-control common_selector search_num" name="number" placeholder="Search Phone"></th>
                                                <th><input type="text" class="form-control common_selector search_whts" name="number" placeholder="Search Whastapp"></th>
                                                <th class="text-center" style="width: 10%">#</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content">
                                    <table cellpadding="0" cellspacing="0" border="0" style="table-layout: auto !important;">
                                        <tbody class="filter_data">
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6 cl-lg-6 filter_data1">
                                
                            </div>

                            
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <?php echo $footer; ?>
        </div>
    </div>

    <?php echo $script_tags; ?>
    <script type="text/javascript">

        $(document).ready(function(){

            filter_data();

            function filter_data()
            {
                var action = 'fetch_data';
                var search = get_key('search_bar');
                var number = get_num('search_num');
                var whatsapp = get_whts('search_whts');
                var branch_id = <?php echo $branch_id_session; ?>;
                $.ajax({
                    url:"processing/new_existing.php",
                    method:"POST",
                    data:{action:action, branch_id:branch_id, search: search, number: number, whatsapp: whatsapp},
                    success:function(data){
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_key()
            {
                return $('.search_bar').val();
            }

            function get_num()
            {
                return $('.search_num').val();
            }

            function get_whts()
            {
                return $('.search_whts').val();
            }

            $('.common_selector').on('keyup change',function(){
                filter_data();
                get_key();
                get_num();
                get_whts();
            });

        });

        $(document).ready(function(){
            $(".ex_customer_form").addClass("active");
        });
        
    </script>
      
</body>
</html>