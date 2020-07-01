<?php
   session_start();
   include('../dbcon.php');

   if(!isset($_SESSION['branchId_loggedin']))
   {
	    echo "<script type='text/javascript'>alert('First Login');</script>";
	    echo "<script>location.href='login'</script>";
       die();
   }
   
   $user_check = $_SESSION['branchId_loggedin'];
   
   $ses_sql = mysqli_query($link, "select * from locations where l_id = '$user_check' ");
   
   $rows = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $branch_id_session = $rows['l_id'];
   $branch_name_session = $rows['l_name'];

?>