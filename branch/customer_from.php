<?php
    include('session.php');
    include('layout.php');

    $cust_id = $_GET['cust_id'];

    $cust = "select * from customers where c_id = '$cust_id'";
    $cust_run = mysqli_query($link, $cust);
    $cust_row = mysqli_fetch_array($cust_run, MYSQLI_ASSOC);
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
                    <h1>Customers Form</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item active"><a href="customers">Customers</a></div>
                        <div class="breadcrumb-item">Customers Form</div>
                    </div>
                </div>

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card profile-widget services-widget">
                                <div class="profile-widget-description">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                Name
                                            </div>
                                            <p><?php echo $cust_row['c_name']; ?></p>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                Email
                                            </div>
                                            <p><?php echo $cust_row['c_email']; ?></p>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                Phone
                                            </div>
                                            <p><?php echo $cust_row['c_phone']; ?></p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-body">
                    <form id="create_form_for_customer">
                        <div class="row mt-sm-4">
                        <?php
                            $i = 1;
                            $category = "select * from categories order by s_name asc";
                            $get_category = mysqli_query($link, $category);
                            while($row_category = mysqli_fetch_array($get_category, MYSQLI_ASSOC))
                            {
                                $categories[] = $row_category;
                            }
                            foreach($categories as $cat)
                            {

                        ?>
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card profile-widget services-widget">
                                    <div class="profile-widget-description" data-toggle="collapse" data-target="#collapse<?php echo $cat['s_id']; ?>" 
                                        aria-expanded="true" aria-controls="collapse<?php echo $cat['s_id']; ?>" style="cursor: pointer">
                                        <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                            <?php echo $cat['s_name']; ?>
                                            <i class="fas fa-caret-down" style="float: right"></i>
                                        </div>
                                    </div>
                                    
                                    <div class="collapse" id="collapse<?php echo $cat['s_id']; ?>" style="">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card" style="box-shadow: none !important; margin-bottom: 0 !important">
                                                    <div class="card-body">
                                                        <div class="table-responsive my-table-responsive">
                                                            <table class="table" id="mytable<?php echo $cat['s_id']; ?>">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="form-group">
                                                                            <label>Services</label>
                                                                            <select class="form-control" name="services_<?php echo $i; ?>[]" required>
                                                                                <?php
                                                                                    $service = "select * from services where s_id = '".$cat['s_id']."'";
                                                                                    $get_service = mysqli_query($link, $service);
                                                                                    while($row_service = mysqli_fetch_array($get_service, MYSQLI_ASSOC))
                                                                                    {
                                                                                ?>
                                                                                    <option value="<?php echo $row_service['se_id']; ?>"><?php echo $row_service['se_name']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </td>
                                                                        <td class="form-group">
                                                                            <label>Staff</label>
                                                                            <select class="form-control" name="staff_<?php echo $i; ?>[]" required>
                                                                                <?php
                                                                                    $staff = "select * from staffs";
                                                                                    $get_staff = mysqli_query($link, $staff);
                                                                                    while($row_staff = mysqli_fetch_array($get_staff, MYSQLI_ASSOC))
                                                                                    {
                                                                                ?>
                                                                                    <option value="<?php echo $row_staff['st_id']; ?>"><?php echo $row_staff['st_name']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="text-center">
                                                            <span id="insert-more<?php echo $cat['s_id']; ?>" class="btn btn-primary btn-icon btn-lg" title="Add new Row" style="cursor: pointer"><i class="fas fa-plus"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                                $i++;
                            }
                        ?>
                            <div class="col-12 text-center">
                                <input type="text" value="<?php echo $i - 1; ?>" name="category_count" hidden>
                                <button class="btn btn-primary btn-lg" type="submit">Create Form</button>
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
        <?php
            foreach($categories as $cat)
            {
                $di = $cat['s_id'];
        ?>
        $("#insert-more<?php echo $di; ?>").click(function () {
            $("#mytable<?php echo $di; ?>").each(function () {
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
        <?php
            }
        ?>
    </script>
</body>
</html>