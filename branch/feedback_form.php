<?php
    include('../dbcon.php');

    $cust_code = $_GET['cust'];
    $cust_id = $_GET['id'];

    $customer = "select * from customers where c_id = '$cust_id' and c_code = '$cust_code'";
    $get = mysqli_query($link, $customer);
    $row = mysqli_fetch_array($get, MYSQLI_ASSOC);

    if($row['c_status'] == 1)
    {
        header("location: thankyou");
    }

    $branch = "select * from locations where l_id = '".$row['branch_id']."'";
    $get_branch = mysqli_query($link, $branch);
    $row_branch = mysqli_fetch_array($get_branch, MYSQLI_ASSOC);

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
        
        table { 
        width: 100%; 
        border-collapse: collapse; 
        }

        th { 
            background: #a5ce77; 
            color: #f4f6f9; 
            font-weight: bold;
            }

        td, th { 
            padding: 8px; 
            border: 1px solid #a5ce77; 
            text-align: center; 
            font-size: 1.1em;
            }
        .table-caption
        {
            display: none;
        }

        /* 
        Max width before this PARTICULAR table gets nasty
        This query will take effect for any screen smaller than 760px
        and also iPads specifically.
        */
        @media 
        only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px)  {

            table { 
                width: 100%; 
            }

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr { 
                display: block; 
            }
            
            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr { 
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            
            tr { border: 1px solid #ccc; }
            
            td { 
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee; 
                position: relative;
                padding-left: 50%; 
            }

            .copy-td
            {
                padding-left: 0% !important;
            }

            .form-link
            {
                padding-left: 0 !important;
            }

            .table-caption
            {
                display: block;
                text-align: center;
                font-size: 1rem;
                font-weight: bolder;
                letter-spacing: 2px;
                text-transform: uppercase;
                background: #a5ce77;
                color: #fff;
                padding: 1vh;
            }

            td:before { 
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%; 
                padding-right: 10px; 
                white-space: nowrap;
                /* Label the data */
                content: attr(data-column);

                color: #000;
                font-weight: bold;
            }

        }
    </style>
    </head>
    <body>

        <div id="app">
            <section class="section">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="login-brand" style="position: relative;">
                                    <div style="position: absolute; top: 50%; left: 2%;">
                                        <span style="font-size: 0.6rem; letter-spacing: 2px;"><?php echo $row_branch['l_name']; ?></span>
                                    </div>
                                    <div style="position: absolute; top: 50%; right: 2%;">
                                        <span style="font-size: 0.6rem; letter-spacing: 2px;"><?php echo $row['c_date']; ?></span>
                                    </div>
                                </div>
                                <div class="login-brand">
                                    <img src="../assets/img/diva-logo.png" alt="diva lounge spa logo" width="320">
                                </div>
                                <div class="card-header text-center" style="width: unset !important">
                                    <h1 class="card-title">Feedback Form</h1>
                                </div>
                                <p class="text-center" style="padding-left: 3vh; padding-right: 3vh; font-size: 0.9rem">We appreciate your business and we want to make sure we meet your expectations, providing the right treatment 
                                    is very important and we would like to hear your feedback on your Spa experience.</p>
                                <div class="card-body text-center">
                                    <h6>
                                        Customer Name : <?php echo $row['c_name']; ?>
                                        <br>
                                        Customer Email : <?php echo $row['c_email']; ?>
                                        <br>
                                        Customer Contact : <?php echo $row['c_phone']; ?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form class="feedback">
                                        <div class="table-caption">Services</div>
                                        <table>
                                            <thead>
                                                <th>Services</th>
                                                <th>Very Poor</th>
                                                <th>Poor</th>
                                                <th>Average</th>
                                                <th>Very Good</th>
                                                <th>Excellent</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 1;
                                                    $data = "select * from review_form where c_code = '$cust_code'";
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
                                                <tr>
                                                    <td style="padding-left: 1% !important">
                                                        <div class="section-title">
                                                            <?php echo $row_se['se_name']; ?>
                                                            <br>
                                                            <span style="font-size: 0.8em; color: #6c757d;"><b>Service By : </b><?php echo $row_st['st_name']; ?></span>
                                                        </div>
                                                    </td>
                                                    <td data-column="Very Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="stars<?php echo $i; ?>" value="1" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="stars<?php echo $i; ?>" value="2" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Average">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="stars<?php echo $i; ?>" value="3" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Very Good">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="stars<?php echo $i; ?>" value="4" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Excellent">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="stars<?php echo $i; ?>" value="5" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                        <input type="text" value="<?php echo $service['re_id']; ?>" name="review_id<?php echo $i; ?>" hidden>
                                                    </td>
                                                </tr>
                                                <?php
                                                        $i++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <br><br>
                                        <div class="table-caption">Evaluation</div>
                                        <table>
                                            <thead>
                                                <th>Evaluation</th>
                                                <th>Very Poor</th>
                                                <th>Poor</th>
                                                <th>Average</th>
                                                <th>Very Good</th>
                                                <th>Excellent</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="padding-left: 1% !important">
                                                        <div class="section-title">
                                                            Quality of Spa Reservation
                                                        </div>
                                                    </td>
                                                    <td data-column="Very Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q1" value="1" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q1" value="2" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Average">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q1" value="3" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Very Good">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q1" value="4" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Excellent">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q1" value="5" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 1% !important">
                                                        <div class="section-title">
                                                            Spa Receptionist Service
                                                        </div>
                                                    </td>
                                                    <td data-column="Very Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q2" value="1" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q2" value="2" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Average">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q2" value="3" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Very Good">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q2" value="4" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Excellent">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q2" value="5" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 1% !important">
                                                        <div class="section-title">
                                                            Treatment Room / Area Ambience
                                                        </div>
                                                    </td>
                                                    <td data-column="Very Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q3" value="1" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q3" value="2" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Average">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q3" value="3" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Very Good">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q3" value="4" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Excellent">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q3" value="5" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 1% !important">
                                                        <div class="section-title">
                                                            Therapist Consultation skill
                                                        </div>
                                                    </td>
                                                    <td data-column="Very Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q4" value="1" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q4" value="2" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Average">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q4" value="3" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Very Good">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q4" value="4" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Excellent">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q4" value="5" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 1% !important">
                                                        <div class="section-title">
                                                            Quality of Treatment
                                                        </div>
                                                    </td>
                                                    <td data-column="Very Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q5" value="1" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q5" value="2" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Average">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q5" value="3" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Very Good">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q5" value="4" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Excellent">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q5" value="5" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 1% !important">
                                                        <div class="section-title">
                                                            Quality of time spent
                                                        </div>
                                                    </td>
                                                    <td data-column="Very Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q6" value="1" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q6" value="2" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Average">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q6" value="3" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Very Good">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q6" value="4" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Excellent">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q6" value="5" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 1% !important">
                                                        <div class="section-title">
                                                            Over all Spa Experience
                                                        </div>
                                                    </td>
                                                    <td data-column="Very Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q7" value="1" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Poor">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q7" value="2" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Average">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q7" value="3" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Very Good">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q7" value="4" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                    <td data-column="Excellent">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="eva_q7" value="5" class="selectgroup-input" required>
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br><br>
                                        <div class="form-group row">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                                <h6>Would you visit Diva Lounge Spa again ? :</h6>
                                            </label>
                                            <div class="col-sm-12 col-md-3 text-center">
                                                <label class="selectgroup-item">
                                                    <b>Definitely</b>
                                                    <input type="radio" name="return" value="1" class="selectgroup-input" required>
                                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                </label>
                                            </div>
                                            <div class="col-sm-12 col-md-3 text-center">
                                                <label class="selectgroup-item">
                                                    <b>Maybe</b>
                                                    <input type="radio" name="return" value="2" class="selectgroup-input" required>
                                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                </label>
                                            </div>
                                            <div class="col-sm-12 col-md-3 text-center">
                                                <label class="selectgroup-item">
                                                    <b>Definitely Not</b>
                                                    <input type="radio" name="return" value="3" class="selectgroup-input" required>
                                                    <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-star"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label text-md-right col-12 col-md-2 col-lg-2">
                                                <h6>Additional Comments :</h6>
                                            </label>
                                            <div class="col-sm-12 col-md-10">
                                                <textarea name="cust_comment" cols="30" rows="4" style="width: 100%"></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <input type="text" value="<?php echo $i - 1; ?>" name="total_count" hidden>
                                            <input type="text" value="<?php echo $cust_code; ?>" name="cust_code" hidden>
                                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                        </div>
                                    </form>
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
                                Designed by <a href="#" target="_blank">Teciza Solution</a> & 
                                Powered by <a href="https://thegraphe.com" target="_blank">The Graphē - A Design Studio</a>
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