<?php
    include('dbcon.php');

    $firstName = $lastName = $phone = $whatsapp = $email = $bday = $aday = $workPhoneNum = null;
    $qatarId = $address1 = $address2 = $city = $zip = $state = $country = $others = null;

    $firstName_err = $lastName_err = $phone_err = $whatsapp_err = $email_err = $bday_err = $aday_err = $workPhoneNum_err = null;
    $qatarId_err = $address1_err = $address2_err = $city_err = $zip_err = $state_err = $country_err = $others_err = null;

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // fields
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
        // End fields

        // Not fields
            $email = trim($_POST['email'] ? : null);
            if($_POST['bday'] == '0000-00-00'){ $bday = null; }else{ $bday = $_POST['bday']; };
            if($_POST['aday'] == '0000-00-00'){ $aday = null; }else{ $aday = $_POST['aday']; };
            $workPhoneNum = trim($_POST['workPhoneNum'] ? : null);
            $qatarId = trim($_POST['qatarId'] ? : null);
            $address1 = trim($_POST['address1'] ? : null);
            $address2 = trim($_POST['address2'] ? : null);
            $city = trim($_POST['city'] ? : null);
            $zip = trim($_POST['zip'] ? : null);
            $state = trim($_POST['state'] ? : null);
            $country = trim($_POST['country'] ? : null);
            $others = trim($_POST['others'] ? : null);
        // End not fields

        if(empty($firstName_err) && empty($lastName_err) && empty($phone_err) && empty($whatsapp_err))
        {
            $address1 = mysqli_real_escape_string($link, $address1);
            $address2 = mysqli_real_escape_string($link, $address2);
            $city = mysqli_real_escape_string($link, $city);
            $zip = mysqli_real_escape_string($link, $zip);
            $state = mysqli_real_escape_string($link, $state);
            $country = mysqli_real_escape_string($link, $country);
            $others = mysqli_real_escape_string($link, $others);

            $sql = "insert into cust_name_phone (`cust_name`, `last_name`, `cust_phone`, `whatsapp_num`, `email`, `birthday`, `anniversary`,
                    `work_phone`, `qatar_id`, `address_1`, `address_2`, `city`, `zip`, `state`, `country`, `others`) values ('$firstName', '$lastName', 
                    '$phone', '$whatsapp', '$email', '$bday', '$aday', '$workPhoneNum', '$qatarId', '$address1', '$address2', '$city', '$zip', '$state', 
                    '$country', '$others')";

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
                                    <div class="container">
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
                                                    <input type="tel" class="form-control" name="phone" value="<?php echo $phone; ?>" placeholder="Enter your phone number 974xxxxxxx">
                                                    <span class="error-msg"><?php echo $phone_err; ?></span>
                                                </div>
                                                <div class="col-12 col-md-6 form-group <?php echo (!empty($whatsapp_err)) ? 'has-error' : ''; ?>">
                                                    <label>Whatsapp Num *</label>
                                                    <input type="tel" class="form-control" name="whatsapp" value="<?php echo $whatsapp; ?>" placeholder="Enter your whatsapp number 974xxxxxxx">
                                                    <span class="error-msg"><?php echo $whatsapp_err; ?></span>
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
                                                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Enter your email address">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>Birthday</label>
                                                    <input type="date" class="form-control" name="bday" value="<?php echo $bday; ?>" placeholder="Enter your birthday">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>Anniversary</label>
                                                    <input type="date" class="form-control" name="aday" value="<?php echo $aday; ?>" placeholder="Enter your anniversary">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>Work Phone Num</label>
                                                    <input type="tel" class="form-control" name="workPhoneNum" value="<?php echo $workPhoneNum; ?>" placeholder="Enter your work phone number 974xxxxxxx">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>Qatar ID</label>
                                                    <input type="text" class="form-control" name="qatarId" value="<?php echo $qatarId; ?>" placeholder="Enter your Qatar ID">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>Address Line 1</label>
                                                    <input type="text" class="form-control" name="address1" value="<?php echo $address1; ?>" placeholder="Enter your address line 1">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>Address Line 2</label>
                                                    <input type="text" class="form-control" name="address2" value="<?php echo $address2; ?>" placeholder="Enter your address line 2">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" placeholder="Enter your city">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>Zipcode/Zone</label>
                                                    <input type="text" class="form-control" name="zip" value="<?php echo $zip; ?>" placeholder="Enter your zipcode/zone">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" name="state" id="state" value="<?php echo $state; ?>" placeholder="Enter your state">
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-3 form-group">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" name="country" id="country" value="<?php echo $country; ?>" placeholder="Enter your country">
                                                </div>                                                                                                
                                                <div class="col-12 form-group">
                                                    <label>Others</label>
                                                    <textarea class="form-control" name="others" value="<?php echo $others; ?>" placeholder="Enter other details" style="height: 15vh;"></textarea>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center">
                                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
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

        <script type="text/javascript">
            $(".feedback").submit(function(e)
            {
                var form_data = $(this).serialize();
                alert(form_data);
                var button_content = $(this).find('button[type=submit]');
                button_content.addClass("disabled btn-progress");
                // $.ajax({
                //     url: 'processing/curd_form.php',
                //     data: form_data,
                //     type: 'POST',
                //     success: function(data)
                //     {
                //         alert(data);
                //         button_content.removeClass("disabled btn-progress");
                //         if(data === "Feedback Submited")
                //         {
                //             location.href="thankyou";
                //         }
                //     }
                // });
                e.preventDefault();
            });
        </script>

    </body>
</html>