<?php

    include('../../dbcon.php');

    $connect = new PDO("mysql:host=$hostName; dbname=$dbName", $userName, $password);

    if(isset($_POST["action"]))
    {
        $query = "SELECT * FROM cust_name_phone where reg = '1'";

        if(isset($_POST['number']))
        {
            $ses = $_POST['number'];
            $query .= " AND cust_phone LIKE '$ses%'";
        }

        if(isset($_POST['whatsapp']))
        {
            $ses = $_POST['whatsapp'];
            $query .= " AND whatsapp_num LIKE '$ses%'";
        }

        if(isset($_POST['search']))
        {
            $se = $_POST['search'];
            $query .= " AND cust_name LIKE '$se%'";
        }

        $query .= " order by cust_name limit 8";

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
                        <td>'.$row['cust_name'].'</td>
                        <td>'.$row['cust_phone'].'</td>
                        <td>'.$row['whatsapp_num'].'</td>
                        <td style="width: 10%">
                            <label class="custom-switch">
                                <input type="radio" name="option" class="custom-switch-input common_selector use" value="'.$row['cust_id'].'">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Select</span>
                            </label>
                            <input type="button" id="refresh_btn" value="Refresh" hidden>
                        </td>
                    </tr>
                ';
            }
            $output .=
            '
                <script>
                    $(document).ready(function(){

                        filter_data1();
            
                        function filter_data1()
                        {
                            var action1 = "fetch_data";
                            var cust_id = get_filter("use");
                            var branch_id = '.$_POST['branch_id'].';
                            // alert(cust_id);
                            $.ajax({
                                url:"processing/new_existing.php",
                                method:"POST",
                                data:{action1:action1, cust_id:cust_id, branch_id:branch_id},
                                success:function(data){
                                    $(".filter_data1").html(data);
                                }
                            });
                        }

                        function get_filter(class_name)
                        {
                            var filter = [];
                            $("."+class_name+":checked").each(function(){
                                filter.push($(this).val());
                            });
                            return filter;
                        }

                        $(".common_selector").on("keyup change",function(){
                            filter_data1();
                        });

                    });
                </script>
            ';
        }
        else
        {
            $output = 
            '
            <tr>
                <td colspan="2"><h5>No Data Found</h5></td>
            </tr>
            ';
        }
        
        echo $output;

    }
    elseif(isset($_POST["action1"]))
    {
        $query = "select * from cust_name_phone where reg = '1'";

        if(!empty($_POST['cust_id']))
        {
            $id = $_POST['cust_id'][0];
            $query .= " and cust_id = ".$id;
        }
        else
        {
            $query .= "";
        }

        $query .= " limit 1";

        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $total_row = $statement->rowCount();

        $output1 = '';

        $branch_id = $_POST['branch_id'];

        if($total_row > 0)
        {
            foreach($result as $row)
            {
                
            }

            $output1 .=
                '
                <form class="create_form_for_customer">
                    <div class="card profile-widget services-widget">
                        <div class="profile-widget-description">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                        Ticket
                                    </div>
                                    <p><input type="text" class="form-control" name="exTicket" required placeholder="Enter ticket number"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                        Name
                                    </div>
                                    <p><input type="text" id="cust_name" value="'.$row['cust_name'].'" class="form-control" name="exCustomer" readonly></p>
                                </div>                                
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                        Phone
                                    </div>
                                    <p><input type="text" id="cust_phone" value="'.$row['cust_phone'].'" class="form-control" name="exPhone" readonly></p>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                        Whatsapp
                                    </div>
                                    <p><input type="text" id="whatsapp" value="'.$row['whatsapp_num'].'" class="form-control" name="exWhatsapp" readonly></p>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="row">
                                <table class="table" id="mytable">
                                    <tbody>
                                        <tr>
                                            <td class="form-group">
                                                <label>Services</label>
                                                <select class="form-control" name="services[]" required>
                ';
                                                        $service = "select * from services order by se_name";
                                                        $get_service = mysqli_query($link, $service);
                                                        while($row_service = mysqli_fetch_array($get_service, MYSQLI_ASSOC))
                                                        {
                $output1 .=
                '
                                                        <option value="'.$row_service['se_id'].'">'.$row_service['se_name'].'</option>
                ';
                                                        }
                $output1 .=
                '
                                                </select>
                                            </td>
                                            <td class="form-group">
                                                <label>Staff</label>
                                                <select class="form-control" name="staff[]" required>
                ';
                                                        $staff = "select * from staffs order by st_name";
                                                        $get_staff = mysqli_query($link, $staff);
                                                        while($row_staff = mysqli_fetch_array($get_staff, MYSQLI_ASSOC))
                                                        {
                $output1 .=
                '
                                                        <option value="'.$row_staff['st_id'].'">'.$row_staff['st_name'].'</option>
                ';
                                                        }
                $output1 .=
                '
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="col-12 text-center">
                                    <span id="insert-more" class="btn btn-primary btn-icon btn-lg" title="Add new Row" style="cursor: pointer">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add More
                                    </span>
                                    <br><br>
                                    <input type="text" name="branch_id" value="'.$branch_id.'" hidden>
                                    <button class="btn btn-primary btn-lg" type="submit">Create Feedback Link</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                ';

            $output1 .=
            '
            <script>
            $("#insert-more").click(function () {
                $("#mytable").each(function () {
                    var tds = "<tr>";
                    jQuery.each($("tr:last td", this), function () {
                        tds += "<td>" + $(this).html() + "</td>";
                    });
                    tds += "</tr>";
                    if ($("tbody", this).length > 0) {
                        $("tbody", this).append(tds);
                    } else {
                        $(this).append(tds);
                    }
                });
            });

            $(document).ready(function(){

                $(".create_form_for_customer").submit(function(e)
                {
                    var form_data = $(this).serialize();
                    // alert(form_data);
                    var button_content = $(this).find("button[type=submit]");
                    button_content.addClass("disabled btn-progress");
                    $.ajax({
                        url: "processing/curd_form.php",
                        data: form_data,
                        type: "POST",
                        success: function(data)
                        {
                            alert(data);
                            if(data === "Customer registered and form created")
                            {
                                location.href="links";
                            }
                            button_content.removeClass("disabled btn-progress");
                        }
                    });
                    e.preventDefault();
                });
    
            });
        </script>
            ';
        }
        else
        {
            $output1 = 
            '
                No Data Found
            ';
        }

        echo $output1;
    }
    else
    {
        echo "Server not responding. Try again";
    }

?>