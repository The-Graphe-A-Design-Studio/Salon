<?php
    include('../dbcon.php');

    $cust_code = $_GET['cust'];
    $cust_id = $_GET['id'];

    $customer = "select * from customers where c_id = '$cust_id' and c_code = '$cust_code'";
    $get = mysqli_query($link, $customer);
    $row = mysqli_fetch_array($get, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Feedback Form | diva lounge spa</title>
        <link rel="icon" href="../assets/img/diva-logo-sm.png" type="image/gif" sizes="32x32">
        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Template CSS -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/components.css">
        <link rel="stylesheet" href="../assets/css/google.css">

        <style>
            a
            {
                text-decoration: none !important;
            }

            .rating {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 50px;
            }

            .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
            }

            .rating label:last-child {
            position: static;
            }

            .rating label:nth-child(1) {
            z-index: 5;
            }

            .rating label:nth-child(2) {
            z-index: 4;
            }

            .rating label:nth-child(3) {
            z-index: 3;
            }

            .rating label:nth-child(4) {
            z-index: 2;
            }

            .rating label:nth-child(5) {
            z-index: 1;
            }

            .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            }

            .rating label .icon {
            float: left;
            color: transparent;
            }

            .rating label:last-child .icon {
            color: #cae1ad;
            }

            .rating:not(:hover) label input:checked ~ .icon,
            .rating:hover label:hover input ~ .icon {
            color: #81be41;
            }

            .rating label input:focus:not(:checked) ~ .icon:last-child {
            color: #cae1ad;
            text-shadow: 0 0 5px #cae1ad;
            }
        </style>
    </head>
    <body>

        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="login-brand">
                                <img src="../assets/img/diva-logo.png" alt="diva lounge spa logo" width="350">
                            </div>

                            <div class="card">
                                <div class="card-header text-center" style="width: unset !important">
                                    <h4 class="card-title">Feedback Form</h4>
                                </div>
                                <div class="card-body text-center">
                                    <h4><?php echo $row['c_name']; ?></h4>
                                    <a href="" class="card-link"><?php echo $row['c_email']; ?></a>
                                    <a href="" class="card-link"><?php echo $row['c_phone']; ?></a>
                                </div>
                            </div>
                            <div class="card">
                                <form class="feedback">
                                    <?php
                                        $i = 1;
                                        $data = "select * from review_form where c_id = '$cust_id'";
                                        $get_data = mysqli_query($link, $data);
                                        while($row_data = mysqli_fetch_array($get_data, MYSQLI_ASSOC))
                                        {
                                            $services[] = $row_data;
                                        }
                                        foreach($services as $service)
                                        {
                                            $se = "select * from services where se_id = '".$service['se_id']."'";
                                            $get_se = mysqli_query($link, $se);
                                            $row_se = mysqli_fetch_array($get_se, MYSQLI_ASSOC);

                                            $st = "select * from staffs where st_id = '".$service['st_id']."'";
                                            $get_st = mysqli_query($link, $st);
                                            $row_st = mysqli_fetch_array($get_st, MYSQLI_ASSOC);
                                    ?>
                                    <div class="card-body">
                                        <div class="section-title mt-0"><?php echo $row_se['se_name']; ?></div>
                                        <div class="form-group">
                                            <div class="rating text-center">
                                                <label>
                                                    <input type="radio" name="stars<?php echo $i; ?>" value="1" />
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="stars<?php echo $i; ?>" value="2" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="stars<?php echo $i; ?>" value="3" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>   
                                                </label>
                                                <label>
                                                    <input type="radio" name="stars<?php echo $i; ?>" value="4" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                                <label>
                                                    <input type="radio" name="stars<?php echo $i; ?>" value="5" />
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                    <span class="icon">★</span>
                                                </label>
                                            </div>
                                            <label>Service by <?php echo $row_st['st_name']; ?></label>
                                        </div>
                                        <input type="text" value="<?php echo $service['re_id']; ?>" name="review_id<?php echo $i; ?>" hidden>
                                    </div>
                                    <?php
                                            $i++;
                                        }
                                    ?>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <textarea name="cust_comment" id="" cols="30" rows="5" style="width: 100%"></textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <input type="text" value="<?php echo $i - 1; ?>" name="total_count" hidden>
                                        <input type="text" value="<?php echo $cust_id; ?>" name="cust_id" hidden>
                                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                    </div>
                                </form>
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
                                Developed by <a href="https://thegraphe.com" target="_blank">The Graphē - A Design Studio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        
        <!-- Google Translater -->
        <script src="../assets/js/google.js"></script>

        <script type="text/javascript">
            $(".feedback").submit(function(e)
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
                        button_content.removeClass("disabled btn-progress");
                        if(data === "Feedback Submited")
                        {
                            location.href="thankyou";
                        }
                    }
                });
                e.preventDefault();
            });
        </script>

    </body>
</html>