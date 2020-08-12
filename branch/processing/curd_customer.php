<?php

    include('../../dbcon.php');

    $connect = new PDO("mysql:host=$hostName; dbname=$dbName", $userName, $password);

    if(isset($_POST["action"]))
    {
        $query = "SELECT * FROM customers where reg = '1'";

        // if(isset($_POST["active"]))
        // {
        //     $query .= " AND c_status = '1'";
        // }

        // if(isset($_POST["inactive"]))
        // {
        //     $query .= " ";
        // }

        // if(isset($_POST["nothing"]))
        // {
        //     $query .= " AND c_status = '0'";
        // }
    
        if(isset($_POST['date']))
        {
            $ses = $_POST['date'];
            $query .= " AND c_date LIKE '$ses%'";
        }

        if(isset($_POST['branch']))
        {
            $query .= " AND branch_id = '".$_POST['branch']."'";
        }

        if(isset($_POST['search']))
        {
            $se = $_POST['search'];
            $query .= " AND c_name LIKE '$se%' AND c_status = '2' order by c_id desc";
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
                        <td data-column="Email">'.$row['c_ticket'].'</td>
                        <td data-column="Phone">'.$row['c_phone'].'</td>
                ';

                if($row['c_status'] == 0)
                {
                    $status =
                    '
                        <a href="customer_form?cust_id='.$row['c_id'].'"><i class="fas fa-align-left" title="Generate Form" style="color: red; font-size: 1.5em"></i></a>
                    ';

                    $link =
                    '
                        <b>Feedback Form Link: </b>Link not generated
                    ';
                }
                elseif($row['c_status'] == 2)
                {
                    $status =
                    '
                        <i class="fas fa-clipboard-list" title="Pending" style="color: #495ae1; font-size: 1.5em"></i>
                    ';

                    $link =
                    'https://www.divaspaqatar.com/feedback/branch/feedback_form?cust='.$row['c_code'].'&id='.$row['c_id'].'';
                }
                else
                {
                    $status =
                    '
                        <i class="fas fa-clipboard-check" title="Reviewed" style="color: #81be41; font-size: 1.5em"></i>
                    ';

                    $link =
                    '
                        <b>Feedback Form Link:</b> Submitted
                    ';
                }

                $output .=
                '
                        <td data-column="Status">'.$status.'</td>
                        <td data-column="Link" class="copy'.$row['c_id'].'">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="'.$link.'" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-info" type="button">Copy</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td data-column="Edit Details">
                            <button class="btn btn-warning btn-md" data-toggle="collapse" data-target="#collapse_'.$row['c_id'].'" 
                            aria-expanded="true" aria-controls="collapse_'.$row['c_id'].'">Edit</button>
                        </td>
                        <td data-column="Delete">
                            <form class="edit_cust'.$row['c_id'].'">
                                <input type="text" name="delete_customer" value="'.$row['c_id'].'" hidden>
                                <button type="submit" class="btn btn-danger btn-md btn-icon" title="Delete Customer"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <tr class="collapse edit_cust" id="collapse_'.$row['c_id'].'" style="border: 2px solid #ffa426;">
                        <td colspan="8" style="padding: 0">
                            <form class="edit_cust'.$row['c_id'].'">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td data-column="Date">'.$row['c_date'].'</td>
                                            <td data-column="Name"><input type="text" class="form-control" name="edit_cust_name" value="'.$row['c_name'].'"></td>
                                            <td data-column="Ticket"><input type="text" class="form-control" name="edit_cust_ticket" value="'.$row['c_ticket'].'"></td>
                                            <td data-column="Phone"><input type="text" class="form-control" name="edit_cust_phone" value="'.$row['c_phone'].'"></td>
                                            <td data-column="Status">'.$status.'</td>
                                            <td data-column="Edit Details" colspan="2">
                                                <input type="text" class="form-control" name="edit_cust_id" value="'.$row['c_id'].'" hidden>
                                                <button type="submit" class="btn btn-info btn-md">Update</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <script type="text/javascript">
                                $(".edit_cust'.$row['c_id'].'").submit(function(e)
                                {
                                    // alert("shd");
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
                                            if(data === "Customer details updated" || data === "Customer removed")
                                            {
                                                $( "#refresh_btn" ).trigger( "click" );
                                            }
                                        }
                                    });
                                    e.preventDefault();
                                });

                                (function()
                                {
                                    var copyButton = document.querySelector(".copy'.$row['c_id'].' button");
                                    var copyInput = document.querySelector(".copy'.$row['c_id'].' input");
                                    copyButton.addEventListener("click", function(e) {
                                        e.preventDefault();
                                        var text = copyInput.select();
                                        document.execCommand("copy");
                                        copyButton.classList.remove("btn-primary");
                                        copyButton.innerHTML = "Copied";
                                    });
                                    
                                    copyInput.addEventListener("click", function() {
                                        this.select();
                                    });
                                })();
                            </script>
                        </td>
                    </tr>
                ';
            }
        }
        else
        {
            $output = 
            '
            <tr>
                <td colspan="8"><h5>No Data Found</h5></td>
            </tr>
            ';
        }
        
        echo $output;

    }
    elseif(isset($_POST['newcustName']) && isset($_POST['newcustTicket']) && isset($_POST['newcustPhone']) && isset($_POST['branch_id']))
    {
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

        mysqli_query($link, "insert into customers (c_code, branch_id, c_name, c_ticket, c_phone, c_date) values ('$code', '".$_POST['branch_id']."', 
            '".$_POST['newcustName']."', '".$_POST['newcustTicket']."', '".$_POST['newcustPhone']."', '$order_date')");

        mysqli_query($link, "insert into cust_name_phone (cust_name, cust_phone) values ('".$_POST['newcustName']."', '".$_POST['newcustPhone']."')");

        echo "New customer registered";

    }
    elseif(isset($_POST['edit_cust_name']) && isset($_POST['edit_cust_ticket']) && isset($_POST['edit_cust_phone']) && isset($_POST['edit_cust_id']))
    {
        mysqli_query($link, "update customers set c_name = '".$_POST['edit_cust_name']."', c_ticket = '".$_POST['edit_cust_ticket']."', 
                    c_phone = '".$_POST['edit_cust_phone']."' where c_id = '".$_POST['edit_cust_id']."'");

        echo "Customer details updated";
    }
    elseif($_POST['delete_customer'])
    {
        mysqli_query($link, "delete from customers where c_id = '".$_POST['delete_customer']."'");

        echo "Customer removed";
    }
    else
    {
        echo "Server not responding. Try again";
    }
?>