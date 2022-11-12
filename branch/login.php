<?php
   
   // Initialize the session
   session_start();
   
   // Check if the user is already logged in, if yes then redirect him to welcome page
   if(isset($_SESSION["branch_loggedin"]) && $_SESSION["branch_loggedin"] === true)
   {
      header("location: dashboard");
      exit;
   }
   
   // Include config file
   require_once "../dbcon.php";

   // Define variables and initialize with empty values
   $branchId = $password = $err_msg = "";
   $branchId_err = $password_err = "";
 
    // Processing form data when form is submitted
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
   
      // Check if email is empty
      if(empty(trim($_POST["branchId"])))
      {
         $branchId_err = "Please enter Branch Id.";
      }
      else
      {
         $branchId = trim($_POST["branchId"]);
      }
      
      // Check if password is empty
      if(empty($_POST["password"]))
      {
         $password_err = "Please enter password.";
      }
      else
      {
         $password = $_POST["password"];
      }
      
      // Validate credentials
      if(empty($branchId_err) && empty($password_err))
      {
         $enpassword = md5($password);
         
         $login_sql = "SELECT * FROM locations WHERE l_id = '$branchId' and l_pass_enc = '$enpassword'";
         $result = mysqli_query($link, $login_sql);
         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
         $count = mysqli_num_rows($result);
         
         if($count == 1)
         {
            $_SESSION["branch_loggedin"] = true;
            $_SESSION['branchId_loggedin'] = $branchId;
            // $_SESSION['login_pass'] = $password;
            header("location: dashboard");
         }
         else
         {
            $err_msg =
            '
               <div class="alert alert-danger alert-dismissible show fade">
                  <div class="alert-body">
                     <button class="close" data-dismiss="alert">
                        <span>×</span>
                     </button>
                     Invalid Branch Id or Password.
                  </div>
               </div>
            ';
            // echo"<script>alert('Email or Password is invalid')</script>";  
            // echo "<script>location.href='login'</script>";
         }
      }
      
      // Close connection
      mysqli_close($link);
   }


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
   <title>Branch Login | diva lounge spa</title>
   <link rel="icon" href="../assets/img/diva-logo-sm.png" type="image/gif" sizes="32x32">
   <!-- General CSS Files -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

   <!-- Template CSS -->
   <link rel="stylesheet" href="../assets/css/style.css">
   <link rel="stylesheet" href="../assets/css/components.css">

   <style>
      a
      {
         text-decoration: none !important;
      }
   </style>
</head>
<body>

   <div id="app">
      <section class="section">
         <div class="container mt-5">
            <div class="row">
               <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                  <div class="login-brand">
                     <img src="../assets/img/diva-logo-sm.png" alt="diva lounge spa logo" width="100">
                  </div>
                  <div class="card card-primary">
                     <div class="card-header">
                        <h4>Branch Login</h4>
                     </div>
                     <?php echo $err_msg; ?>
                     <div class="card-body">
                        <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" novalidate="">
                           <div class="form-group <?php echo (!empty($branchId_err)) ? 'has-error' : ''; ?>">
                              <label for="branchId">Branch Id</label>
                              <input id="branchId" type="text" class="form-control" value="<?php echo $branchId; ?>" name="branchId" tabindex="1" required autofocus>
                              <div class="invalid-feedback">
                                 <?php echo $branchId_err; ?>
                              </div>
                           </div>
                           <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                              <label for="password" class="control-label">Password</label>
                              <input id="password" type="password" class="form-control" name="password" value="<?php echo $password; ?>" tabindex="2" required>
                              <div class="invalid-feedback">
                                 <?php echo $password_err; ?>
                              </div>
                           </div>
                           <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">
                              Login
                              </button>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="simple-footer">
                     <i class="fas fa-long-arrow-alt-left"></i> Go to <a href="../login">Admin Login</a>
                  </div>
                  <div class="simple-footer">
                     <a href="../new_customer">Add New Customer</a>
                  </div>
                  <div class="simple-footer">
                     Copyright &copy; <script>document.write(new Date().getFullYear());</script> Diva Lounge Spa
                     <br>
                     Designed by <a href="https://tecizasolutions.com/" target="_blank">Teciza Solution</a> &
                     Powered by <a href="https://thegraphe.com" target="_blank">The Graphē - A Design Studio</a>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>

</body>
</html>