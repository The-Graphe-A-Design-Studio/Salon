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
                    <h1>Services</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="dashboard">Dashboard</a></div>
                        <div class="breadcrumb-item">Services</div>
                    </div>
                </div>
                <div class="section-body text-right">
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Add new Service</button>
                    
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
                                            <input type="text" class="form-control" name="newbranchName" placeholder="Enter Branch Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="branchAddress">Branch Address</label>
                                            <textarea class="form-control" style="height: 100px;" name="newbranchAddress" placeholder="Enter Branch Address"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="branchPhone">Branch Phone</label>
                                            <input type="text" class="form-control" name="newbranchPhone" placeholder="Enter Branch Phone number">
                                        </div>
                                        <div class="form-group">
                                            <label for="branchPassword">Branch Password</label>
                                            <input type="text" class="form-control" name="newbranchPassword" placeholder="Enter Branch Password">
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>All Categories</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-3">
                                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-9">
                                            <div class="tab-content no-padding" id="myTab2Content">
                                                <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                </div>
                                                <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                                    Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                                                </div>
                                                <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                                    Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                                                </div>
                                            </div>
                                        </div>
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
            $(".services").addClass("active");
        });
    </script>
</body>
</html>