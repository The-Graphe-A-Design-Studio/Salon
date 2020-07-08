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
                    <form id="create_form_for_customer">
                        <div class="row mt-sm-4">
                        
                            <div class="col-12 col-md-3 cl-lg-3"></div>

                            <div class="col-12 col-md-6 cl-lg-6">
                                <div class="card profile-widget services-widget">
                                    <div class="profile-widget-description">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                    Name
                                                </div>
                                                <p><input type="text" class="form-control" name="newcustName"></p>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                    Email
                                                </div>
                                                <p><input type="email" class="form-control" name="newcustEmail"></p>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                    Phone
                                                </div>
                                                <p><input type="text" class="form-control" name="newcustPhone"></p>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="card profile-widget services-widget">
                                    <div class="profile-widget-description">
                                        <table class="table" id="mytable">
                                            <tbody>
                                                <tr>
                                                    <td class="form-group">
                                                        <label>Services</label>
                                                        <select class="form-control" name="services[]" required>
                                                            <?php
                                                                $service = "select * from services order by se_name";
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
                                                        <select class="form-control" name="staff[]" required>
                                                            <?php
                                                                $staff = "select * from staffs order by st_name";
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

                                        <div class="text-center">
                                            <span id="insert-more" class="btn btn-primary btn-icon btn-lg" title="Add new Row" style="cursor: pointer"><i class="fas fa-plus"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 cl-lg-3"></div>
                            
                            <div class="col-12 text-center">
                                <!-- <input type="text" name="customer_id" value="<?php echo $cust_id; ?>" hidden> -->
                                <input type="text" name="branch_id" value="<?php echo $branch_id_session; ?>" hidden>
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

            $("#create_form_for_customer").submit(function(e)
            {
                var form_data = $(this).serialize();
                // alert(form_data);
                var button_content = $(this).find('button[type=submit]');
                button_content.addClass("disabled btn-progress");
                $.ajax({
                    url: 'processing/curd_form.php',
                    data: form_data,
                    type: 'POST',
                    success: function(data)
                    {
                        alert(data);
                        if(data === "Customer registered and form created")
                        {
                            location.href="customers";
                        }
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