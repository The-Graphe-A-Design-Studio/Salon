<?php
    include('session.php');
    include('layout.php');

    $cust_id = $_GET['cust_id'];

    $sql = "select * from cust_name_phone where cust_id = '$cust_id'";
    $g_sql = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($g_sql, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" value="<?php echo $row['']; ?>" name="viewport">
    <title>Edit Customer | diva lounge spa</title>
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
                    <h1>Edit Customer</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">Edit Customer</div>
                    </div>
                </div>

                <!-- <div class="section-body text-right">
                    <div class="buttons">
                        <a href="ex_customer_form"><button class="btn btn-primary btn-lg">Add Existing Customer</button></a>
                    </div>
                </div>                 -->
            </section>

            <div class="container p-0">
                <form id="create_form_for_customer">
                    <div class="row mt-sm-4">
                    
                        <div class="col-12">
                            <div class="card profile-widget services-widget">
                                <div class="profile-widget-description">
                                    <div class="row my-1">
                                        <div class="col-12">
                                            <span>Basic Details</span>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 form-group">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" value="<?php echo $row['cust_name']; ?>" name="newcustName" placeholder="Enter customer's first name" required>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" value="<?php echo $row['last_name']; ?>" name="newcustLastName" placeholder="Enter customer's last name" required>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Phone Num *</label>
                                            <input type="text" class="form-control" value="<?php echo $row['cust_phone']; ?>" name="newcustPhone" placeholder="Enter customer's phone number 974xxxxxxx" required>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Whatsapp Num *</label>
                                            <input type="text" class="form-control" value="<?php echo $row['whatsapp_num']; ?>" name="newcustWhatsapp" placeholder="Enter customer's whatsapp number 974xxxxxxx" required>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-12">
                                            <span>Other Details (Optional)</span>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" value="<?php echo $row['email']; ?>" name="newcustEmail" placeholder="Enter customer's email address">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Birthday</label>
                                            <input type="date" class="form-control" value="<?php echo $row['birthday']; ?>" name="newcustBday" placeholder="Enter customer's birthday">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Anniversary</label>
                                            <input type="date" class="form-control" value="<?php echo $row['anniversary']; ?>" name="newcustAday" placeholder="Enter customer's anniversary">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Work Phone Num</label>
                                            <input type="text" class="form-control" value="<?php echo $row['work_phone']; ?>" name="newcustWorkPhoneNum" placeholder="Enter customer's work phone number 974xxxxxxx">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Qatar ID</label>
                                            <input type="text" class="form-control" value="<?php echo $row['qatar_id']; ?>" name="newcustQatarId" placeholder="Enter customer's Qatar ID">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" value="<?php echo $row['address_1']; ?>" name="newcustAddress1" placeholder="Enter customer's address line 1">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" value="<?php echo $row['address_2']; ?>" name="newcustAddress2" placeholder="Enter customer's address line 2">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" value="<?php echo $row['city']; ?>" name="newcustCity" placeholder="Enter customer's city">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Zipcode/Zone</label>
                                            <input type="text" class="form-control" value="<?php echo $row['zip']; ?>" name="newcustZip" placeholder="Enter customer's zipcode/zone">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" value="<?php echo $row['state']; ?>" name="newcustState" placeholder="Enter customer's state">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" value="<?php echo $row['country']; ?>" name="newcustCountry" placeholder="Enter customer's country">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Others</label>
                                            <textarea class="form-control" value="<?php echo $row['others']; ?>" name="newcustOthers" placeholder="Enter other details" style="height: 15vh;"></textarea>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <input type="text" name="customer_id" value="<?php echo $cust_id; ?>" hidden>
                            <input type="text" name="branch_id" value="<?php echo $branch_id_session; ?>" hidden>
                            <button class="btn btn-primary btn-lg" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
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
                    url: 'processing/curd_customer.php',
                    data: form_data,
                    type: 'POST',
                    success: function(data)
                    {
                        alert(data);
                        if(data === "Customer details updated.")
                        {
                            location.href="all_customers";
                        }
                        button_content.removeClass("disabled btn-progress");
                    }
                });
                e.preventDefault();
            });

        });

        // $(document).ready(function(){
        //     $(".customers").addClass("active");
        // });
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