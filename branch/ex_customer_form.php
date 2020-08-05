<?php
    include('session.php');
    include('layout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Customers | diva lounge spa</title>
    <?php echo $head_tags; ?>
    <style>
        .table:not(.table-sm):not(.table-md):not(.dataTable) td, .table:not(.table-sm):not(.table-md):not(.dataTable) th
        {
            padding: 0.75rem !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
        <?php
            echo $nav_bar;
            echo $side_bar;
        ?>

        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Existing Customers Form</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item active"><a href="customers">Customers</a></div>
                        <div class="breadcrumb-item">Existing Customers Form</div>
                    </div>
                </div>

                <div class="section-body text-right">
                    <div class="buttons">
                        <a href="customer_form"><button class="btn btn-primary btn-lg">Add new Customer</button></a>
                    </div>
                </div>

                <br><br>

                <div class="section-body">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-12 col-sm-12 col-md-2">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="false">Search by Name</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Search by Number</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-10">
                                    <div class="tab-content no-padding" id="myTab2Content">
                                        <div class="tab-pane fade active show" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                            <form class="create_form_for_customer">
                                                <div class="row mt-sm-4">
                                                
                                                    <div class="col-12 col-md-2 cl-lg-2"></div>

                                                    <div class="col-12 col-md-8 cl-lg-8">
                                                        <div class="card profile-widget services-widget">
                                                            <div class="profile-widget-description">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-4 col-lg-4">
                                                                        <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                                            Name
                                                                        </div>
                                                                        <p>
                                                                            <select class="form-control" id="cust_name" name="exCustomer" required>
                                                                            <option value="">-- Select Name --</option>
                                                                            <?php
                                                                                    $name = "select * from cust_name_phone order by cust_name";
                                                                                    $get_name = mysqli_query($link, $name);
                                                                                    while($row_name = mysqli_fetch_array($get_name, MYSQLI_ASSOC))
                                                                                    {
                                                                                ?>
                                                                                    <option value="<?php echo $row_name['cust_name']; ?>"><?php echo $row_name['cust_name']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 col-lg-4">
                                                                        <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                                            Ticket
                                                                        </div>
                                                                        <p><input type="text" class="form-control" name="exTicket" required></p>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 col-lg-4">
                                                                        <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                                            Phone
                                                                        </div>
                                                                        <p><input type="text" id="cust_phone" class="form-control" name="exPhone" required></p>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="card profile-widget services-widget">
                                                            <div class="profile-widget-description">
                                                                <table class="table" id="mytable">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="form-group">
                                                                                <label>Services</label>
                                                                                <select class="form-control" name="services[]" required>
                                                                                    <?php
                                                                                        $service = "select * from services order by se_name";
                                                                                        $get_service = mysqli_query($link, $service);
                                                                                        while($row_service = mysqli_fetch_array($get_service, MYSQLI_ASSOC))
                                                                                        {
                                                                                    ?>
                                                                                        <option value="<?php echo $row_service['se_id']; ?>"><?php echo $row_service['se_name']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </td>
                                                                            <td class="form-group">
                                                                                <label>Staff</label>
                                                                                <select class="form-control" name="staff[]" required>
                                                                                    <?php
                                                                                        $staff = "select * from staffs order by st_name";
                                                                                        $get_staff = mysqli_query($link, $staff);
                                                                                        while($row_staff = mysqli_fetch_array($get_staff, MYSQLI_ASSOC))
                                                                                        {
                                                                                    ?>
                                                                                        <option value="<?php echo $row_staff['st_id']; ?>"><?php echo $row_staff['st_name']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="text-center">
                                                                    <span id="insert-more" class="btn btn-primary btn-icon btn-lg" title="Add new Row" style="cursor: pointer"><i class="fas fa-plus"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-2 cl-lg-2"></div>
                                                    
                                                    <div class="col-12 text-center">
                                                        <!-- <input type="text" name="customer_id" value="<?php echo $cust_id; ?>" hidden> -->
                                                        <input type="text" name="branch_id" value="<?php echo $branch_id_session; ?>" hidden>
                                                        <button class="btn btn-primary btn-lg" type="submit">Create Form</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                        <form class="create_form_for_customer">
                                                <div class="row mt-sm-4">
                                                
                                                    <div class="col-12 col-md-2 cl-lg-2"></div>

                                                    <div class="col-12 col-md-8 cl-lg-8">
                                                        <div class="card profile-widget services-widget">
                                                            <div class="profile-widget-description">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-4 col-lg-4">
                                                                        <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                                            Phone
                                                                        </div>
                                                                        <p>
                                                                            <select class="form-control" id="cust_phonee" name="exPhone" required>
                                                                            <option value="">-- Select Phone --</option>
                                                                            <?php
                                                                                    $name = "select * from cust_name_phone order by cust_phone";
                                                                                    $get_name = mysqli_query($link, $name);
                                                                                    while($row_name = mysqli_fetch_array($get_name, MYSQLI_ASSOC))
                                                                                    {
                                                                                ?>
                                                                                    <option value="<?php echo $row_name['cust_phone']; ?>"><?php echo $row_name['cust_phone']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 col-lg-4">
                                                                        <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                                            Ticket
                                                                        </div>
                                                                        <p><input type="text" class="form-control" name="exTicket" required></p>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 col-lg-4">
                                                                        <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                                                            Name
                                                                        </div>
                                                                        <p><input type="text" id="cust_namee" class="form-control" name="exCustomer" required></p>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="card profile-widget services-widget">
                                                            <div class="profile-widget-description">
                                                                <table class="table" id="mytable">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="form-group">
                                                                                <label>Services</label>
                                                                                <select class="form-control" name="services[]" required>
                                                                                    <?php
                                                                                        $service = "select * from services order by se_name";
                                                                                        $get_service = mysqli_query($link, $service);
                                                                                        while($row_service = mysqli_fetch_array($get_service, MYSQLI_ASSOC))
                                                                                        {
                                                                                    ?>
                                                                                        <option value="<?php echo $row_service['se_id']; ?>"><?php echo $row_service['se_name']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </td>
                                                                            <td class="form-group">
                                                                                <label>Staff</label>
                                                                                <select class="form-control" name="staff[]" required>
                                                                                    <?php
                                                                                        $staff = "select * from staffs order by st_name";
                                                                                        $get_staff = mysqli_query($link, $staff);
                                                                                        while($row_staff = mysqli_fetch_array($get_staff, MYSQLI_ASSOC))
                                                                                        {
                                                                                    ?>
                                                                                        <option value="<?php echo $row_staff['st_id']; ?>"><?php echo $row_staff['st_name']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="text-center">
                                                                    <span id="insert-more" class="btn btn-primary btn-icon btn-lg" title="Add new Row" style="cursor: pointer"><i class="fas fa-plus"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-2 cl-lg-2"></div>
                                                    
                                                    <div class="col-12 text-center">
                                                        <!-- <input type="text" name="customer_id" value="<?php echo $cust_id; ?>" hidden> -->
                                                        <input type="text" name="branch_id" value="<?php echo $branch_id_session; ?>" hidden>
                                                        <button class="btn btn-primary btn-lg" type="submit">Create Form</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php echo $footer; ?>
        </div>
    </div>

    <?php echo $script_tags; ?>
    <script type="text/javascript">

        $(document).ready(function(){

            $(".create_form_for_customer").submit(function(e)
            {
                var form_data = $(this).serialize();
                // alert(form_data);
                var button_content = $(this).find('button[type=submit]');
                button_content.addClass("disabled btn-progress");
                $.ajax({
                    url: 'processing/curd_form.php',
                    data: form_data,
                    type: 'POST',
                    success: function(data)
                    {
                        alert(data);
                        if(data === "Customer registered and form created")
                        {
                            location.href="customers";
                        }
                        button_content.removeClass("disabled btn-progress");
                    }
                });
                e.preventDefault();
            });

        });

        $(document).ready(function(){
            $(".customers").addClass("active");
        });
        
        
        $('#cust_name').on('change',function(){
            var cName = $(this).val();
            if(cName){
                $.ajax({
                type:'POST',
                url:'processing/existing.php',
                data:'cust_name='+cName,
                success:function(html){
                        $('#cust_phone').val(html);
                }
                }); 
            }else{
                $('#cust_phone').html('Select Name first');
            }
        });

        $('#cust_phonee').on('change',function(){
            var cName = $(this).val();
            if(cName){
                $.ajax({
                type:'POST',
                url:'processing/existing.php',
                data:'cust_phone='+cName,
                success:function(html){
                        $('#cust_namee').val(html);
                }
                }); 
            }else{
                $('#cust_namee').html('Select Phone first');
            }
        });
      </script>

    <script>
        $("#insert-more").click(function () {
            $("#mytable").each(function () {
                var tds = '<tr>';
                jQuery.each($('tr:last td', this), function () {
                    tds += '<td>' + $(this).html() + '</td>';
                });
                tds += '</tr>';
                if ($('tbody', this).length > 0) {
                    $('tbody', this).append(tds);
                } else {
                    $(this).append(tds);
                }
            });
        });
    </script>
</body>
</html>