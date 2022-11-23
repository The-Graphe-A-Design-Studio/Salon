<?php

    include("../../dbcon.php");

    if(isset($_POST['newcustTicket']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['con_phone']) && 
        isset($_POST['phone']) && isset($_POST['con_whatsapp']) && isset($_POST['whatsapp']) &&
        isset($_POST['email']) && isset($_POST['bday_date']) && isset($_POST['bday_month']) && isset($_POST['bday_year']) && 
        isset($_POST['aday_date']) && isset($_POST['aday_month']) && isset($_POST['aday_year']) && isset($_POST['con_work_phone']) && isset($_POST['workPhoneNum'])
        && isset($_POST['qatarId']) && isset($_POST['cust_category']) && isset($_POST['address1']) && isset($_POST['address2']) && 
        isset($_POST['address3']) && isset($_POST['city']) && isset($_POST['zip']) && isset($_POST['state']) && 
        isset($_POST['country']) && isset($_POST['skin_allergy']) && isset($_POST['back_problem']) && isset($_POST['blood_pressure']) && 
        isset($_POST['hear_ab_us']) && isset($_POST['others']) && isset($_POST['branch_id']))
    {
        $count1 = count($_POST['services']);

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

        $sqlr = "SELECT * FROM cust_name_phone where cust_phone = '".$_POST['phone']."'";
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

            $insert_cust = mysqli_query($link, "insert into customers (c_code, branch_id, c_name, c_ticket, c_phone, c_whatsapp, c_date, json_data) values ('$code', '".$_POST['branch_id']."', 
            '".$name."', '".$_POST['newcustTicket']."', '".$_POST['phone']."', '".$_POST['whatsapp']."', '$order_date', '$json_data')");

            // echo "<script>alert('".print_r($insert_cust)."')</script>";

            if($insert_cust)
            {
                for ($i=0; $i < $count1 ; $i++)
                {
                    $cat = "select * from services where se_id = '".$_POST['services'][$i]."'";
                    $get_cat = mysqli_query($link, $cat);
                    $cat_row = mysqli_fetch_array($get_cat, MYSQLI_ASSOC);

                    $sql = "insert into review_form (c_code, l_id, s_id, se_id, st_id) values ('$code', '".$_POST['branch_id']."', 
                            '".$cat_row['s_id']."', '".$_POST['services'][$i]."', '".$_POST['staff'][$i]."')";
                    mysqli_query($link,$sql);
                }

                $sql2 = "update customers set c_status = '2' where c_code = '$code'";
                mysqli_query($link, $sql2);

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

                mysqli_query($link, "insert into cust_name_phone (`cust_name`, `last_name`, `con_cust_phone`, `cust_phone`, `con_whatsapp_num`, `whatsapp_num`, `email`, 
                `birthday`, `anniversary`, `con_work_phone`, `work_phone`, `qatar_id`, `cust_category`, `address_1`, `address_2`, `address_3`, `city`, 
                `zip`, `state`, `country`, `skin_allergy`, `back_problem`, `blood_pressure`, `hear_ab_us`, `others`) values ('$firstName', '$lastName', 
                '$con_phone', '$phone', '$con_whatsapp', '$whatsapp', '$email', '$bday', '$aday', '$con_work_phone', '$workPhoneNum', '$qatarId', 
                '$cust_category', '$address1', '$address2', '$address3', '$city', '$zip', '$state', '$country', '$skin_allergy', '$back_problem', 
                '$blood_pressure', '$hear_ab_us', '$others')");
                
                echo "Customer registered and form created";
            }
            else
            {
                echo "Something went wrong. Try again";
            }
        }
    }
    elseif(isset($_POST['exCustomer']) && isset($_POST['exTicket']) && isset($_POST['exPhone']) && isset($_POST['exWhatsapp']) && isset($_POST['branch_id']))
    {
        $count = count($_POST['services']);

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

        $cust = "select * from cust_name_phone where cust_phone = '".$_POST['exPhone']."' and whatsapp_num = '".$_POST['exWhatsapp']."'";
        $get_cust = mysqli_query($link, $cust);
        $cust_row = mysqli_fetch_array($get_cust, MYSQLI_ASSOC);

        $json = json_encode($cust_row);

        // print_r($cust_row);

        $name = $cust_row['cust_name']." ".$cust_row['last_name'];

        $insert_cust = mysqli_query($link, "insert into customers (c_code, branch_id, c_name, c_ticket, c_phone, c_whatsapp, c_date, json_data) values 
                        ('$code', '".$_POST['branch_id']."', '".$name."', '".$_POST['exTicket']."', '".$_POST['exPhone']."', 
                        '".$_POST['exWhatsapp']."', '$order_date', '$json')");

        if($insert_cust)
        {
            for ($i=0; $i < $count ; $i++)
            {
                $cat = "select * from services where se_id = '".$_POST['services'][$i]."'";
                $get_cat = mysqli_query($link, $cat);
                $cat_row = mysqli_fetch_array($get_cat, MYSQLI_ASSOC);

                $sql = "insert into review_form (c_code, l_id, s_id, se_id, st_id) values ('$code', '".$_POST['branch_id']."', 
                        '".$cat_row['s_id']."', '".$_POST['services'][$i]."', '".$_POST['staff'][$i]."')";
                mysqli_query($link,$sql);
            }

            $sql2 = "update customers set c_status = '2' where c_code = '$code'";
            mysqli_query($link, $sql2);

            echo "Customer registered and form created";
        }
        else
        {
            echo "Something went wrong. Try again";
        }
    }
    elseif(isset($_POST['total_count']) && isset($_POST['cust_comment']) && isset($_POST['cust_code']) && isset($_POST['return']) && 
        isset($_POST['eva_q1']) && isset($_POST['eva_q2']) && isset($_POST['eva_q3']) && isset($_POST['eva_q4']) && isset($_POST['eva_q5']) 
        && isset($_POST['eva_q6']) && isset($_POST['eva_q7']))
    {
        // $count_re = count($_POST['review_id']);

        $code = $_POST['cust_code'];
        $comment = $_POST['cust_comment'];
        $comment = mysqli_real_escape_string($link, $comment);

        for($i = 1; $i <= $_POST['total_count']; $i++)
        {
            $star = $_POST['stars'.$i];
            $re_id = $_POST['review_id'.$i];

            $update = "update review_form set rating = '$star' where re_id = '$re_id'";
            mysqli_query($link, $update);
        }

        $update_cust = "update customers set c_q1 = '".$_POST['eva_q1']."', c_q2 = '".$_POST['eva_q2']."', c_q3 = '".$_POST['eva_q3']."', 
        c_q4 = '".$_POST['eva_q4']."', c_q5 = '".$_POST['eva_q5']."', c_q6 = '".$_POST['eva_q6']."', c_q7 = '".$_POST['eva_q7']."', c_comment = '$comment', c_status = '1', c_return = '".$_POST['return']."' where c_code = '$code'";
        $done = mysqli_query($link, $update_cust);

        if($done)
        {
            echo "Feedback Submited";
        }
        else
        {
            echo "Something went wrong";
        }
    }
    else
    {
        echo "Server error. Try again";
    }

?>