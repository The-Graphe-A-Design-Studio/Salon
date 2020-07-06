<?php

    include("../../dbcon.php");

    if(isset($_POST['branch_id']) && isset($_POST['customer_id']))
    {
        $count = count($_POST['services']);

        // echo $count;

        for ($i=0; $i < $count ; $i++)
        {
            $cat = "select * from services where se_id = '".$_POST['services'][$i]."'";
            $get_cat = mysqli_query($link, $cat);
            $cat_row = mysqli_fetch_array($get_cat, MYSQLI_ASSOC);

            $sql = "insert into review_form (c_id, l_id, s_id, se_id, st_id) values ('".$_POST['customer_id']."', '".$_POST['branch_id']."', 
                    '".$cat_row['s_id']."', '".$_POST['services'][$i]."', '".$_POST['staff'][$i]."')";
            mysqli_query($link,$sql);
        }

        $sql2 = "update customers set c_status = '2' where c_id = '".$_POST['customer_id']."'";
        mysqli_query($link, $sql2);
        
        echo "Form created";
    }
    elseif(isset($_POST['total_count']) && isset($_POST['cust_comment']) && isset($_POST['cust_id']))
    {
        // $count_re = count($_POST['review_id']);

        $id = $_POST['cust_id'];
        $comment = $_POST['cust_comment'];
        $comment = mysqli_real_escape_string($link, $comment);

        // echo $id."       ".$comment;

        for($i = 1; $i <= $_POST['total_count']; $i++)
        {
            $star = $_POST['stars'.$i];
            $re_id = $_POST['review_id'.$i];

            // echo $star."        ".$re_id."<br>";
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