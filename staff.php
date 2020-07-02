<?php
    include('session.php');
    include('layout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Staffs | diva lounge spa</title>
    <?php echo $head_tags; ?>
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
                    <h1>Staffs</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">Staffs</div>
                    </div>
                </div>
                <div class="section-body text-right">
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Add new Staff</button>
                    
                    <!-- Modal -->
                    <div class="mymodal modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add new Staff</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="staff_form text-left">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="staffName">Staff Name</label>
                                            <input type="text" class="form-control" name="newstaffName" placeholder="Enter Staff Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select class="form-control" name="newstaffBranch" required>
                                                <?php
                                                    $branch = "select * from locations";
                                                    $get_branch = mysqli_query($link, $branch);
                                                    while($row_branch = mysqli_fetch_array($get_branch, MYSQLI_ASSOC))
                                                    {
                                                ?>
                                                    <option value="<?php echo $row_branch['l_id']; ?>"><?php echo $row_branch['l_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row mt-sm-4">
                        <?php
                            $branch = "select * from locations order by l_name asc";
                            $get_branch = mysqli_query($link, $branch);
                            while($row_branch = mysqli_fetch_array($get_branch, MYSQLI_ASSOC))
                            {
                                $branchs[] = $row_branch;
                            }
                            foreach($branchs as $loc)
                            {
                        ?>
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="card profile-widget services-widget">
                                    <div class="profile-widget-description" data-toggle="collapse" data-target="#collapse<?php echo $loc['l_id']; ?>" 
                                        aria-expanded="true" aria-controls="collapse<?php echo $loc['l_id']; ?>" style="cursor: pointer">
                                        <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                            <?php echo $loc['l_name']; ?>
                                            <i class="fas fa-caret-down" style="float: right"></i>
                                        </div>
                                    </div>
                                    <div class="collapse" id="collapse<?php echo $loc['l_id']; ?>" style="">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card" style="box-shadow: none !important; margin-bottom: 0 !important">
                                                    <div class="card-header">
                                                        <h4>Staffs</h4>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive my-table-responsive">
                                                            <table class="table">
                                                                <?php
                                                                    $i = 1;
                                                                    $gets = "select * from staffs where l_id = '".$loc['l_id']."' order by st_name";
                                                                    $run_gets = mysqli_query($link, $gets);
                                                                    $counts = mysqli_num_rows($run_gets);
                                                                    if($counts >= 1)
                                                                    {
                                                                        while($row_gets = mysqli_fetch_array($run_gets, MYSQLI_ASSOC))
                                                                        {
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $i; ?></td>
                                                                    <td class="text-left">
                                                                        <?php echo $row_gets['st_name']; ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                            $i++;
                                                                        }
                                                                    }
                                                                    else
                                                                    {
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            No Staffs found
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                    }
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center" colspan="2">
                                                                        <a href="staffs_edit?l_id=<?php echo $loc['l_id']; ?>&l_name=<?php echo $loc['l_name']; ?>">
                                                                            <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                                                                <button type="button" class="btn btn-primary btn-lg" title="Add Staffs"><i class="fas fa-folder-plus"></i></button>
                                                                                <button type="button" class="btn btn-primary btn-lg" title="Edit Staff Details"><i class="fas fa-edit"></i></button>
                                                                                <button type="button" class="btn btn-primary btn-lg" title="Remove Staff"><i class="fas fa-trash"></i></button>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>

        <?php echo $footer; ?>
        </div>
    </div>

    <?php echo $script_tags; ?>

    <script type="text/javascript">
        $(".staff_form").submit(function(e)
		{
			var form_data = $(this).serialize();
			// alert(form_data);
			var button_content = $(this).find('button[type=submit]');
			button_content.addClass("disabled btn-progress");
            $.ajax({
				url: 'processing/curd_staff.php',
				data: form_data,
				type: 'POST',
				success: function(data)
				{
                    alert(data);
                    button_content.removeClass("disabled btn-progress");
					if(data === "New staff registered")
					{
						location.href="staff";
					}
				}
			});
			e.preventDefault();
		});

        $(document).ready(function()
        {
            $(".staffs").addClass("active");
        });
    </script>
</body>
</html>