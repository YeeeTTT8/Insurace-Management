
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//error_reporting(0);

if(isset($_POST['submit']))
  {
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];

        $query=mysqli_query($con,"select ID from tbluser where  Email='$email' and ContactNo='$contactno' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['contactno']=$contactno;
      $_SESSION['email']=$email;
     header('location:resetpassword.php');
    }
    else{
      $msg="Invalid Details. Please try again.";
    }
  }
  ?>




<!DOCTYPE html>
<html lang="en">
  <head>


    <!-- Meta -->
    <meta name="description" content="Insuracare in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Insuracare | Forget Password</title>

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
          <h2>Recover Your Password!</h2>
         
          <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>

          <form name="login" method="post">
            <div class="form-group">
              <label>Email</label>
      <input type="email" class="form-control" placeholder="Enter your email"  name="email" required="true">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Contact Number</label>
    <input type="text" class="form-control" placeholder="Enter your Contact Number" name="contactno" required="true">
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
