<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['signin']))
  {
    $fname=$_POST['fullname'];
    $contno=$_POST['contactnumber'];
    $email=$_POST['email'];
    $gen=$_POST['gender'];
    $Password=$_POST['password'];

    $ret=mysqli_query($con, "select Email from tbluser where Email='$email'");
    $result=mysqli_fetch_array($ret);
    if($result>0){
$msg="This email already associated with another account";
    }
    else{
    $query=mysqli_query($con, "insert into tbluser(FullName, ContactNo, Email, Gender,  Password) value('$fname', '$contno', '$email','$gen', '$Password' )");
    if ($query) {
    $msg="You have successfully registered";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}
}

 ?>





<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
function checkpass()
{
if(document.register.Password.value!=document.register.RepeatPassword.value)
{
alert('Password and Repeat Password field does not match');
document.register.RepeatPassword();
return false;
}
return true;
} 

</script>

  <head>


    <!-- Meta -->
    <meta name="description" content="Insuracare in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Insuracare | User Login</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <h1 class="az-logo">Insurance <span>Management</span> &nbsp;&nbsp;System</h1>
        <div class="az-signin-header">
          <h2>Welcome back!</h2>
          <h4>Please sign in to continue</h4>
          <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>

          <form name="login" method="post" >
            <div class="form-group">
              <label>Full Name</label>
      <input type="text" class="form-control" placeholder="Enter your Full Name"  name="fullname" required="true">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Contact Number</label>
      <input type="text" class="form-control" placeholder="Enter your Contact Number"  name="contactnumber" maxlength="10" pattern="[0-9]+" required="true">
            
            </div><!-- form-group -->

<div class="form-group">
              <label>Email</label>
      <input type="email" class="form-control" placeholder="Enter your Email"  name="email"  required="true">
            
            </div><!-- form-group -->
            <div class="form-group">
              <label>Gender</label>
     <input type="radio" name="gender" value="Female" checked="true">Female<input type="radio" name="gender" value="male" checked="true">Male
            
            </div><!-- form-group -->



            <div class="form-group">
             <label>Password</label>
    <input type="password" class="form-control" placeholder="Enter your password" name="password" required="true">
            </div><!-- form-group -->
 <div class="form-group">
             <label>Repeat Password</label>
    <input type="password" class="form-control" placeholder="Repeat Password" name="repeatpassword" required="true">
            </div><!-- form-group -->

            <button class="btn btn-az-primary btn-block" type="submit" name="signin">Sign In</button>
          </form>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer" >
           <a class="small" href="index.php" style="font-size: 13px">Already have an account? Login!</a>
       
          <p>Back to Home Page <a href="#">Click Here</a></p>
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