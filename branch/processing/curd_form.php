<?php

    include("../../dbcon.php");

    // if(isset($_POST['newcustName']) && isset($_POST['newcustEmail']) && isset($_POST['newcustPhone']) && isset($_POST['branch_id']))
    // {
    //     date_default_timezone_set("Asia/Qatar");
    //     $order_time = date('h:i A');
    //     $order_date = date('d M, Y');

    //     function generateRandomString($length = 7)
    //     {
    //         $characters = 'aAbBc0CdDeE1fFgGh2HiIjJ3kKlLm4MnNoO5pPqQr6RsStT7uUvVw8WxXyY9zZ';
    //         $charactersLength = strlen($characters);
    //         $randomString = '';
    //         for ($i = 0; $i < $length; $i++)
    //         {
    //             $randomString .= $characters[rand(0, $charactersLength - 1)];
    //         }
    //         return $randomString;
    //     }

    //     $code = generateRandomString();

    //     mysqli_query($link, "insert into customers (c_code, branch_id, c_name, c_email, c_phone, c_date) values ('$code', '".$_POST['branch_id']."', 
    //         '".$_POST['newcustName']."', '".$_POST['newcustEmail']."', '".$_POST['newcustPhone']."', '$order_date')");

    //     echo "New customer registered";

    // }

    if(isset($_POST['newcustName']) && isset($_POST['newcustTicket']) && isset($_POST['newcustPhone']) && isset($_POST['branch_id']))
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
            '".$_POST['newcustName']."', '".$_POST['newcustTicket']."', '".$_POST['newcustPhone']."', '$order_date')");

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