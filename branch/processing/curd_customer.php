<?php

    include('../../dbcon.php');

    $connect = new PDO("mysql:host=$hostName; dbname=$dbName", $userName, $password);

    if(isset($_POST["action"]))
    {
        $query = "SELECT * FROM customers where reg = '1'";

        if(!empty($_POST["start_date"]) && empty($_POST["end_date"]))
        {
            $s_date = date_create($_POST["start_date"]);
            $s_date = date_format($s_date, "Y-m-d");
            
            $e_date = date_create($_POST["end_date"]);
            $e_date = date_format($e_date, "Y-m-d");

            $query .= " AND c_date >= '".$s_date."'";
        }
        elseif(empty($_POST["start_date"]) && !empty($_POST["end_date"]))
        {
            $s_date = date_create($_POST["start_date"]);
            $s_date = date_format($s_date, "Y-m-d");
            
            $e_date = date_create($_POST["end_date"]);
            $e_date = date_format($e_date, "Y-m-d");

            $query .= " AND c_date <= '".$e_date."'";
        }
        elseif(!empty($_POST["start_date"]) && !empty($_POST["end_date"]))
        {
            $s_date = date_create($_POST["start_date"]);
            $s_date = date_format($s_date, "Y-m-d");
            
            $e_date = date_create($_POST["end_date"]);
            $e_date = date_format($e_date, "Y-m-d");

            $query .= " AND c_date >= '".$s_date."' AND c_date <= '".$e_date."'";
        }
        else
        {
            $query .= "";
        }

        if(isset($_POST["phone"]))
        {
            if(!empty($_POST["phone"]))
            {
                $se3 = $_POST['phone'];
                $query .= " AND c_phone like '%$se3%'";
            }
        }

        if(isset($_POST["whatsapp"]))
        {
            if(!empty($_POST["whatsapp"]))
            {
                $se4 = $_POST['whatsapp'];
                $query .= " AND c_whatsapp like '%$se4%'";
            }
        }

        if(isset($_POST['branch']))
        {
            $query .= " AND branch_id = '".$_POST['branch']."'";
        }

        if(isset($_POST['search']))
        {
            $se = $_POST['search'];
            $query .= " AND c_name LIKE '%$se%' AND c_status = '2' order by c_id desc";
        }

        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();

        $output = '';
        
        if($total_row > 0)
        {
            foreach($result as $row)
            {
                $output .= 
                '
                    <tr>
                        <td data-column="Date">'.$row['c_date'].'</td>
                        <td data-column="Name">'.$row['c_name'].'</td>
                        <td data-column="Ticket">'.$row['c_ticket'].'</td>
                        <td data-column="Phone"><a href="tel:'.$row['c_phone'].'" target="_blank">'.$row['c_phone'].'</td>
                        <td data-column="Whatsapp"><a href="https://wa.me/'.$row['c_whatsapp'].'" target="_blank">'.$row['c_whatsapp'].'</td>
                ';

                if($row['c_status'] == 0)
                {
                    $status =
                    '
                        <a href="customer_form?cust_id='.$row['c_id'].'"><i class="fas fa-align-left" title="Generate Form" style="color: red; font-size: 1.5em"></i></a>
                    ';

                    $link =
                    '
                        <b>Feedback Form Link: </b>Link not generated
                    ';
                }
                elseif($row['c_status'] == 2)
                {
                    $status =
                    '
                        <i class="fas fa-clipboard-list" title="Pending" style="color: #495ae1; font-size: 1.5em"></i>
                    ';

                    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                    {
                        $url = "https://www.developers-thegraphe.com/php/salon2/";
                    }
                    else 
                    {
                        $url = "http://www.developers-thegraphe.com/php/salon2/";
                    }

                    $link = $url.'branch/feedback_form?cust='.$row['c_code'].'&id='.$row['c_id'].'';
                }
                else
                {
                    $status =
                    '
                        <i class="fas fa-clipboard-check" title="Reviewed" style="color: #81be41; font-size: 1.5em"></i>
                    ';

                    $link =
                    '
                        <b>Feedback Form Link:</b> Submitted
                    ';
                }

                $output .=
                '
                        <td data-column="Status">'.$status.'</td>
                        <td data-column="Link" class="copy'.$row['c_id'].'">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="input-group">
                                    <input type="text" style="width: 65%;" class="form-control" value="'.$link.'" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-info" type="button">Copy</button>
                                    </div>
                                </div>
                            </div>
                        </td>                        
                        <td data-column="Share">
                            <a href="https://wa.me/'.$row['c_whatsapp'].'?text=We%20appreciate%20your%20business%20and%20we%20want%20to%20make%20sure%20we%20meet%20your%20expectations%2C%20providing%20the%20right%20treatment%20is%20very%20important%20and%20we%20would%20like%20to%20hear%20your%20feedback%20on%20your%20Spa%20experience.%0A%0AFeedback%20form%20-%20'.urlencode($link).'%0A%0AThanks%20%26%20Regards%0ADiva%20Lounge%20Spa" target="_blank" class="btn btn-success">
                            <i class="fab fa-whatsapp"></i>
                            </a>                            
                        </td>
                        <td data-column="Edit">
                            <button class="btn btn-warning btn-md" data-toggle="collapse" data-target="#collapse_'.$row['c_id'].'" 
                            aria-expanded="true" aria-controls="collapse_'.$row['c_id'].'" title="Edit Ticket Number">Edit</button>
                        </td>
                        <td data-column="Delete">
                            <form class="edit_cust'.$row['c_id'].'">
                                <input type="text" name="delete_customer" value="'.$row['c_id'].'" hidden>
                                <button type="submit" class="btn btn-danger btn-md btn-icon" title="Delete Customer"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <tr class="collapse edit_cust" id="collapse_'.$row['c_id'].'" style="border: 2px solid #ffa426;">
                        <td colspan="8" style="padding: 0">
                            <form class="edit_cust'.$row['c_id'].'">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td data-column="Date">Edit Ticket</td>
                                            <td data-column="Name">'.$row['c_name'].'</td>
                                            <td data-column="Ticket">
                                                <input type="text" class="form-control" name="edit_cust_ticket" value="'.$row['c_ticket'].'">
                                            </td>
                                            <td data-column="Phone">'.$row['c_phone'].'</td>
                                            <td data-column="Status">'.$status.'</td>
                                            <td data-column="Edit Details">
                                                <input type="text" class="form-control" name="edit_cust_id" value="'.$row['c_id'].'" hidden>
                                                <button type="submit" class="btn btn-success btn-md">Update</button>
                                            </td>
                                            <td data-column="Delete">
                                                <button type="button" class="btn btn-info btn-md btn-icon " data-toggle="collapse" data-target="#collapse_'.$row['c_id'].'" 
                                                    aria-expanded="true" aria-controls="collapse_'.$row['c_id'].'" title="Close">&#10006;</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <script type="text/javascript">
                                $(".edit_cust'.$row['c_id'].'").submit(function(e)
                                {
                                    // alert("shd");
                                    var form_data = $(this).serialize();
                                    // alert(form_data);
                                    var button_content = $(this).find("button[type=submit]");
                                    $.ajax({
                                        url: "processing/curd_customer.php",
                                        data: form_data,
                                        type: "POST",
                                        success: function(data)
                                        {
                                            alert(data);
                                            if(data === "Customer details updated" || data === "Link deleted.")
                                            {
                                                $( "#refresh_btn" ).trigger( "click" );
                                            }
                                        }
                                    });
                                    e.preventDefault();
                                });

                                (function()
                                {
                                    var copyButton = document.querySelector(".copy'.$row['c_id'].' button");
                                    var copyInput = document.querySelector(".copy'.$row['c_id'].' input");
                                    copyButton.addEventListener("click", function(e) {
                                        e.preventDefault();
                                        var text = copyInput.select();
                                        document.execCommand("copy");
                                        copyButton.classList.remove("btn-primary");
                                        copyButton.innerHTML = "Copied";
                                    });
                                    
                                    copyInput.addEventListener("click", function() {
                                        this.select();
                                    });
                                })();
                            </script>
                        </td>
                    </tr>
                ';
            }
        }
        else
        {
            $output = 
            '
            <tr>
                <td colspan="10"><h5>No Data Found</h5></td>
            </tr>
            ';
        }
        
        echo $output;

    }
    elseif(isset($_POST['newcustName']) && isset($_POST['newcustTicket']) && isset($_POST['newcustPhone']) && isset($_POST['branch_id']))
    {
        date_default_timezone_set("Asia/Qatar");
        
        $order_date = date('Y-m-d');

        function generateRandomString($length = 7)
        {
            $characters = 'aAbBc0CdDeE1fFgGh2HiIjJ3kKlLm4MnNoO5pPqQr6RsStT7uUvVw8WxXyY9zZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++)
            {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $code = generateRandomString();

        mysqli_query($link, "insert into customers (c_code, branch_id, c_name, c_ticket, c_phone, c_date) values ('$code', '".$_POST['branch_id']."', 
            '".$_POST['newcustName']."', '".$_POST['newcustTicket']."', '".$_POST['newcustPhone']."', '$order_date')");

        mysqli_query($link, "insert into cust_name_phone (cust_name, cust_phone) values ('".$_POST['newcustName']."', '".$_POST['newcustPhone']."')");

        echo "New customer registered";

    }
    elseif(isset($_POST['edit_cust_ticket']) && isset($_POST['edit_cust_id']))
    {
        mysqli_query($link, "update customers set c_ticket = '".$_POST['edit_cust_ticket']."' where c_id = '".$_POST['edit_cust_id']."'");

        echo "Customer details updated";
    }
    elseif(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['con_phone']) && 
    isset($_POST['phone']) && isset($_POST['con_whatsapp']) && isset($_POST['whatsapp']) &&
    isset($_POST['email']) && isset($_POST['bday_date']) && isset($_POST['bday_month']) && isset($_POST['bday_year']) && 
    isset($_POST['aday_date']) && isset($_POST['aday_month']) && isset($_POST['aday_year']) && isset($_POST['con_work_phone']) && isset($_POST['workPhoneNum'])
    && isset($_POST['qatarId']) && isset($_POST['cust_category']) && isset($_POST['address1']) && isset($_POST['address2']) && 
    isset($_POST['address3']) && isset($_POST['city']) && isset($_POST['zip']) && isset($_POST['state']) && 
    isset($_POST['country']) && isset($_POST['skin_allergy']) && isset($_POST['back_problem']) && isset($_POST['blood_pressure']) && 
    isset($_POST['hear_ab_us']) && isset($_POST['others']) && isset($_POST['branch_id'])
        && isset($_POST['customer_id']))
    {
        date_default_timezone_set("Asia/Qatar");

        $sql_old = "SELECT * FROM cust_name_phone where cust_id <> '".$_POST['customer_id']."'";
        $check_old = mysqli_query($link, $sql_old);
        $row_old = mysqli_fetch_array($check_old, MYSQLI_ASSOC);

        $old_phn = $row_old['cust_phone'];
        $old_whatsapp = $row_old['whatsapp_num'];
        
        $sqlr = "SELECT * FROM cust_name_phone where cust_phone = '".$_POST['phone']."' and cust_id <> '".$_POST['customer_id']."'";
        $checkr = mysqli_query($link, $sqlr);
        $rowr = mysqli_fetch_array($checkr, MYSQLI_ASSOC);
        $count = mysqli_num_rows($checkr);
        if($count >= 1)
        {
            echo "This Phone Number is already registered";
        }
        else
        {
            $name = $_POST['firstName']." ".$_POST['lastName'];

            $bday_date = trim($_POST['bday_date'] ? : null);
            $bday_month = trim($_POST['bday_month'] ? : null);
            $bday_year = trim($_POST['bday_year'] ? : null);
            $aday_date = trim($_POST['aday_date'] ? : null);
            $aday_month = trim($_POST['aday_month'] ? : null);
            $aday_year = trim($_POST['aday_year'] ? : null);

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
            else
            {
                $bday = null;
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
            else
            {
                $aday = null;
            }

            $json_data = [
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'con_phone' => $_POST['con_phone'],
                'phone' => $_POST['phone'],
                'con_whatsapp' => $_POST['con_whatsapp'],
                'whatsapp' => $_POST['whatsapp'],
                'email' => $_POST['email'],
                'birthday' => $bday,
                'anniversary' => $aday,
                'con_work_phone' => $_POST['con_work_phone'],
                'workPhoneNum' => $_POST['workPhoneNum'],
                'qatarId' => $_POST['qatarId'],
                'cust_category' => $_POST['cust_category'],
                'address1' => $_POST['address1'],
                'address2' => $_POST['address2'],
                'address3' => $_POST['address3'],
                'city' => $_POST['city'],
                'zip' => $_POST['zip'],
                'state' => $_POST['state'],
                'country' => $_POST['country'],
                'skin_allergy' => $_POST['skin_allergy'],
                'back_problem' => $_POST['back_problem'],
                'blood_pressure' => $_POST['blood_pressure'],
                'hear_ab_us' => $_POST['hear_ab_us'],
                'others' => $_POST['others']
            ];

            $json_data = json_encode($json_data);

            $firstName = trim($_POST["firstName"]);
            $lastName = trim($_POST["lastName"]);
            $con_phone = $_POST['con_phone'] ? : 974;
            $phone = trim($_POST["phone"]);
            $con_whatsapp = $_POST['con_whatsapp'] ? : 974;
            $whatsapp = trim($_POST["whatsapp"]);
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

            $cust_category = mysqli_real_escape_string($link, $cust_category);
            $address1 = mysqli_real_escape_string($link, $address1);
            $address2 = mysqli_real_escape_string($link, $address2);
            $address3 = mysqli_real_escape_string($link, $address3);
            $city = mysqli_real_escape_string($link, $city);
            $zip = mysqli_real_escape_string($link, $zip);
            $state = mysqli_real_escape_string($link, $state);
            $country = mysqli_real_escape_string($link, $country);
            $others = mysqli_real_escape_string($link, $others);

            $sqluc = "UPDATE `cust_name_phone` SET `cust_name` = '$firstName', `last_name` = '$lastName', `con_cust_phone` = '$con_phone', 
            `cust_phone` = '$phone', `con_whatsapp_num` = '$con_whatsapp', `whatsapp_num` = '$whatsapp', `email` = '$email', 
            `birthday` = '$bday', `anniversary` = '$aday', `con_work_phone` = '$con_work_phone', `work_phone` = '$workPhoneNum', 
            `qatar_id` = '$qatarId', `cust_category` = '$cust_category', `address_1` = '$address1', `address_2` = '$address2', 
            `address_3` = '$address3', `city` = '$city', `zip` = '$zip', `state` = '$state', `country` = '$country', 
            `skin_allergy` = '$skin_allergy', `back_problem` = '$back_problem', `blood_pressure` = '$blood_pressure', 
            `hear_ab_us` = '$hear_ab_us', `others` = '$others' WHERE `cust_id` = '".$_POST['customer_id']."'";
            
            $updateuc = mysqli_query($link, $sqluc);

            if($updateuc)
            {
                $sqluc2 = "UPDATE `customers` SET `c_name`='".$name."', `c_phone`='".$_POST['phone']."', `c_whatsapp`='".$_POST['whatsapp']."', 
                            `json_data` = '".$json_data."' WHERE `c_phone` = '".$old_phn."' AND `c_whatsapp` = '".$old_whatsapp."'";
            
                $updateuc2 = mysqli_query($link, $sqluc2);

                echo "Customer details updated.";
            }
            else
            {
                echo "Something went wrong. Try again.";
            }
        }
    }
    elseif($_POST['delete_customer'])
    {
        mysqli_query($link, "delete from customers where c_id = '".$_POST['delete_customer']."'");

        echo "Link deleted.";
    }
    else
    {
        echo "Server not responding. Try again";
    }
?>