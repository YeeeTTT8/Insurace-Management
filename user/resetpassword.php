
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//error_reporting(0);

if(isset($_POST['submit']))
  {
    $contactno=$_SESSION['contactno'];
    $email=$_SESSION['email'];
    $password=$_POST['newpassword'];

        $query=mysqli_query($con,"update tbluser set Password='$password'  where  Email='$email' && ContactNo='$contactno' ");
   if($query)
   {
echo "<script>alert('Password successfully changed');</script>";
session_destroy();
   }
  
  }
  ?>




<!DOCTYPE html>
<html lang="en">
  <head>


    <!-- Meta -->
    <meta name="description" content="Insuracare in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Insuracare | Reset Password</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword();
return false;
}
return true;
} 

</script>
  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <h1 class="az-logo">Insurance <span>Management</span> &nbsp;&nbsp;System</h1>
        <div class="az-signin-header">
          <h2>Reset Your Password!</h2>
          
          <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>

          <form name="changepassword" method="post" onsubmit="return checkpass();">
            <div class="form-group">
              <label>New Password</label>
      <input type="password" class="form-control" placeholder="Enter your New Password"  name="newpassword" required="true">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Confirm Password</label>
    <input type="password" class="form-control" placeholder="Confirm Your Password" name="confirmpassword" required="true">
            </div><!-- form-group -->
            <button class="btn btn-az-primary btn-block" type="submit" name="submit">Reset</button>
          </form>
        </div><!-- az-signin-header -->

         <div class="az-signin-footer">
          
          <p>Don't have an account? <a href="signup.php">Create an Account</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>

    <script src="../js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>
