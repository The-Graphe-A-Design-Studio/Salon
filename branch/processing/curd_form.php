<?php

    include("../../dbcon.php");

    if(isset($_POST['newcustTicket']) && isset($_POST['newcustName']) && isset($_POST['newcustLastName']) && isset($_POST['newcustPhone']) && isset($_POST['newcustWhatsapp']) &&
        isset($_POST['newcustEmail']) && isset($_POST['newcustBday']) && isset($_POST['newcustAday']) && isset($_POST['newcustWorkPhoneNum']) &&
        isset($_POST['newcustQatarId']) && isset($_POST['newcustAddress1']) && isset($_POST['newcustAddress2']) && isset($_POST['newcustCity']) &&
        isset($_POST['newcustZip']) && isset($_POST['newcustState']) && isset($_POST['newcustCountry']) && isset($_POST['newcustOthers']) && isset($_POST['branch_id']))
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

        $sqlr = "SELECT * FROM cust_name_phone where cust_phone = '".$_POST['newcustPhone']."'";
        $checkr = mysqli_query($link, $sqlr);
        $rowr = mysqli_fetch_array($checkr, MYSQLI_ASSOC);
        $count = mysqli_num_rows($checkr);
        if($count >= 1)
        {
            echo "This Phone Number is already registered";
        }
        else
        {
            $name = $_POST['newcustName']." ".$_POST['newcustLastName'];

            $insert_cust = mysqli_query($link, "insert into customers (c_code, branch_id, c_name, c_ticket, c_phone, c_date) values ('$code', '".$_POST['branch_id']."', 
            '".$name."', '".$_POST['newcustTicket']."', '".$_POST['newcustPhone']."', '$order_date')");

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

                mysqli_query($link, "insert into cust_name_phone (`cust_name`, `last_name`, `cust_phone`, `whatsapp_num`, `email`, `birthday`, `anniversary`,
                            `work_phone`, `qatar_id`, `address_1`, `address_2`, `city`, `zip`, `state`, `country`, `others`) values ('".$_POST['newcustName']."',
                            '".$_POST['newcustLastName']."', '".$_POST['newcustPhone']."', '".$_POST['newcustWhatsapp']."', '".$_POST['newcustEmail']."', 
                            '".$_POST['newcustBday']."', '".$_POST['newcustAday']."', '".$_POST['newcustWorkPhoneNum']."', '".$_POST['newcustQatarId']."', 
                            '".$_POST['newcustAddress1']."', '".$_POST['newcustAddress2']."', '".$_POST['newcustCity']."', '".$_POST['newcustZip']."', 
                            '".$_POST['newcustState']."', '".$_POST['newcustCountry']."', '".$_POST['newcustOthers']."')");
                
                echo "Customer registered and form created";
            }
            else
            {
                echo "Something went wrong. Try again";
            }
        }
    }
    elseif(isset($_POST['exCustomer']) && isset($_POST['exTicket']) && isset($_POST['exPhone']) && isset($_POST['branch_id']))
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

        $insert_cust = mysqli_query($link, "insert into customers (c_code, branch_id, c_name, c_ticket, c_phone, c_date) values ('$code', '".$_POST['branch_id']."', 
            '".$_POST['exCustomer']."', '".$_POST['exTicket']."', '".$_POST['exPhone']."', '$order_date')");

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