<?php
    include('session.php');
    include('layout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>All Feedbacks | diva lounge spa</title>
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
                    <h1>All Feedbacks</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">All Feedbacks</div>
                    </div>
                </div>
                <div class="section-body">

                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="custom-switches-stacked mt-2" style="flex-direction: row">
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
                        </div>
                    </div>

                    <div class="row mt-sm-4 filter_data">
                    
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
                var active = get_filter('active');
                var inactive = get_filter('inactive');
                $.ajax({
                    url:"processing/curd_customer.php",
                    method:"POST",
                    data:{action:action, active:active, inactive:inactive},
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
        
            $('.common_selector').on('keyup change',function(){
                filter_data();
            });

            $(".all_feedbacks").addClass("active");
        });
    </script>
</body>
</html>