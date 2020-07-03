<?php

    include('../../dbcon.php');

    $connect = new PDO("mysql:host=$hostName; dbname=$dbName", $userName, $password);

    if(isset($_POST["action"]))
    {
        $query = "SELECT * FROM customers where reg = '1'";

        if(isset($_POST["active"]))
        {
            $query .= " AND c_status = '1'";
        }

        if(isset($_POST["inactive"]))
        {
            $query .= " AND c_status = '0'";
        }
    
        if(isset($_POST['date']))
        {
            $ses = $_POST['date'];
            $query .= " AND c_date LIKE '$ses%'";
        }

        if(isset($_POST['search']))
        {
            $se = $_POST['search'];
            $query .= " AND c_name LIKE '$se%' order by c_id desc";
        }

        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();

        $output = '';
        
        if($total_row > 0)
        {
            foreach($result as $row)
            {
                $output .= 
                '
                    <tr>
                        <td data-column="Date">'.$row['c_date'].'</td>
                        <td data-column="Name">'.$row['c_name'].'</td>
                        <td data-column="Email">'.$row['c_email'].'</td>
                        <td data-column="Phone">'.$row['c_phone'].'</td>
                ';

                if($row['c_status'] == 0)
                {
                    $status =
                    '
                        <i class="fas fa-clipboard-list" style="color: red; font-size: 1.5em"></i>
                    ';
                }
                else
                {
                    $status =
                    '
                        <i class="fas fa-clipboard-check" style="color: #81be41; font-size: 1.5em"></i>
                    ';
                }

                $output .=
                '
                        <td data-column="Status">'.$status.'</td>
                        <td data-column="Edit Details">
                            <button class="btn btn-warning btn-md" data-toggle="collapse" data-target="#collapse_'.$row['c_id'].'" 
                            aria-expanded="true" aria-controls="collapse_'.$row['c_id'].'">Edit</button>
                        </td>
                        <td data-column="Delete">
                            <button class="btn btn-danger btn-md btn-icon" title="Delete Customer"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <form class="edit_cust">
                        <tr class="collapse" id="collapse_'.$row['c_id'].'" style="border: 2px solid #ffa426;">
                            <td data-column="Date">'.$row['c_date'].'</td>
                            <td data-column="Name"><input type="text" class="form-control" name="edit_cust_name" value="'.$row['c_name'].'"></td>
                            <td data-column="Email"><input type="text" class="form-control" name="edit_cust_email" value="'.$row['c_email'].'"></td>
                            <td data-column="Phone"><input type="text" class="form-control" name="edit_cust_phone" value="'.$row['c_phone'].'"></td>
                            <td data-column="Status">'.$status.'</td>
                            <td data-column="Edit Details">
                                <input type="text" class="form-control" name="edit_cust_id" value="'.$row['c_id'].'" hidden>
                                <button type="submit" class="btn btn-info btn-md">Update</button>
                            </td>
                            <td data-column="Edit Details">
                                <button class="btn btn-primary btn-md" data-toggle="collapse" data-target="#collapse_'.$row['c_id'].'" 
                                aria-expanded="true" aria-controls="collapse_'.$row['c_id'].'">Cancel</button>
                            </td>
                        </tr>
                    </form>
                ';
            }
            $output .=
            '
                <script>
                    $(".edit_cust").submit(function(e)
                    {
                        var form_data = $(this).serialize();
                        // alert(form_data);
                        var button_content = $(this).find("button[type=submit]");
                        $.ajax({
                            url: "processing/curd_customer.php",
                            data: form_data,
                            type: "POST",
                            success: function(data)
                            {
                                alert(data);
                                if(data === "Customer details updated" || data === "City deleted")
                                {
                                    $( "#refresh_btn" ).trigger( "click" );
                                }
                            }
                        });
                        e.preventDefault();
                    });
                </script>
            ';
        }
        else
        {
            $output = 
            '
            <tr>
                <td colspan="6"><h5>No Data Found</h5></td>
            </tr>
            ';
        }
        
        echo $output;

    }
    elseif(isset($_POST['newcustName']) && isset($_POST['newcustEmail']) && isset($_POST['newcustPhone']))
    {
        date_default_timezone_set("Asia/Qatar");
        $order_time = date('h:i A');
        $order_date = date('d M, Y');

        mysqli_query($link, "insert into customers (c_name, c_email, c_phone, c_date) values ('".$_POST['newcustName']."', '".$_POST['newcustEmail']."', 
        '".$_POST['newcustPhone']."', '$order_date')");

        echo "New customer registered";
    }
    elseif(isset($_POST['edit_cust_name']) && isset($_POST['edit_cust_email']) && isset($_POST['edit_cust_phone']) && isset($_POST['edit_cust_id']))
    {
        mysqli_query($link, "update customers set c_name = '".$_POST['edit_cust_name']."', c_email = '".$_POST['edit_cust_email']."', 
                    c_phone = '".$_POST['edit_cust_phone']."' where c_id = '".$_POST['edit_cust_id']."'");

        echo "Customer details updated";
    }
    else
    {
        echo "Server not responding. Try again";
    }
?>