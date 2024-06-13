<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  } else{



?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->
 <meta name="description" content="Insuracare in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Insuracare |    Policy History</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="../lib/morris.js/morris.css" rel="stylesheet">
    <link href="../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="../lib/jqvmap/jqvmap.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">

  </head>
  <body class="az-body az-body-sidebar">
      <!-- -sidebar -->
<?php include_once('includes/sidebar.php');?>
  <!-- -sidebar -->
    <div class="az-content az-content-dashboard-two">
     
     <!-- -header -->
<?php include_once('includes/header.php');?>

              <?php
           $uid=$_SESSION['uid'];
           $policynumber = mt_rand(100000000, 999999999);
$ret=mysqli_query($con,"select tbluser.FullName,tbluser.ContactNo,tbluser.Gender, category.CategoryName as catname, tblpolicy.PolicyName,tblpolicyholder.PolicyApplyDate as applydate,tblpolicy.ID as pid,tblpolicy.Sumassured,tblpolicy.Premium,tblpolicy.Tenure,tblpolicyholder.PolicyStatus,tblpolicyholder.PolicyNumber,tblpolicyholder.ID as tphid  from tblpolicy
 left join category on category.ID=tblpolicy.CategoryId 
 join tblpolicyholder on tblpolicyholder.PolicyId=tblpolicy.ID 
 join tbluser on tbluser.ID=tblpolicyholder.UserId where  tblpolicyholder.UserId='$uid'");
$cnt=1;
$count=mysqli_num_rows($ret);


?>
    </script>
  </body>
</html>
<?php }  ?>