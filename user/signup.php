<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
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
  <head>

    <title>Insuracare Signup</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">
    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">
<script type="text/javascript">
function checkpass()
{
if(document.signup.password.value!=document.signup.repeatpassword.value)
{
alert('Password and Repeat Password field does not match');
document.signup.repeatpassword();
return false;
}
return true;
} 

</script>
  </head>
  <body class="az-body">

    <div class="az-signup-wrapper">
      <div class="az-column-signup-left">
        <div>
          
         <a href="../index.html"> <h1 class="az-logo">Insurance<span> Management</span> System</h1> </a>
        
        </div>
      </div><!-- az-column-signup-left -->
      <div class="az-column-signup">
        <h1 class="az-logo">I <span> M</span> S</h1>
        <div class="az-signup-header">
          <h2>Get Started</h2>
          <h4>It's free to signup and only takes a minute.</h4>

      <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>

          <form  method="post" name="signup" onsubmit="return checkpass();">
            <div class="form-group">
              <label>Fullname</label>
              <input type="text" class="form-control" placeholder="Enter your Full Name"  name="fullname" required="true">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Contact Number</label>
            <input type="text" class="form-control" placeholder="Enter your Contact Number"  name="contactnumber" maxlength="10" pattern="[0-9]+" required="true">
            </div><!-- form-group -->

            <div class="form-group">
              <label>Email id</label>
            <input type="email" class="form-control" placeholder="Enter your Email"  name="email"  required="true">
            </div><!-- form-group -->

<div class="form-group">
              <label>Gender</label>
  <input type="radio" name="gender" value="Female" checked="true">Female &nbsp;<input type="radio" name="gender" value="male" checked="true">Male
            </div><!-- form-group -->


<div class="form-group">
              <label>Passowrd</label>
       <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required="true">
            </div><!-- form-group -->


            <div class="form-group">
              <label>Confirm Password</label>
             <input type="password" class="form-control" placeholder="Repeat Password" name="repeatpassword" id="repeatpassword" required="true">
            </div><!-- form-group -->


            <button class="btn btn-az-primary btn-block" type="submit" name="submit">Create Account</button>
           <!-- row -->
          </form>
        </div><!-- az-signup-header -->
        <div class="az-signup-footer">
          <p>Already have an account? <a href="index.php">Sign In</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-column-signup -->
    </div><!-- az-signup-wrapper -->

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
