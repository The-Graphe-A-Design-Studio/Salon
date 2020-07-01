<?php
    include('session.php');
    include('layout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Services | diva lounge spa</title>
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
                    <h1>Categories</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">Categories</div>
                    </div>
                </div>
                <div class="section-body text-right">
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Add new Category</button>
                    
                    <!-- Modal -->
                    <div class="mymodal modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add new Branch</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="branch_form text-left">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="branchName">Branch Name</label>
                                            <input type="text" class="form-control" name="newbranchName" placeholder="Enter Branch Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="branchAddress">Branch Address</label>
                                            <textarea class="form-control" style="height: 100px;" name="newbranchAddress" placeholder="Enter Branch Address" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="branchPhone">Branch Phone</label>
                                            <input type="text" class="form-control" name="newbranchPhone" placeholder="Enter Branch Phone number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="branchPassword">Branch Password</label>
                                            <input type="text" class="form-control" name="newbranchPassword" placeholder="Enter Branch Password" required>
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
                            $category = "select * from categories order by s_name asc";
                            $get_category = mysqli_query($link, $category);
                            while($row_category = mysqli_fetch_array($get_category, MYSQLI_ASSOC))
                            {
                                $categories[] = $row_category;
                            }
                            foreach($categories as $cat)
                            {
                        ?>
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="card profile-widget services-widget">
                                    <div class="profile-widget-description" data-toggle="collapse" data-target="#collapse<?php echo $cat['s_id']; ?>" 
                                        aria-expanded="true" aria-controls="collapse<?php echo $cat['s_id']; ?>" style="cursor: pointer">
                                        <div class="profile-widget-name" style="margin-bottom: 0 !important">
                                            <?php echo $cat['s_name']; ?>
                                            <i class="fas fa-caret-down" style="float: right"></i>
                                        </div>
                                    </div>
                                    <div class="collapse" id="collapse<?php echo $cat['s_id']; ?>" style="">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card" style="box-shadow: none !important; margin-bottom: 0 !important">
                                                    <div class="card-header">
                                                        <h4>Services</h4>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive my-table-responsive">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>Create a mobile app</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <a href="categories_edit?s_id=<?php echo $cat['s_id']; ?>&s_name=<?php echo $cat['s_name']; ?>">
                                                                            <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                                                                <button type="button" class="btn btn-primary btn-lg" title="Add Service"><i class="fas fa-folder-plus"></i></button>
                                                                                <button type="button" class="btn btn-primary btn-lg" title="Edit Service"><i class="fas fa-edit"></i></button>
                                                                                <button type="button" class="btn btn-primary btn-lg" title="Delete Service"><i class="fas fa-trash"></i></button>
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
                                        <!-- <form class="branch_form">
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?php echo $cat['s_id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $cat['s_id']; ?>">
                                                Cancel
                                            </button>
                                        </form> -->
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
        $(".branch_form").submit(function(e)
		{
			var form_data = $(this).serialize();
			// alert(form_data);
			var button_content = $(this).find('button[type=submit]');
			button_content.addClass("disabled btn-progress");
            $.ajax({
				url: 'processing/curd_location.php',
				data: form_data,
				type: 'POST',
				success: function(data)
				{
                    alert(data);
                    button_content.removeClass("disabled btn-progress");
					if(data === "Branch details updated" || data === "New branch added" || data === "Branch removed")
					{
						location.href="locations";
					}
				}
			});
			e.preventDefault();
		});

        $(document).ready(function()
        {
            $(".categories").addClass("active");
        });
    </script>
</body>
</html>