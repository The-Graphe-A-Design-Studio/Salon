<?php
    include('../session.php');

    if(isset($_POST['newbranchName']) && isset($_POST['newbranchAddress']) && isset($_POST['newbranchPhone']) && isset($_POST['newbranchPassword']))
    {
        $newadd = mysqli_real_escape_string($link, $_POST['newbranchAddress']);;
        $newenc_pass = md5($_POST['newbranchPassword']);

        $insert = "insert into locations (l_name, l_address, l_phone, l_pass, l_pass_enc) values ('".$_POST['newbranchName']."', '$newadd', '".$_POST['newbranchPhone']."',
                '".$_POST['newbranchPassword']."', '".$newenc_pass."')";
        $run_insert = mysqli_query($link, $insert);
        if($run_insert)
        {
            echo "New branch added";
        }
        else
        {
            echo "Something went wrong";
        }
    }
    elseif(isset($_POST['branchName']) && isset($_POST['branchAddress']) && isset($_POST['branchPhone']) && isset($_POST['branchPassword']) && isset($_POST['branchId']))
    {
        $add = mysqli_real_escape_string($link, $_POST['branchAddress']);;
        $enc_pass = md5($_POST['branchPassword']);

        $update_sql = "update locations set l_name = '".$_POST['branchName']."', l_address = '$add', l_phone = '".$_POST['branchPhone']."', 
                        l_pass = '".$_POST['branchPassword']."', l_pass_enc = '$enc_pass' where l_id = '".$_POST['branchId']."'";
        $run_sql = mysqli_query($link, $update_sql);
        if($run_sql)
        {
            echo "Branch details updated";
        }
        else
        {
            echo "Branch details update failed";
        }
    }
    elseif(isset($_POST['deletebranchId']))
    {
        $delete = mysqli_query($link, "delete from locations where l_id = '".$_POST['deletebranchId']."'");
        if($delete)
        {
            echo "Branch removed";
        }
        else
        {
            echo "Something went wrong";
        }
    }
    else
    {
        echo "Server not responding. Try again";
    }
?>