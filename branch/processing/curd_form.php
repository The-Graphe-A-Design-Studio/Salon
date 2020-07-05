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
        mysqli_query($link,$sql2);
        
        echo "Form created";
    }

?>