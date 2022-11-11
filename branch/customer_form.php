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
                    <h1>Add New Customer</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item active"><a href="customers">Customers</a></div>
                        <div class="breadcrumb-item">Add New Customer</div>
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
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4 form-group">
                                            <label>Ticket Num *</label>
                                            <input type="text" class="form-control" name="newcustTicket" placeholder="Enter ticket number" required>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-12">
                                            <span>Basic Details</span>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 form-group">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" name="newcustName" placeholder="Enter customer's first name" required>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" name="newcustLastName" placeholder="Enter customer's last name" required>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Phone Num *</label>
                                            <input type="text" class="form-control" name="newcustPhone" placeholder="Enter customer's phone number 974xxxxxxx" required>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Whatsapp Num *</label>
                                            <input type="text" class="form-control" name="newcustWhatsapp" placeholder="Enter customer's whatsapp number 974xxxxxxx" required>
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
                                            <input type="email" class="form-control" name="newcustEmail" placeholder="Enter customer's email address">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Birthday</label>
                                            <input type="date" class="form-control" name="newcustBday" placeholder="Enter customer's birthday">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Anniversary</label>
                                            <input type="date" class="form-control" name="newcustAday" placeholder="Enter customer's anniversary">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Work Phone Num</label>
                                            <input type="text" class="form-control" name="newcustWorkPhoneNum" placeholder="Enter customer's work phone number 974xxxxxxx">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Qatar ID</label>
                                            <input type="text" class="form-control" name="newcustQatarId" placeholder="Enter customer's Qatar ID">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" name="newcustAddress1" placeholder="Enter customer's address line 1">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" name="newcustAddress2" placeholder="Enter customer's address line 2">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="newcustCity" placeholder="Enter customer's city">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Zipcode/Zone</label>
                                            <input type="text" class="form-control" name="newcustZip" placeholder="Enter customer's zipcode/zone">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="newcustState" placeholder="Enter customer's state">
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-3 form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="newcustCountry" placeholder="Enter customer's country">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Others</label>
                                            <textarea class="form-control" name="newcustOthers" placeholder="Enter other details" style="height: 15vh;"></textarea>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-12">
                                            <span>Add Services</span>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 p-0">
                                        <table class="table" id="mytable">
                                            <tbody>
                                                <tr>
                                                    <td class="form-group">
                                                        <label>Services</label>
                                                        <select class="form-control" name="services[]" required>
                                                            <option value="" selected>-- Select --</option>
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
                                                            <option value="" selected>-- Select --</option>
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
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <!-- <input type="text" name="customer_id" value="<?php echo $cust_id; ?>" hidden> -->
                            <input type="text" name="branch_id" value="<?php echo $branch_id_session; ?>" hidden>
                            <button class="btn btn-primary btn-lg" type="submit">Create Feedback Link</button>
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
                    url: 'processing/curd_form.php',
                    data: form_data,
                    type: 'POST',
                    success: function(data)
                    {
                        alert(data);
                        if(data === "Customer registered and form created")
                        {
                            location.href="links";
                        }
                        button_content.removeClass("disabled btn-progress");
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