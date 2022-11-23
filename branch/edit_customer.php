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
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" value="<?php echo $row['']; ?>" value="<?php echo $row['']; ?>" name="viewport">
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
                                            <input type="text" class="form-control" value="<?php echo $row['cust_name']; ?>" name="firstName" placeholder="Enter your first name">
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" value="<?php echo $row['last_name']; ?>" name="lastName" placeholder="Enter your last name">
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Phone Num *</label>
                                            <div class="d-flex">
                                                <select class="form-control w-auto mr-3" value="<?php echo $row['con_cust_phone']; ?>" name="con_phone">
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
                                                <input type="tel" class="form-control w-100" value="<?php echo $row['cust_phone']; ?>" name="phone" placeholder="Enter your phone number 974xxxxxxx">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <label>Whatsapp Num *</label>
                                            <div class="d-flex">
                                                <select class="form-control w-auto mr-3" value="<?php echo $row['con_whatsapp_num']; ?>" name="con_whatsapp">
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
                                                <input type="tel" class="form-control w-100" value="<?php echo $row['whatsapp_num']; ?>" name="whatsapp" placeholder="Enter your whatsapp number 974xxxxxxx">
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
                                            <input type="email" class="form-control" value="<?php echo $row['email']; ?>" name="email" placeholder="Enter your email address">
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
                                                        <option value="<?php echo date_format(date_create($i."-08-1994"), 'd'); ?>"
                                                            <?php
                                                                if(!empty($row['birthday']))
                                                                {
                                                                    if($i == date_format(date_create($row['birthday']), 'd'))
                                                                    {
                                                                ?>
                                                                    selected
                                                                <?php
                                                                    }
                                                                }
                                                            ?>
                                                        >
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
                                                        <option value="<?php echo date_format(date_create("01-".$i."-1994"), 'm'); ?>"
                                                            <?php
                                                                if(!empty($row['birthday']))
                                                                {
                                                                    if($i == date_format(date_create($row['birthday']), 'm'))
                                                                    {
                                                                ?>
                                                                    selected
                                                                <?php
                                                                    }
                                                                }
                                                            ?>
                                                        >
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
                                                        <option value="<?php echo $i; ?>"
                                                            <?php
                                                                if(!empty($row['birthday']))
                                                                {
                                                                    $yr = date_format(date_create($row['birthday']), 'Y');
                                                                    if($yr == date('Y'))
                                                                    {
                                                                        $yr = null;
                                                                    }
                                                                    if($i == $yr)
                                                                    {
                                                                ?>
                                                                    selected
                                                                <?php
                                                                    }
                                                                }
                                                            ?>
                                                        ><?php echo $i; ?></option>
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
                                                        <option value="<?php echo date_format(date_create($i."-08-1994"), 'd'); ?>"
                                                            <?php
                                                            if(!empty($row['anniversary']))
                                                            {
                                                                if($i == date_format(date_create($row['anniversary']), 'd'))
                                                                {
                                                            ?>
                                                                selected
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        >
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
                                                        <option value="<?php echo date_format(date_create("01-".$i."-1994"), 'm'); ?>"
                                                            <?php
                                                            if(!empty($row['anniversary']))
                                                            {
                                                                if($i == date_format(date_create($row['anniversary']), 'm'))
                                                                {
                                                            ?>
                                                                selected
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        >
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
                                                        <option value="<?php echo $i; ?>"
                                                            <?php
                                                                if(!empty($row['anniversary']))
                                                                {
                                                                    $yr2 = date_format(date_create($row['anniversary']), 'Y');
                                                                    if($yr2 == date('Y'))
                                                                    {
                                                                        $yr2 = null;
                                                                    }
                                                                    if($i == $yr2)
                                                                    {
                                                            ?>
                                                                selected
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        ><?php echo $i; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Work Phone Num</label>
                                            <div class="d-flex">
                                                <select class="form-control w-auto mr-3" value="<?php echo $row['con_work_phone']; ?>" name="con_work_phone">
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
                                                <input type="tel" class="form-control" value="<?php echo $row['work_phone']; ?>" name="workPhoneNum" placeholder="Enter your work phone number 974xxxxxxx">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Qatar ID</label>
                                            <input type="text" class="form-control" value="<?php echo $row['qatar_id']; ?>" name="qatarId" placeholder="Enter your Qatar ID">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Customer Category</label>
                                            <input type="text" class="form-control" value="<?php echo $row['cust_category']; ?>" name="cust_category" placeholder="Customer category">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" value="<?php echo $row['address_1']; ?>" name="address1" placeholder="Enter your address line 1">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" value="<?php echo $row['address_2']; ?>" name="address2" placeholder="Enter your address line 2">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Address Line 3</label>
                                            <input type="text" class="form-control" value="<?php echo $row['address_3']; ?>" name="address3" placeholder="Enter your address line 3">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" value="<?php echo $row['city']; ?>" name="city" placeholder="Enter your city">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Zipcode/Zone</label>
                                            <input type="text" class="form-control" value="<?php echo $row['zip']; ?>" name="zip" placeholder="Enter your zipcode/zone">
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" value="<?php echo $row['state']; ?>" name="state" id="state" placeholder="Enter your state">
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
                                                    <option value="<?php echo $row_con_select['name']; ?>" <?php if($row_con_select['name'] == $row['country']){ ?> selected="true" <?php } ?>>
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
                                                <option value="Yes" <?php if($row['skin_allergy'] == 'Yes'){ ?> selected="true" <?php } ?>>Yes</option>
                                                <option value="No" <?php if($row['skin_allergy'] == 'No'){ ?> selected="true" <?php } ?>>No</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Do you have back problem?</label>
                                            <select class="form-control" name="back_problem">
                                                <option value="">--Select --</option>
                                                <option value="Yes" <?php if($row['back_problem'] == 'Yes'){ ?> selected="true" <?php } ?>>Yes</option>
                                                <option value="No" <?php if($row['back_problem'] == 'No'){ ?> selected="true" <?php } ?>>No</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 form-group">
                                            <label>Blood Pressure</label>
                                            <select class="form-control" name="blood_pressure">
                                                <option value="">--Select --</option>
                                                <option value="Low" <?php if($row['blood_pressure'] == 'Low'){ ?> selected="true" <?php } ?>>Low</option>
                                                <option value="Normal" <?php if($row['blood_pressure'] == 'Normal'){ ?> selected="true" <?php } ?>>Normal</option>
                                                <option value="High" <?php if($row['blood_pressure'] == 'High'){ ?> selected="true" <?php } ?>>High</option>
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
                                                <option value="Word of mouth" <?php if($row['hear_ab_us'] == 'Word of mouth'){ ?> selected="true" <?php } ?>>Word of mouth</option>
                                                <option value="Referral" <?php if($row['hear_ab_us'] == 'Referral'){ ?> selected="true" <?php } ?>>Referral</option>
                                                <option value="Program" <?php if($row['hear_ab_us'] == 'Program'){ ?> selected="true" <?php } ?>>Program</option>
                                                <option value="SMS" <?php if($row['hear_ab_us'] == 'SMS'){ ?> selected="true" <?php } ?>>SMS</option>
                                                <option value="Walk in" <?php if($row['hear_ab_us'] == 'Walk in'){ ?> selected="true" <?php } ?>>Walk in</option>
                                                <option value="Social media" <?php if($row['hear_ab_us'] == 'Social media'){ ?> selected="true" <?php } ?>>Social media</option>
                                                <option value="Other" <?php if($row['hear_ab_us'] == 'Other'){ ?> selected="true" <?php } ?>>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label>Others</label>
                                            <textarea class="form-control" name="others" placeholder="Enter other details" style="height: 15vh;"><?php echo $row['others']; ?></textarea>
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
                            location.reload();
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