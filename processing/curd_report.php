<?php

    include('../dbcon.php');

    $connect = new PDO("mysql:host=$hostName; dbname=$dbName", $userName, $password);

    if(isset($_POST["action"]))
    {
        $query = "SELECT * FROM customers where reg = '1'";

        if(isset($_POST["branch"]))
        {
            $query .= " AND branch_id = '".$_POST["branch"]."'";
        }

        if(isset($_POST["start_date"]) && isset($_POST["end_date"]))
        {
            $date = date_create("10 Jul, 2020");
            echo date_format($date,"Y-m-d");

            $query .= " AND c_status = '2'";
        }

        $query .= " order by c_id desc";
        
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
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-value">'.$row['c_name'].'</div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">
                                    '.$row['c_email'].' 
                                    <div class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div>
                                        '.$row['c_phone'].'
                                    </div>
                                </div>
                                <div class="card" style="box-shadow: 0 !important; margin-bottom: 0 !important;">
                                    <div class="card-header" style="padding: 0 !important; min-height: 20px !important;">
                                        <h4>Services used</h4>
                                    </div>
                                    <div class="card-body" style="padding: 0 !important">
                                        <ul class="list-group">
                ';

                                            $re = "select * from review_form where c_code = '".$row['c_code']."'";
                                            $get_re = mysqli_query($link, $re);
                                            while($row_re = mysqli_fetch_array($get_re, MYSQLI_ASSOC))
                                            {
                                                $service = "select * from services where se_id = '".$row_re['se_id']."'";
                                                $get_service = mysqli_query($link, $service);
                                                $row_service = mysqli_fetch_array($get_service, MYSQLI_ASSOC);
                $output .=
                '
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    '.$row_service['se_name'].'
                                                    <span class="badge badge-primary badge-pill">'.$row_re['rating'].'/5</span>
                                                </li>
                ';
                                            }
                                            if($row['c_return'] == 1)
                                            {
                                                $return = "Definitely";
                                            }
                                            elseif($row['c_return'] == 2)
                                            {
                                                $return = "May be";
                                            }
                                            elseif($row['c_return'] == 3)
                                            {
                                                $return = "Definitely Not";
                                            }
                                            else
                                            {
                                                $return = "Form not submitted";
                                            }
                $output .=
                '
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <b>Visit Again : </b>'.$return.'
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <b>Comment : </b>'.$row['c_comment'].'
                                                </li>
                                        </ul>
                                    </div>
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
            <tr>
                <td colspan="8"><h5>No Data Found</h5></td>
            </tr>
            ';
        }
        
        echo $output;

    }

?>