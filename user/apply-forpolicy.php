<?php   session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_GET['polid']))
{
$userid=$_SESSION['uid'];
$pid=$_GET['polid'];
$status=0;
$policynumber = mt_rand(100000000, 999999999);
$ret=mysqli_query($con,"select ID from tblpolicyholder where UserId='$userid' and PolicyId='$pid'");
$row=mysqli_fetch_array($ret);
if($row >0)
{
 echo "<script>alert('You already applied for this Policy.');</script>";
echo "<script>window.location.href='apply-forpolicy.php'</script>";
} else {
$query=mysqli_query($con,"insert into  tblpolicyholder(UserId,PolicyId,PolicyStatus,PolicyNumber) value('$userid','$pid','$status','$policynumber')");
 echo "<script>alert('You have successfully applied for Policy.');</script>";
echo "<script>window.location.href='policy-history.php'</script>";

}
}
?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->
 <meta name="description" content="Insuracare in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Insuracare |  Apply for  Policy </title>

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
  <!-- -header -->

      <div class="az-content-header d-block d-md-flex">
        <div>
          <h2 class="az-content-title mg-b-5 mg-b-lg-8">Apply for Policy  !</h2>
        </div>
       <!-- az-dashboard-header-right -->
      </div><!-- az-content-header -->
      <div class="az-content-body">
      

     <div class="az-content">
      <div class="container">
        <div class="az-content-body">
          <div class="az-content-breadcrumb">
            <span>Insurance </span>
            <span>Apply Policy</span>
          </div>
  

          <div class="az-content-label mg-b-5">Policy Detail Details</div>
          <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Policy Name</th>
             
                  <th>Category Name</th>
                   <th>SubCategory Name</th>
                   
                   <th>Sum Assured</th>
                   <th>Premium</th>
                   <th>Tenure</th>
                  <th>Creation Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
$ret=mysqli_query($con,"select category.CategoryName as catname,tblsubcategory.SubcategoryName as subcat, tblpolicy.PolicyName,tblpolicy.CreationDate as cdate,tblpolicy.ID,tblpolicy.Sumassured,tblpolicy.Premium,tblpolicy.Tenure  
  from tblpolicy 
  left join category on category.ID=tblpolicy.CategoryId
   left join tblsubcategory on  tblsubcategory.id=tblpolicy.SubcategoryId");
$cnt=1;
$count=mysqli_num_rows($ret);
?>
              <tbody>
               <?php  if($count>0){
               while ($row=mysqli_fetch_array($ret)) { ?>
                <tr>
                  <td><?php echo $cnt;?></td>
                       <td><?php  echo $row['PolicyName'];?></td>
                    
                  <td><?php  echo $row['catname'];?></td>
                  <td><?php  echo $row['subcat'];?></td>
         
                  <td><?php  echo $row['Sumassured'];?></td>
                  <td><?php  echo $row['Premium'];?></td>
                  <td><?php  echo $row['Tenure'];?></td>
                   <td><?php  echo $row['cdate'];?></td>
                  <td><a href="apply-forpolicy.php?polid=<?php echo $row['ID'];?>" class="btn btn-primary">Apply </a></td>
                </tr>
                <?php 
$cnt=$cnt+1;
} } else {?>
  <tr>
    <td colspan="8" style="color:red; font-size:14px;">No Policy listed yet</td>
  </tr>
<?php } ?>
               
              </tbody>
            </table>
          </div>

            </div><!-- card-dashboard-five -->
          </div>
    
        </div><!-- row -->
      </div><!-- az-content-body -->
    <!-- footer -->
    <?php include_once('includes/footer.php');?>
    </div><!-- az-content -->


    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>
    <script src="../lib/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../lib/raphael/raphael.min.js"></script>
    <script src="../lib/morris.js/morris.min.js"></script>
    <script src="../lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="../lib/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="../js/azia.js"></script>
    
  </body>
</html>
<?php }  ?>