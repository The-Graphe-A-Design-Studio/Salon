<?php

    include('../dbcon.php');

    $connect = new PDO("mysql:host=$hostName; dbname=$dbName", $userName, $password);

    if(isset($_POST["action"]))
    {
        $query = "select * from cust_name_phone where reg = 1";

        if(isset($_POST["searchID"]))
        {
            if(!empty($_POST["searchID"]))
            {
                $se1 = $_POST['searchID'];
                $query .= " and cust_id like '%$se1%'";
            }
        }

        if(isset($_POST["searchName"]))
        {
            if(!empty($_POST["searchName"]))
            {
                $se2 = $_POST['searchName'];
                $query .= " and cust_name like '%$se2%' or last_name like '%$se2%'";
            }
        }

        if(isset($_POST["searchPhone"]))
        {
            if(!empty($_POST["searchPhone"]))
            {
                $se3 = $_POST['searchPhone'];
                $query .= " and con_cust_phone like '%$se3%' or cust_phone like '%$se3%'";
            }
        }

        if(isset($_POST["searchWhatsapp"]))
        {
            if(!empty($_POST["searchWhatsapp"]))
            {
                $se4 = $_POST['searchWhatsapp'];
                $query .= " and con_whatsapp_num like '%$se4%' or whatsapp_num like '%$se4%'";
            }
        }
        
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
                        <th>ID</th>
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
                        <td data-column="ID">'.$row['cust_id'].'</td>
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
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <b>ID : </b>'.$row['cust_id'].'
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><b>Name : </b>'.$row['cust_name'].' '.$row['last_name'].'</span>
                                            <span><b>Email : </b><a href="mailto:'.$row['email'].'" class="text-primary">'.$row['email'].'</a></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <span title="Phone"><b><i class="fas fa-phone"></i> : </b><a href="tel:'.$row['con_cust_phone'].$row['cust_phone'].'" class="text-primary">
                                                            '.$row['con_cust_phone'].' '.$row['cust_phone'].'</a></span>                                        
                                            <span title="Whatsapp"><b><i class="fab fa-whatsapp"></i> : </b><a href="https://wa.me/'.$row['con_whatsapp_num'].$row['whatsapp_num'].'" target="_blank" class="text-primary">
                                                                '.$row['con_whatsapp_num'].' '.$row['whatsapp_num'].'</a></span>
                                            <span title="Work Phone"><b><i class="fas fa-briefcase"></i> : </b><a href="tel:'.$row['con_work_phone'].$row['work_phone'].'" class="text-primary">
                                                                '.$row['con_work_phone'].' '.$row['work_phone'].'</a></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><b>Birthday : </b>'.$row['birthday'].'</span>
                                            <span><b>Anniversary : </b>'.$row['anniversary'].'</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><b>Qatar ID : </b>'.$row['qatar_id'].'</span>
                                            <span><b>Category : </b>'.$row['cust_category'].'</span>
                                        </li>
                                        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                                            <span><b>Address : </b></span><span class="text-wrap">'.$row['address_1'].', '.$row['address_2'].', 
                                                            '.$row['address_3'].', '.$row['city'].'- '.$row['zip'].', '.$row['state'].', 
                                                            '.$row['country'].'</span>
                                        </li>
                                        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                                            <span><b>Do you have skin allergies? : </b></span>
                                            <span class="text-wrap">'.$row['skin_allergy'].'</span>
                                        </li>
                                        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                                            <span><b>Do you have back problem? : </b></span>
                                            <span class="text-wrap">'.$row['back_problem'].'</span>
                                        </li>
                                        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                                            <span><b>Blood Pressure : </b></span>
                                            <span class="text-wrap">'.$row['blood_pressure'].'</span>
                                        </li>
                                        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                                            <span><b>How did you hear about us? : </b></span>
                                            <span class="text-wrap">'.$row['hear_ab_us'].'</span>
                                        </li>
                                        <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                                            <span><b>Other : </b></span><span class="text-wrap">'.$row['others'].'</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary">Close</button>
                                </div>
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