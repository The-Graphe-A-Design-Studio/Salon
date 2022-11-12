<?php

    include('../dbcon.php');

    $connect = new PDO("mysql:host=$hostName; dbname=$dbName", $userName, $password);

    if(isset($_POST["action"]))
    {
        $query = "select * from cust_name_phone where reg = 1";

        if(isset($_POST["branch"]))
        {
            if(!empty($_POST["branch"]))
            {
                $se = $_POST['branch'];
                $query .= " and cust_name like '$se%' or last_name like '$se%'";
            }
        }

        // if(!empty($_POST["start_date"]) && empty($_POST["end_date"]))
        // {
        //     $s_date = date_create($_POST["start_date"]);
        //     $s_date = date_format($s_date, "Y-m-d");
            
        //     $e_date = date_create($_POST["end_date"]);
        //     $e_date = date_format($e_date, "Y-m-d");

        //     $query .= " and c_date >= '".$s_date."'";
        // }
        // elseif(empty($_POST["start_date"]) && !empty($_POST["end_date"]))
        // {
        //     $s_date = date_create($_POST["start_date"]);
        //     $s_date = date_format($s_date, "Y-m-d");
            
        //     $e_date = date_create($_POST["end_date"]);
        //     $e_date = date_format($e_date, "Y-m-d");

        //     $query .= " and c_date <= '".$e_date."'";
        // }
        // elseif(!empty($_POST["start_date"]) && !empty($_POST["end_date"]))
        // {
        //     $s_date = date_create($_POST["start_date"]);
        //     $s_date = date_format($s_date, "Y-m-d");
            
        //     $e_date = date_create($_POST["end_date"]);
        //     $e_date = date_format($e_date, "Y-m-d");

        //     $query .= " and c_date >= '".$s_date."' and c_date <= '".$e_date."'";
        // }
        // else
        // {
        //     $query .= "";
        // }

        $query .= " order by cust_id desc";

        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();

        $output = '';
        
        if($total_row > 0)
        {
            $output .=
            '
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Whatsapp</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>#</th>
                    </thead>
                    <tbody>
            ';

            foreach($result as $row)
            {
                $output .=
                '
                    <tr>
                        <td data-column="Name">'.$row['cust_name'].' '.$row['last_name'].'</td>
                        <td data-column="Phone"><a href="tel:'.$row['cust_phone'].'" class="text-primary">'.$row['cust_phone'].'</a></td>
                        <td data-column="Whatsapp"><a href="https://wa.me/'.$row['whatsapp_num'].'" target="_blank" class="text-primary">'.$row['whatsapp_num'].'</a></td>
                        <td data-column="Email"><a href="mailto:'.$row['email'].'" class="text-primary">'.$row['email'].'</a></td>
                        <td data-column="City">'.$row['city'].'</td>
                        <td data-column="#">
                            <button class="btn btn-primary btn-icon" title="View customer details"
                            data-toggle="modal" data-target="#viewModal'.$row['cust_id'].'"><i class="fas fa-eye"></i></button>
                        </td>
                    <tr>
                ';            
            }

            $output .=
            '
                    </tbody>
                </table>
            ';

            foreach($result as $row)
            {
                $output .=
                '
                    <!-- Modal -->
                    <div class="mymodal modal fade" id="viewModal'.$row['cust_id'].'" tabindex="-1" role="dialog" aria-labelledby="viewModal'.$row['cust_id'].'Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModal'.$row['cust_id'].'Label">Customer Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="branch_form text-left">
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <b>Name : </b>'.$row['cust_name'].' '.$row['last_name'].'
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <b>Phone : </b><a href="tel:'.$row['cust_phone'].'" class="text-primary">'.$row['cust_phone'].'</a>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <b>Whatsapp : </b><a href="https://wa.me/'.$row['whatsapp_num'].'" target="_blank" class="text-primary">'.$row['whatsapp_num'].'</a>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <b>Email : </b><a href="mailto:'.$row['email'].'" class="text-primary">'.$row['email'].'</a>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <b>Birthday : </b>'.$row['cust_phone'].'
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <b>Anniversary : </b>'.$row['cust_phone'].'
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <b>Work Phone : </b><a href="tel:'.$row['work_phone'].'" class="text-primary">'.$row['work_phone'].'</a>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <b>Qatar ID : </b>'.$row['qatar_id'].'
                                            </li>
                                            <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                                                <span><b>Address : </b></span><span class="text-wrap">'.$row['address_1'].', '.$row['address_2'].', '.$row['city'].'- '.$row['zip'].', 
                                                                '.$row['state'].', '.$row['country'].'</span>
                                            </li>
                                            <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                                                <span><b>Other : </b></span><span class="text-wrap">'.$row['others'].'</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                ';            
            }
        }
        else
        {
            $output = 
            '
                No Data Found
            ';
        }
        
        echo $output;

    }

?>