
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['signin']))
  {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query=mysqli_query($con,"select ID from tbluser where  Email='$email' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['uid']=$ret['ID'];
     header('location:dashboard.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }
  ?>




<!DOCTYPE html>
<html lang="en">
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

          <form name="login" method="post">
            <div class="form-group">
              <label>Email</label>
      <input type="email" class="form-control" placeholder="Enter your email"  name="email" required="true">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
    <input type="password" class="form-control" placeholder="Enter your password" name="password" required="true">
            </div><!-- form-group -->
            <button class="btn btn-az-primary btn-block" type="submit" name="signin">Sign In</button>
          </form>
        </div><!-- az-signin-header -->

         <div class="az-signin-footer">
          <p><a href="forget-password.php">Forgot password?</a></p>
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
