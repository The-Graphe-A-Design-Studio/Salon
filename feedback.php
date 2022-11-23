<?php
    include('dbcon.php');

    $cust_code = $_GET['cust'];
    $cust_id = $_GET['id'];

    $customer = "select * from customers where c_id = '$cust_id' and c_code = '$cust_code'";
    $get = mysqli_query($link, $customer);
    $row = mysqli_fetch_array($get, MYSQLI_ASSOC);

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
        <link rel="icon" href="assets/img/diva-logo-sm.png" type="image/gif" sizes="32x32">
        <!-- General CSS Files -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <!-- Template CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/components.css">
        <link rel="stylesheet" href="assets/css/google.css">

        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" 
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

        <style>
            table, th, td
            {
                font-size: 1.05rem !important;
                padding: 1vh;
                border: none !important;
            }
            .card .card-body .section-title::before {
                display: none;
            }
        </style>
    </head>
    <body>

        <div id="app">
            <section class="section">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card canvas_div_pdf">
                                <div class="login-brand" style="position: relative;">
                                    <div style="position: absolute; top: 50%; left: 2%;">
                                        <span style="font-size: 0.6rem; letter-spacing: 2px;"><?php echo $row_branch['l_name']; ?></span>
                                    </div>
                                    <div style="position: absolute; top: 50%; right: 2%;">
                                        <span style="font-size: 0.6rem; letter-spacing: 2px;"><?php echo $row['c_date']; ?></span>
                                    </div>
                                </div>
                                <div class="login-brand">
                                    <img src="assets/img/diva-logo.png" alt="diva lounge spa logo" width="320">
                                </div>
                                <div class="card-header text-center" style="width: unset !important">
                                    <h1 class="card-title">Feedback Form</h1>
                                </div>
                                <div class="card-body">
                                    <table class="col-sm-12 table-bordered table-condensed cf">
                                        <tr>
                                            <th>Guest Name</th>
                                            <td><?php echo $row['c_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Ticket Number</th>
                                            <td><?php echo $row['c_ticket']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number</th>
                                            <td><?php echo $row['c_phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Services</th>
                                            </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="col-sm-12 table-bordered table-condensed cf">
                                                    <?php
                                                        $i=1;
                                                        $re = "select * from review_form where c_code = '".$row['c_code']."'";
                                                        $g_re = mysqli_query($link, $re);
                                                        while($r_re = mysqli_fetch_array($g_re, MYSQLI_ASSOC))
                                                        {
                                                            $ser = "select * from services where se_id = '".$r_re['se_id']."'";
                                                            $g_ser = mysqli_query($link, $ser);
                                                            $r_ser = mysqli_fetch_array($g_ser, MYSQLI_ASSOC);

                                                            $st = "select * from staffs where st_id = '".$r_re['st_id']."'";
                                                            $g_st = mysqli_query($link, $st);
                                                            $r_st = mysqli_fetch_array($g_st, MYSQLI_ASSOC);

                                                            if($r_re['rating'] == 1)
                                                            {
                                                                $rating = "Very Poor";
                                                            }
                                                            elseif($r_re['rating'] == 2)
                                                            {
                                                                $rating = "Poor";
                                                            }
                                                            elseif($r_re['rating'] == 3)
                                                            {
                                                                $rating = "Average";
                                                            }
                                                            elseif($r_re['rating'] == 4)
                                                            {
                                                                $rating = "Very Good";
                                                            }
                                                            elseif($r_re['rating'] == 5)
                                                            {
                                                                $rating = "Excellent";
                                                            }
                                                            else
                                                            {
                                                                $rating = "Nothing";
                                                            }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo "<b>".$i.".</b>&nbsp;&nbsp;".$r_ser['se_name']; ?>
                                                        </td>
                                                        <td>
                                                            <span style="color: #6c757d; font-size: 0.9rem;"><b>Service By : </b><?php echo $r_st['st_name']; ?></span>
                                                        </td>
                                                        <td>
                                                            <span style="color: #6c757d; font-size: 0.9rem;"><?php echo $rating; ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                            $i++;
                                                        }
                                                    ?>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Evaluations</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="col-sm-12 table-bordered table-condensed cf">
                                                    <tr>
                                                        <td>
                                                            <b>1.</b>&nbsp;&nbsp;Quality of Spa Reservation
                                                        </td>
                                                        <td>
                                                            <?php

                                                                if($row['c_q1'] == 1)
                                                                {
                                                                    $rating = "Very Poor";
                                                                }
                                                                elseif($row['c_q1'] == 2)
                                                                {
                                                                    $rating = "Poor";
                                                                }
                                                                elseif($row['c_q1'] == 3)
                                                                {
                                                                    $rating = "Average";
                                                                }
                                                                elseif($row['c_q1'] == 4)
                                                                {
                                                                    $rating = "Very Good";
                                                                }
                                                                elseif($row['c_q1'] == 5)
                                                                {
                                                                    $rating = "Excellent";
                                                                }
                                                                else
                                                                {
                                                                    $rating = "Nothing";
                                                                }

                                                            ?>
                                                            <span style="color: #6c757d; font-size: 0.9rem;"><?php echo $rating; ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <b>2.</b>&nbsp;&nbsp;Spa Receptionist Service
                                                        </td>
                                                        <td>
                                                            <?php

                                                                if($row['c_q2'] == 1)
                                                                {
                                                                    $rating = "Very Poor";
                                                                }
                                                                elseif($row['c_q2'] == 2)
                                                                {
                                                                    $rating = "Poor";
                                                                }
                                                                elseif($row['c_q2'] == 3)
                                                                {
                                                                    $rating = "Average";
                                                                }
                                                                elseif($row['c_q2'] == 4)
                                                                {
                                                                    $rating = "Very Good";
                                                                }
                                                                elseif($row['c_q2'] == 5)
                                                                {
                                                                    $rating = "Excellent";
                                                                }
                                                                else
                                                                {
                                                                    $rating = "Nothing";
                                                                }

                                                            ?>
                                                            <span style="color: #6c757d; font-size: 0.9rem;"><?php echo $rating; ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <b>3.</b>&nbsp;&nbsp;Treatment Room / Area Ambience
                                                        </td>
                                                        <td>
                                                            <?php

                                                                if($row['c_q3'] == 1)
                                                                {
                                                                    $rating = "Very Poor";
                                                                }
                                                                elseif($row['c_q3'] == 2)
                                                                {
                                                                    $rating = "Poor";
                                                                }
                                                                elseif($row['c_q3'] == 3)
                                                                {
                                                                    $rating = "Average";
                                                                }
                                                                elseif($row['c_q3'] == 4)
                                                                {
                                                                    $rating = "Very Good";
                                                                }
                                                                elseif($row['c_q3'] == 5)
                                                                {
                                                                    $rating = "Excellent";
                                                                }
                                                                else
                                                                {
                                                                    $rating = "Nothing";
                                                                }

                                                            ?>
                                                            <span style="color: #6c757d; font-size: 0.9rem;"><?php echo $rating; ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <b>4.</b>&nbsp;&nbsp;Therapist Consultation skill
                                                        </td>
                                                        <td>
                                                        <?php

                                                        if($row['c_q4'] == 1)
                                                        {
                                                            $rating = "Very Poor";
                                                        }
                                                        elseif($row['c_q4'] == 2)
                                                        {
                                                            $rating = "Poor";
                                                        }
                                                        elseif($row['c_q4'] == 3)
                                                        {
                                                            $rating = "Average";
                                                        }
                                                        elseif($row['c_q4'] == 4)
                                                        {
                                                            $rating = "Very Good";
                                                        }
                                                        elseif($row['c_q4'] == 5)
                                                        {
                                                            $rating = "Excellent";
                                                        }
                                                        else
                                                        {
                                                            $rating = "Nothing";
                                                        }

                                                        ?>
                                                            <span style="color: #6c757d; font-size: 0.9rem;"><?php echo $rating; ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <b>5.</b>&nbsp;&nbsp;Quality of Treatment
                                                        </td>
                                                        <td>
                                                        <?php

                                                        if($row['c_q5'] == 1)
                                                        {
                                                            $rating = "Very Poor";
                                                        }
                                                        elseif($row['c_q5'] == 2)
                                                        {
                                                            $rating = "Poor";
                                                        }
                                                        elseif($row['c_q5'] == 3)
                                                        {
                                                            $rating = "Average";
                                                        }
                                                        elseif($row['c_q5'] == 4)
                                                        {
                                                            $rating = "Very Good";
                                                        }
                                                        elseif($row['c_q5'] == 5)
                                                        {
                                                            $rating = "Excellent";
                                                        }
                                                        else
                                                        {
                                                            $rating = "Nothing";
                                                        }

                                                        ?>
                                                            <span style="color: #6c757d; font-size: 0.9rem;"><?php echo $rating; ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <b>6.</b>&nbsp;&nbsp;Quality of time spent
                                                        </td>
                                                        <td>
                                                        <?php

                                                        if($row['c_q6'] == 1)
                                                        {
                                                            $rating = "Very Poor";
                                                        }
                                                        elseif($row['c_q6'] == 2)
                                                        {
                                                            $rating = "Poor";
                                                        }
                                                        elseif($row['c_q6'] == 3)
                                                        {
                                                            $rating = "Average";
                                                        }
                                                        elseif($row['c_q6'] == 4)
                                                        {
                                                            $rating = "Very Good";
                                                        }
                                                        elseif($row['c_q6'] == 5)
                                                        {
                                                            $rating = "Excellent";
                                                        }
                                                        else
                                                        {
                                                            $rating = "Nothing";
                                                        }

                                                        ?>
                                                            <span style="color: #6c757d; font-size: 0.9rem;"><?php echo $rating; ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <b>7.</b>&nbsp;&nbsp;Over all Spa Experience
                                                        </td>
                                                        <td>
                                                        <?php

                                                        if($row['c_q7'] == 1)
                                                        {
                                                            $rating = "Very Poor";
                                                        }
                                                        elseif($row['c_q7'] == 2)
                                                        {
                                                            $rating = "Poor";
                                                        }
                                                        elseif($row['c_q7'] == 3)
                                                        {
                                                            $rating = "Average";
                                                        }
                                                        elseif($row['c_q7'] == 4)
                                                        {
                                                            $rating = "Very Good";
                                                        }
                                                        elseif($row['c_q7'] == 5)
                                                        {
                                                            $rating = "Excellent";
                                                        }
                                                        else
                                                        {
                                                            $rating = "Nothing";
                                                        }

                                                        ?>
                                                            <span style="color: #6c757d; font-size: 0.9rem;"><?php echo $rating; ?></span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Visit Again</th>
                                            <td>
                                                <?php

                                                if($row['c_return'] == 1)
                                                {
                                                    $return = "Definitely";
                                                }
                                                elseif($row['c_return'] == 2)
                                                {
                                                    $return = "MAy be";
                                                }
                                                elseif($row['c_return'] == 3)
                                                {
                                                    $return = "Definitely not";
                                                }
                                                else
                                                {
                                                    $return = "Nothing";
                                                }

                                                ?>
                                                <span style="color: #6c757d; font-size: 0.9rem;"><?php echo $return; ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Additional Comment</th>
                                            <td>
                                                <p style="color: #6c757d; font-size: 0.9rem;"><?php echo $row['c_comment']; ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>                                
                            </div>
                            <button class="btn btn-primary btn-sm" onclick="getPDF()" title="Save as PDF" id="downloadbtn">
                                <i class="fas fa-file-pdf mr-1"></i> Save as PDF
                            </button>

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
                        <div>
                    <div>
                <div>
            <section>
        </div>

        <!-- Google Translater -->
        <script src="assets/js/google.js"></script>

        <script>
            function getPDF(){
            var HTML_Width = $(".canvas_div_pdf").width();
            var HTML_Height = $(".canvas_div_pdf").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width+(top_left_margin*2);
            var PDF_Height = HTML_Height+(top_left_margin*2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
            html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
                canvas.getContext('2d');
                
                console.log(canvas.height+"  "+canvas.width);
                
                
                var imgData = canvas.toDataURL("image/jpeg", 1);
                var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
                
                
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                
                pdf.save("feedback.pdf");
            });
            };
        </script>

    </body>
</html>