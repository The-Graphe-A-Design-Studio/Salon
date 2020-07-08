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

    if(isset($_POST['newcustName']) && isset($_POST['newcustEmail']) && isset($_POST['newcustPhone']) && isset($_POST['branch_id']))
    {
        $count = count($_POST['services']);

        date_default_timezone_set("Asia/Qatar");
        $order_time = date('h:i A');
        $order_date = date('d M, Y');

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

        $insert_cust = mysqli_query($link, "insert into customers (c_code, branch_id, c_name, c_email, c_phone, c_date) values ('$code', '".$_POST['branch_id']."', 
            '".$_POST['newcustName']."', '".$_POST['newcustEmail']."', '".$_POST['newcustPhone']."', '$order_date')");

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
    elseif(isset($_POST['total_count']) && isset($_POST['cust_comment']) && isset($_POST['cust_id']))
    {
        // $count_re = count($_POST['review_id']);

        $id = $_POST['cust_id'];
        $comment = $_POST['cust_comment'];
        $comment = mysqli_real_escape_string($link, $comment);

        for($i = 1; $i <= $_POST['total_count']; $i++)
        {
            $star = $_POST['stars'.$i];
            $re_id = $_POST['review_id'.$i];

            $update = "update review_form set rating = '$star' where re_id = '$re_id'";
            mysqli_query($link, $update);
        }

        $update_cust = "update customers set c_comment = '$comment', c_status = '1' where c_id = '$id'";
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