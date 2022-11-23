<?php
    include('session.php');
    include('layout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Add Customer | diva lounge spa</title>
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
                                        <div class="col-12 mb-3">
                                            Create feedback link for new customer.
                                        </div>
                                    </div>
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
                                            <input type="text" class="form-control" name="firstName" placeholder="Enter your first name">
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" name="lastName" placeholder="Enter your last name">
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Phone Num *</label>
                                            <div class="d-flex">
                                                <select class="form-control w-auto mr-3" name="con_phone">
                                                <?php
                                                    $con_code1 = "select distinct(dial_code) from countries order by dial_code asc";
                                                    $get_con_code1 = mysqli_query($link, $con_code1);
                                                    while($row_con_code1 = mysqli_fetch_array($get_con_code1, MYSQLI_ASSOC))
                                                    {
                                                ?>
                                                    <option value="<?php echo $row_con_code1['dial_code']; ?>" <?php if($row_con_code1['dial_code'] == 974){ ?> selected="true" <?php } ?>>
                                                        <?php echo $row_con_code1['dial_code']; ?>
                                                    </option>
                                                <?php } ?>
                                                </select>
                                                <input type="tel" class="form-control w-100" name="phone" placeholder="Enter your phone number 974xxxxxxx">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Whatsapp Num *</label>
                                            <div class="d-flex">
                                                <select class="form-control w-auto mr-3" name="con_whatsapp">
                                                <?php
                                                    $con_code2 = "select distinct(dial_code) from countries order by dial_code asc";
                                                    $get_con_code2 = mysqli_query($link, $con_code2);
                                                    while($row_con_code2 = mysqli_fetch_array($get_con_code2, MYSQLI_ASSOC))
                                                    {
                                                ?>
                                                    <option value="<?php echo $row_con_code2['dial_code']; ?>" <?php if($row_con_code2['dial_code'] == 974){ ?> selected="true" <?php } ?>>
                                                        <?php echo $row_con_code2['dial_code']; ?>
                                                    </option>
                                                <?php } ?>
                                                </select>
                                                <input type="tel" class="form-control w-100" name="whatsapp" placeholder="Enter your whatsapp number 974xxxxxxx">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-12">
                                            <span>Personal Details (Optional)</span>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter your email address">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Birthday (Year optional)</label>
                                            <div class="input-group">
                                                <select class="form-control" name="bday_date" id="">
                                                    <option value="">DD</option>
                                                    <?php
                                                        for($i = 1; $i <= 31; $i++)
                                                        {
                                                    ?>
                                                        <option value="<?php echo date_format(date_create($i."-08-1994"), 'd'); ?>">
                                                            <?php echo $i; ?>
                                                        </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <select class="form-control" name="bday_month" id="">
                                                    <option value="">MM</option>
                                                    <?php
                                                        for($i = 1; $i <= 12; $i++)
                                                        {
                                                    ?>
                                                        <option value="<?php echo date_format(date_create("01-".$i."-1994"), 'm'); ?>">
                                                            <?php echo date_format(date_create("01-".$i."-1994"), 'M'); ?>
                                                        </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <select class="form-control" name="bday_year" id="">
                                                    <option value="">YY</option>
                                                    <?php
                                                        for($i = 1950; $i <= 2030; $i++)
                                                        {
                                                    ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>                                                        
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Anniversary (Year optional)</label>
                                            <div class="input-group">
                                                <select class="form-control" name="aday_date" id="">
                                                    <option value="">DD</option>
                                                    <?php
                                                        for($i = 1; $i <= 31; $i++)
                                                        {
                                                    ?>
                                                        <option value="<?php echo date_format(date_create($i."-08-1994"), 'd'); ?>">
                                                            <?php echo $i; ?>
                                                        </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <select class="form-control" name="aday_month" id="">
                                                    <option value="">MM</option>
                                                    <?php
                                                        for($i = 1; $i <= 12; $i++)
                                                        {
                                                    ?>
                                                        <option value="<?php echo date_format(date_create("01-".$i."-1994"), 'm'); ?>">
                                                            <?php echo date_format(date_create("01-".$i."-1994"), 'M'); ?>
                                                        </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <select class="form-control" name="aday_year" id="">
                                                    <option value="">YY</option>
                                                    <?php
                                                        for($i = 1950; $i <= 2030; $i++)
                                                        {
                                                    ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>                                                        
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Work Phone Num</label>
                                            <div class="d-flex">
                                                <select class="form-control w-auto mr-3" name="con_work_phone">
                                                <?php
                                                    $con_code3 = "select distinct(dial_code) from countries order by dial_code asc";
                                                    $get_con_code3 = mysqli_query($link, $con_code3);
                                                    while($row_con_code3 = mysqli_fetch_array($get_con_code3, MYSQLI_ASSOC))
                                                    {
                                                ?>
                                                    <option value="<?php echo $row_con_code3['dial_code']; ?>" <?php if($row_con_code3['dial_code'] == 974){ ?> selected="true" <?php } ?>>
                                                        <?php echo $row_con_code3['dial_code']; ?>
                                                    </option>
                                                <?php } ?>
                                                </select>
                                                <input type="tel" class="form-control" name="workPhoneNum" placeholder="Enter your work phone number 974xxxxxxx">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Qatar ID</label>
                                            <input type="text" class="form-control" name="qatarId" placeholder="Enter your Qatar ID">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Customer Category</label>
                                            <input type="text" class="form-control" name="cust_category" placeholder="Customer category">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" name="address1" placeholder="Enter your address line 1">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" name="address2" placeholder="Enter your address line 2">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Address Line 3</label>
                                            <input type="text" class="form-control" name="address3" placeholder="Enter your address line 3">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" placeholder="Enter your city">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Zipcode/Zone</label>
                                            <input type="text" class="form-control" name="zip" placeholder="Enter your zipcode/zone">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" id="state" placeholder="Enter your state">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Country</label>
                                            <select class="form-control w-auto mr-3" name="country">
                                                <?php
                                                    $con_select = "select distinct(name) from countries order by name asc";
                                                    $get_con_select = mysqli_query($link, $con_select);
                                                    while($row_con_select = mysqli_fetch_array($get_con_select, MYSQLI_ASSOC))
                                                    {
                                                ?>
                                                    <option value="<?php echo $row_con_select['name']; ?>" <?php if($row_con_select['name'] == 'Qatar'){ ?> selected="true" <?php } ?>>
                                                        <?php echo $row_con_select['name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-12">
                                            <span>Health Details</span>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Do you have skin allergies?</label>
                                            <select class="form-control" name="skin_allergy">
                                                <option value="">--Select --</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Do you have back problem?</label>
                                            <select class="form-control" name="back_problem">
                                                <option value="">--Select --</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Blood Pressure</label>
                                            <select class="form-control" name="blood_pressure">
                                                <option value="">--Select --</option>
                                                <option value="Low">Low</option>
                                                <option value="Normal">Normal</option>
                                                <option value="High">High</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col-12">
                                            <span>Other Details</span>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 form-group">
                                            <label>How did you hear about us?</label>
                                            <select class="form-control" name="hear_ab_us">
                                                <option value="">--Select --</option>
                                                <option value="Word of mouth">Word of mouth</option>
                                                <option value="Referral">Referral</option>
                                                <option value="Program">Program</option>
                                                <option value="SMS">SMS</option>
                                                <option value="Walk in">Walk in</option>
                                                <option value="Social media">Social media</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Others</label>
                                            <textarea class="form-control" name="others" placeholder="Enter other details" style="height: 15vh;"></textarea>
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
                                                    <td style="padding: 0 !important;">
                                                        <div class="d-flex justify-content-center align-items-end" style="height: 120% !important;">
                                                        <button class="btn btn-danger btn-icon delete-service-button">
                                                                <i class="fas fa-trash"></i>
                                                        </button> 
                                                        </div>
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

        $("body").on("click", ".delete-service-button", function () {
            $(this).parents("tr").remove();
        })
    </script>
</body>
</html>