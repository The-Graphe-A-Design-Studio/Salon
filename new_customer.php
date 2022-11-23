<?php
    include('dbcon.php');

    $firstName = $lastName = $phone = $whatsapp = $email = $bday_date = $bday_month = $bday_year = $aday_date = $aday_month = $aday_year = $workPhoneNum = null;
    $qatarId = $cust_category = $address1 = $address2 = $address3 = $city = $zip = $state = $country = $skin_allergy = $back_problem = $blood_pressure = null;
    $hear_ab_us = $others = null;

    $con_phone = $con_whatsapp = $con_work_phone = 974;

    $country = 'Qatar';

    $firstName_err = $lastName_err = $phone_err = $whatsapp_err = $email_err = $bday_date_err = $bday_month_err = $bday_year_err = $aday_date_err = null;
    $aday_month_err = $aday_year_err = $workPhoneNum_err = $qatarId_err = $cust_category_err = $address1_err = $address2_err = $address3_err = null;
    $city_err = $zip_err = $state_err = $country_err = $skin_allergy_err = $back_problem_err = $blood_pressure_err = $hear_ab_us_err = $others_err = null;    

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Required fields
            if(empty(trim($_POST["firstName"])))
            {
                $firstName_err = "Please enter your first name.";
            }
            else
            {
                $firstName = trim($_POST["firstName"]);
            }

            if(empty(trim($_POST["lastName"])))
            {
                $lastName_err = "Please enter your last name.";
            }
            else
            {
                $lastName = trim($_POST["lastName"]);
            }

            if(empty(trim($_POST["phone"])))
            {
                $phone_err = "Please enter your phone number.";
            }
            else
            {
                $phone = trim($_POST["phone"]);

                $sqlp = "SELECT * FROM cust_name_phone where cust_phone = '$phone'";
                $checkp = mysqli_query($link, $sqlp);
                $rowp = mysqli_fetch_array($checkp, MYSQLI_ASSOC);
                $count = mysqli_num_rows($checkp);
                if($count >= 1)
                {
                    $phone_err = "This phone number is already registered.";
                }
                else
                {
                    $phone = trim($_POST["phone"]);
                }
            }

            if(empty(trim($_POST["whatsapp"])))
            {
                $whatsapp_err = "Please enter your whatsapp number.";
            }
            else
            {
                $whatsapp = trim($_POST["whatsapp"]);

                $sqlw = "SELECT * FROM cust_name_phone where whatsapp_num = '$whatsapp'";
                $checkw = mysqli_query($link, $sqlw);
                $roww = mysqli_fetch_array($checkw, MYSQLI_ASSOC);
                $count = mysqli_num_rows($checkw);
                if($count >= 1)
                {
                    $whatsapp_err = "This whatsapp number is already registered.";
                }
                else
                {
                    $whatsapp = trim($_POST["whatsapp"]);
                }
            }

            // Birthday
            if($_POST["bday_date"] === '' && !empty(trim($_POST["bday_month"])))
            {
                $bday_date_err = "Please select birthday date.";
            }
            else
            {
                $bday_date = trim($_POST["bday_date"]);
            }

            if(!empty(trim($_POST["bday_date"])) && $_POST["bday_month"] === '')
            {
                $bday_month_err = "Please select birthday month.";
            }
            else
            {
                $bday_month = trim($_POST["bday_month"]);
            }

            if(!empty(trim($_POST["bday_year"])) && $_POST["bday_month"] === '')
            {
                $bday_year_err = "Please select birthday date & month also.";
            }
            else
            {
                $bday_year = trim($_POST["bday_year"]);
            }

            if(!empty(trim($_POST["bday_year"])) && $_POST["bday_date"] === '')
            {
                $bday_year_err = "Please select birthday date & month also.";
            }
            else
            {
                $bday_year = trim($_POST["bday_year"]);
            }

            // Anniversary
            if($_POST["aday_date"] === '' && !empty(trim($_POST["aday_month"])))
            {
                $aday_date_err = "Please select anniversary date.";
            }
            else
            {
                $aday_date = trim($_POST["aday_date"]);
            }

            if(!empty(trim($_POST["aday_date"])) && $_POST["aday_month"] === '')
            {
                $aday_month_err = "Please select anniversary month.";
            }
            else
            {
                $aday_month = trim($_POST["aday_month"]);
            }

            if(!empty(trim($_POST["aday_year"])) && $_POST["aday_month"] === '')
            {
                $aday_year_err = "Please select anniversary date & month also.";
            }
            else
            {
                $aday_year = trim($_POST["aday_year"]);
            }

            if(!empty(trim($_POST["aday_year"])) && $_POST["aday_date"] === '')
            {
                $aday_year_err = "Please select anniversary date & month also.";
            }
            else
            {
                $aday_year = trim($_POST["aday_year"]);
            }
        // End required fields

        // Not required fields
            $con_phone = $_POST['con_phone'] ? : 974;
            $con_whatsapp = $_POST['con_whatsapp'] ? : 974;
            $email = trim($_POST['email'] ? : null);
            $bday_date = trim($_POST['bday_date'] ? : null);
            $bday_month = trim($_POST['bday_month'] ? : null);
            $bday_year = trim($_POST['bday_year'] ? : null);
            $aday_date = trim($_POST['aday_date'] ? : null);
            $aday_month = trim($_POST['aday_month'] ? : null);
            $aday_year = trim($_POST['aday_year'] ? : null);
            $con_work_phone = $_POST['con_work_phone'] ? : 974;
            $workPhoneNum = trim($_POST['workPhoneNum'] ? : null);
            $qatarId = trim($_POST['qatarId'] ? : null);
            $cust_category = trim($_POST['cust_category'] ? : null);
            $address1 = trim($_POST['address1'] ? : null);
            $address2 = trim($_POST['address2'] ? : null);
            $address3 = trim($_POST['address3'] ? : null);
            $city = trim($_POST['city'] ? : null);
            $zip = trim($_POST['zip'] ? : null);
            $state = trim($_POST['state'] ? : null);
            $country = trim($_POST['country'] ? : null);
            $skin_allergy = trim($_POST['skin_allergy'] ? : null);
            $back_problem = trim($_POST['back_problem'] ? : null);
            $blood_pressure = trim($_POST['blood_pressure'] ? : null);
            $hear_ab_us = trim($_POST['hear_ab_us'] ? : null);
            $others = trim($_POST['others'] ? : null);
        // End not required fields

        if(empty($firstName_err) && empty($lastName_err) && empty($phone_err) && empty($whatsapp_err) && empty($bday_date_err)
        && empty($bday_month_err) && empty($bday_year_err) && empty($aday_date_err) && empty($aday_month_err) && empty($aday_year_err))
        {
            $cust_category = mysqli_real_escape_string($link, $cust_category);
            $address1 = mysqli_real_escape_string($link, $address1);
            $address2 = mysqli_real_escape_string($link, $address2);
            $address3 = mysqli_real_escape_string($link, $address3);
            $city = mysqli_real_escape_string($link, $city);
            $zip = mysqli_real_escape_string($link, $zip);
            $state = mysqli_real_escape_string($link, $state);
            $country = mysqli_real_escape_string($link, $country);
            $others = mysqli_real_escape_string($link, $others);

            if(!empty($bday_date) && !empty($bday_month))
            {
                if(empty($bday_year))
                {
                    $bday = date_format(date_create($bday_date."-".$bday_month."-1994"), 'd M');
                }
                else
                {
                    $bday = date_format(date_create($bday_date."-".$bday_month."-".$bday_year), 'd M, Y');
                }
            }

            if(!empty($aday_date) && !empty($aday_month))
            {
                if(empty($aday_year))
                {
                    $aday = date_format(date_create($aday_date."-".$aday_month."-1994"), 'd M');
                }
                else
                {
                    $aday = date_format(date_create($aday_date."-".$aday_month."-".$aday_year), 'd M, Y');
                }
            }

            $sql = "insert into cust_name_phone (`cust_name`, `last_name`, `con_cust_phone`, `cust_phone`, `con_whatsapp_num`, `whatsapp_num`, `email`, 
                    `birthday`, `anniversary`, `con_work_phone`, `work_phone`, `qatar_id`, `cust_category`, `address_1`, `address_2`, `address_3`, `city`, 
                    `zip`, `state`, `country`, `skin_allergy`, `back_problem`, `blood_pressure`, `hear_ab_us`, `others`) values ('$firstName', '$lastName', 
                    '$con_phone', '$phone', '$con_whatsapp', '$whatsapp', '$email', '$bday', '$aday', '$con_work_phone', '$workPhoneNum', '$qatarId', 
                    '$cust_category', '$address1', '$address2', '$address3', '$city', '$zip', '$state', '$country', '$skin_allergy', '$back_problem', 
                    '$blood_pressure', '$hear_ab_us', '$others')";

            $done = mysqli_query($link, $sql);

            if($done)
            {
                header('location: thankyou');
            }
            else
            {
                echo "<script>alert('Something went wrong.');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>New Customer | diva lounge spa</title>
        <link rel="icon" href="assets/img/diva-logo-sm.png" type="image/gif" sizes="32x32">
        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Template CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/components.css">
        <link rel="stylesheet" href="assets/css/google.css">
        <style>
            .has-error .error-msg{
                margin-top: 5px !important;
                color: red !important;
            }

            .has-error input, .has-error select{
                border: 1px solid red !important;
            }            
        </style>
    </head>
    <body>

        <div id="app">
            <section class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="login-brand mt-5">
                                    <img src="assets/img/diva-logo.png" alt="diva lounge spa logo" width="320">
                                </div>
                                <div class="card-header text-center" style="width: unset !important">
                                    <h3 class="card-title">New Customer</h3>
                                </div>
                                <div class="card-body">
                                    <div class="container m-0 p-0">
                                        <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="row my-1">
                                                <div class="col-12">
                                                    <span>Basic Details</span>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 form-group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
                                                    <label>First Name *</label>
                                                    <input type="text" class="form-control" name="firstName" 
                                                    placeholder="Enter your first name" value="<?php echo $firstName; ?>">
                                                    <span class="error-msg"><?php echo $firstName_err; ?></span>
                                                </div>
                                                <div class="col-12 col-md-6 form-group <?php echo (!empty($lastName_err)) ? 'has-error' : ''; ?>">
                                                    <label>Last Name *</label>
                                                    <input type="text" class="form-control" name="lastName" value="<?php echo $lastName; ?>" placeholder="Enter your last name">
                                                    <span class="error-msg"><?php echo $lastName_err; ?></span>
                                                </div>
                                                <div class="col-12 col-md-6 form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                                                    <label>Phone Num *</label>
                                                    <div class="d-flex">
                                                        <select class="form-control w-auto mr-3" name="con_phone">
                                                        <?php
                                                            $con_code1 = "select distinct(dial_code) from countries order by dial_code asc";
                                                            $get_con_code1 = mysqli_query($link, $con_code1);
                                                            while($row_con_code1 = mysqli_fetch_array($get_con_code1, MYSQLI_ASSOC))
                                                            {
                                                        ?>
                                                            <option value="<?php echo $row_con_code1['dial_code']; ?>" <?php if($row_con_code1['dial_code'] == $con_phone){ ?> selected="true" <?php } ?>>
                                                                <?php echo $row_con_code1['dial_code']; ?>
                                                            </option>
                                                        <?php } ?>
                                                        </select>
                                                        <input type="tel" class="form-control w-100" name="phone" value="<?php echo $phone; ?>" placeholder="Enter your phone number 974xxxxxxx">
                                                    </div>                                                    
                                                    <span class="error-msg"><?php echo $phone_err; ?></span>
                                                </div>
                                                <div class="col-12 col-md-6 form-group <?php echo (!empty($whatsapp_err)) ? 'has-error' : ''; ?>">
                                                    <label>Whatsapp Num *</label>
                                                    <div class="d-flex">
                                                        <select class="form-control w-auto mr-3" name="con_whatsapp">
                                                        <?php
                                                            $con_code2 = "select distinct(dial_code) from countries order by dial_code asc";
                                                            $get_con_code2 = mysqli_query($link, $con_code2);
                                                            while($row_con_code2 = mysqli_fetch_array($get_con_code2, MYSQLI_ASSOC))
                                                            {
                                                        ?>
                                                            <option value="<?php echo $row_con_code2['dial_code']; ?>" <?php if($row_con_code2['dial_code'] == $con_whatsapp){ ?> selected="true" <?php } ?>>
                                                                <?php echo $row_con_code2['dial_code']; ?>
                                                            </option>
                                                        <?php } ?>
                                                        </select>
                                                        <input type="tel" class="form-control w-100" name="whatsapp" value="<?php echo $whatsapp; ?>" placeholder="Enter your whatsapp number 974xxxxxxx">
                                                    </div>
                                                    <span class="error-msg"><?php echo $whatsapp_err; ?></span>
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
                                                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Enter your email address">
                                                </div>
                                                <div class="col-12 col-md-4 form-group <?php echo (!empty($bday_date_err)) ? ' has-error' : ''; 
                                                                                                      echo (!empty($bday_month_err)) ? ' has-error' : '';
                                                                                                      echo (!empty($bday_year_err)) ? ' has-error' : ''; ?>">
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
                                                                        if($i == $bday_date)
                                                                        {
                                                                    ?>
                                                                        selected
                                                                    <?php
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
                                                                        if($i == $bday_month)
                                                                        {
                                                                    ?>
                                                                        selected
                                                                    <?php
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
                                                                        if($i == $bday_year)
                                                                        {
                                                                    ?>
                                                                        selected
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                ><?php echo $i; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>                                                        
                                                    </div>
                                                    <span class="error-msg"><?php echo $bday_date_err; ?></span>
                                                    <span class="error-msg"><?php echo $bday_month_err; ?></span>
                                                    <span class="error-msg"><?php echo $bday_year_err; ?></span>
                                                </div>
                                                <div class="col-12 col-md-4 form-group <?php echo (!empty($aday_date_err)) ? ' has-error' : ''; 
                                                                                                      echo (!empty($aday_month_err)) ? ' has-error' : '';
                                                                                                      echo (!empty($aday_year_err)) ? ' has-error' : ''; ?>">
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
                                                                        if($i == $aday_date)
                                                                        {
                                                                    ?>
                                                                        selected
                                                                    <?php
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
                                                                        if($i == $aday_month)
                                                                        {
                                                                    ?>
                                                                        selected
                                                                    <?php
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
                                                                        if($i == $aday_year)
                                                                        {
                                                                    ?>
                                                                        selected
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                ><?php echo $i; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>                                                        
                                                    </div>
                                                    <span class="error-msg"><?php echo $aday_date_err; ?></span>
                                                    <span class="error-msg"><?php echo $aday_month_err; ?></span>
                                                    <span class="error-msg"><?php echo $aday_year_err; ?></span>
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
                                                            <option value="<?php echo $row_con_code3['dial_code']; ?>" <?php if($row_con_code3['dial_code'] == $con_work_phone){ ?> selected="true" <?php } ?>>
                                                                <?php echo $row_con_code3['dial_code']; ?>
                                                            </option>
                                                        <?php } ?>
                                                        </select>
                                                        <input type="tel" class="form-control" name="workPhoneNum" value="<?php echo $workPhoneNum; ?>" placeholder="Enter your work phone number 974xxxxxxx">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>Qatar ID</label>
                                                    <input type="text" class="form-control" name="qatarId" value="<?php echo $qatarId; ?>" placeholder="Enter your Qatar ID">
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>Customer Category</label>
                                                    <input type="text" class="form-control" name="cust_category" value="<?php echo $cust_category; ?>" placeholder="Customer category">
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>Address Line 1</label>
                                                    <input type="text" class="form-control" name="address1" value="<?php echo $address1; ?>" placeholder="Enter your address line 1">
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>Address Line 2</label>
                                                    <input type="text" class="form-control" name="address2" value="<?php echo $address2; ?>" placeholder="Enter your address line 2">
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>Address Line 3</label>
                                                    <input type="text" class="form-control" name="address3" value="<?php echo $address3; ?>" placeholder="Enter your address line 3">
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" placeholder="Enter your city">
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>Zipcode/Zone</label>
                                                    <input type="text" class="form-control" name="zip" value="<?php echo $zip; ?>" placeholder="Enter your zipcode/zone">
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="state" id="state" value="<?php echo $state; ?>" placeholder="Enter your state">
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
                                                            <option value="<?php echo $row_con_select['name']; ?>" <?php if($row_con_select['name'] == $country){ ?> selected="true" <?php } ?>>
                                                                <?php echo $row_con_select['name']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <!-- <input type="text" class="form-control" name="country" id="country" value="<?php echo $country; ?>" placeholder="Enter your country"> -->
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
                                                        <option value="Yes" <?php if($skin_allergy === 'Yes') { ?> selected <?php } ?>>Yes</option>
                                                        <option value="No" <?php if($skin_allergy === 'No') { ?> selected <?php } ?>>No</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>Do you have back problem?</label>
                                                    <select class="form-control" name="back_problem">
                                                        <option value="">--Select --</option>
                                                        <option value="Yes" <?php if($back_problem === 'Yes') { ?> selected <?php } ?>>Yes</option>
                                                        <option value="No" <?php if($back_problem === 'No') { ?> selected <?php } ?>>No</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4 form-group">
                                                    <label>Blood Pressure</label>
                                                    <select class="form-control" name="blood_pressure">
                                                        <option value="">--Select --</option>
                                                        <option value="Low" <?php if($blood_pressure === 'Low') { ?> selected <?php } ?>>Low</option>
                                                        <option value="Normal" <?php if($blood_pressure === 'Normal') { ?> selected <?php } ?>>Normal</option>
                                                        <option value="High" <?php if($blood_pressure === 'High') { ?> selected <?php } ?>>High</option>
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
                                                        <option value="Word of mouth" <?php if($hear_ab_us === 'Word of mouth') { ?> selected <?php } ?>>Word of mouth</option>
                                                        <option value="Referral" <?php if($hear_ab_us === 'Referral') { ?> selected <?php } ?>>Referral</option>
                                                        <option value="Program" <?php if($hear_ab_us === 'Program') { ?> selected <?php } ?>>Program</option>
                                                        <option value="SMS" <?php if($hear_ab_us === 'SMS') { ?> selected <?php } ?>>SMS</option>
                                                        <option value="Walk in" <?php if($hear_ab_us === 'Walk in') { ?> selected <?php } ?>>Walk in</option>
                                                        <option value="Social media" <?php if($hear_ab_us === 'Social media') { ?> selected <?php } ?>>Social media</option>
                                                        <option value="Other" <?php if($hear_ab_us === 'Other') { ?> selected <?php } ?>>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label>Others</label>
                                                    <textarea class="form-control" name="others" value="<?php echo $others; ?>" placeholder="Enter other details" style="height: 15vh;"></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="confirmCheck" style="position: unset !important;">
                                                        <label class="form-check-label ml-3" for="confirmCheck">
                                                            I hereby confirm that the above information to my knowledege is correct.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer mt-2 text-center">
                                                <button type="submit" id="submitBtn" class="btn btn-primary btn-lg" disabled>Submit</button>
                                            </div>                                            
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="gt">
                                <div class="gt__box">
                                    <div class="gt__select">
                                        <div id="google_translate_element"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="simple-footer">
                                Copyright &copy; <script>document.write(new Date().getFullYear());</script> Diva Lounge Spa
                                <br>
                                Designed by <a href="https://tecizasolutions.com/" target="_blank">Teciza Solution</a> & 
                                Powered by <a href="https://thegraphe.com" target="_blank">The Graphē - A Design Studio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        
        <!-- Google Translater -->
        <script src="assets/js/google.js"></script>

        <script>
            $(document).ready(function () {
                $('#confirmCheck').click(function () {
                    $('#submitBtn').prop("disabled", !$("#confirmCheck").prop("checked")); 
                })
            });
        </script>
    
    </body>
</html>