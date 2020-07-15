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
                padding-left: 50%; 
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
                width: 45%; 
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

                <div class="section-body text-right">
                    <div class="buttons">
                        <a href="customer_form"><button class="btn btn-primary btn-lg">Add new Customer</button></a>
                        <a href="ex_customer_form"><button class="btn btn-primary btn-lg">Add Existing Customer</button></a>
                    </div>
                </div>

                <div class="section-body" style="margin-top: 2vh">
                    <div class="row">
                        <!-- <div class="col-12 col-md-4">
                            <div class="custom-switches-stacked mt-2" style="flex-direction: row">
                                <label class="custom-switch">
                                    <input type="radio" name="option" class="custom-switch-input common_selector nothing" value="0">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Link not Generated</span>
                                </label>
                                <label class="custom-switch">
                                    <input type="radio" name="option" class="custom-switch-input common_selector active" value="1">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Reviewed</span>
                                </label>
                                <label class="custom-switch">
                                    <input type="radio" name="option" class="custom-switch-input common_selector inactive" value="2">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Pending</span>
                                </label>
                            </div>
                        </div> -->
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <div class="form-div">
                                    <input class="form-control common_selector search_date" placeholder="Search Customer by Date" name="date"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <div class="form-div">
                                    <input class="form-control common_selector search_bar" placeholder="Search Customer by Name" name="name"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-sm-4">
                        <input type="button" id="refresh_btn" value="Refresh" hidden>
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Ticket</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Link</th>
                                    <th>Edit Details</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="filter_data">
                            
                            </tbody>
                        </table>
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

            filter_data();
        
            function filter_data()
            {
                var action = 'fetch_data';
                var active = get_filter('active');
                var inactive = get_filter('inactive');
                var nothing = get_filter('nothing');
                var search = get_key('search_bar');
                var date = get_date('search_date');
                $.ajax({
                    url:"processing/curd_customer.php",
                    method:"POST",
                    data:{action:action, active:active, inactive:inactive, nothing:nothing, search: search, date: date, branch: <?php echo $branch_id_session; ?>},
                    success:function(data){
                        $('.filter_data').html(data);
                    }
                });
            }
        
            function get_filter(class_name)
            {
                var filter = [];
                $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }
        
            function get_key()
            {
                return $('.search_bar').val();
            }

            function get_date()
            {
                return $('.search_date').val();
                
            }

            $('.common_selector').on('keyup change',function(){
                filter_data();
                get_key();
                get_date();
            });

            $('#refresh_btn').on('click',function(){
                filter_data();
            });

            $(".cust_form").submit(function(e)
            {
                var form_data = $(this).serialize();
                // alert(form_data);
                var button_content = $(this).find('button[type=submit]');
                button_content.addClass("disabled btn-progress");
                $.ajax({
                    url: 'processing/curd_customer.php',
                    data: form_data,
                    type: 'POST',
                    success: function(data)
                    {
                        alert(data);
                        button_content.removeClass("disabled btn-progress");
                        $('#exampleModal').removeClass("show");
                        filter_data();
                    }
                });
                e.preventDefault();
            });

        });

        $(document).ready(function(){
            $(".customers").addClass("active");
        });
    </script>
    <script>
        $("#insert-more").click(function () {
            $("#mytable").each(function () {
                var tds = '<tr>';
                jQuery.each($('tr:last td', this), function () {
                    tds += '<td>' + $(this).html() + '</td>';
                });
                tds += '</tr>';
                if ($('tbody', this).length > 0) {
                    $('tbody', this).append(tds);
                } else {
                    $(this).append(tds);
                }
            });
        });
    </script>
</body>
</html>