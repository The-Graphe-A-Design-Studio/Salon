<?php
    include('../session.php');

    if(isset($_POST['newstaffName']) && isset($_POST['newstaffBranch']))
    {
        mysqli_query($link, "insert into staffs (l_id, st_name) values ('".$_POST['newstaffBranch']."', '".$_POST['newstaffName']."')");

        echo "New staff registered";
    }
    elseif(isset($_POST['location_id']))
    {
        foreach($_POST['new_staff'] as $staff)
        {
            if(!empty($staff))
            {
                $staff = mysqli_real_escape_string($link, $staff);

                $rtt = "insert into staffs (l_id, st_name) values ('".$_POST['location_id']."', '$staff')";
                mysqli_query($link, $rtt);
            }
        }
        echo "New staffs updated";
    }
    elseif(isset($_POST['edit_location_id']) && isset($_POST['edit_location_total']))
    {
        for($i = 1; $i <= $_POST['edit_location_total']; $i++)
        {
            $edit_staff = $_POST['edit_staff_'.$i];
            $edit_staff_id = $_POST['edit_staff_id_'.$i];
            
            $edit_staff = mysqli_real_escape_string($link, $edit_staff);
            
            mysqli_query($link, "update staffs set st_name = '$edit_staff' where st_id = '$edit_staff_id'");
        }
        echo "Staffs details updated";
    }
    elseif(isset($_POST['delete_staff_id']))
    {
        $delete = "delete from staffs where st_id = '".$_POST['delete_staff_id']."'";
        $run_delete = mysqli_query($link, $delete);

        if($run_delete)
        {
            echo "Staff removed";
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