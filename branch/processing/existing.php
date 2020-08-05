<?php
    //Include database configuration file
    include('../../dbcon.php');

    if(!empty($_POST["cust_name"])){
        //Get all state data
        
        $query = "SELECT * FROM cust_name_phone WHERE cust_name = '".$_POST["cust_name"]."'";
        $run_query = mysqli_query($link, $query);
        
        //Count total number of rows
        $count = mysqli_num_rows($run_query);
        
        //Display states list
        if($count > 0){
            while($row = mysqli_fetch_array($run_query))
            {
                $country_price=$row['cust_phone'];
                echo $country_price;
            }
        }else{
            echo 'not available';
        }
    }
    elseif(!empty($_POST["cust_phone"])){
        //Get all state data
        
        $query = "SELECT * FROM cust_name_phone WHERE cust_phone = '".$_POST["cust_phone"]."'";
        $run_query = mysqli_query($link, $query);
        
        //Count total number of rows
        $count = mysqli_num_rows($run_query);
        
        //Display states list
        if($count > 0){
            while($row = mysqli_fetch_array($run_query))
            {
                $country_price=$row['cust_name'];
                echo $country_price;
            }
        }else{
            echo 'not available';
        }
    }
    else
    {
        echo 'Something went wrong';
    }
?>