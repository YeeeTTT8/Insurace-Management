<?php   session_start();
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

    <title>Insuracare |  Ticket History</title>

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
          <h2 class="az-content-title mg-b-5 mg-b-lg-8">Ticket History!</h2>
        </div>
       <!-- az-dashboard-header-right -->
      </div><!-- az-content-header -->
      <div class="az-content-body">
      

     <div class="az-content">
      <div class="container">
        <div class="az-content-body">
          <div class="az-content-breadcrumb">
            <span>Ticket History </span>
            
          </div>
  

          <div class="az-content-label mg-b-5">Ticket History Details</div>

          <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Subject</th>
                  <th>Nature of Issue</th>
                   <th>Ticket Generation Date</th>
                   <th>Action</th>
                </tr>
              </thead>
              <?php
              $tid=$_SESSION['uid'];
$ret=mysqli_query($con,"select * from tblticket where UserId=$tid");
$cnt=1;
$count=mysqli_num_rows($ret);
?>
              <tbody>
              <?php  if($count>0){
               while ($row=mysqli_fetch_array($ret)) { ?>
                <tr>
                  <td><?php echo $cnt;?></td>
                       <td><?php  echo $row['Subject'];?></td>
                  <td><?php  echo $row['NatureofIssue'];?></td>
                  <td><?php  echo $row['TicketGenerationDate'];?></td>
         
                  <td><a href="ticket-view.php?ticid=<?php echo $row['ID'];?>">View Ticket Detail</a>
                </tr>
                <?php 
$cnt=$cnt+1;
} } else {?>
  <tr>
    <td colspan="5" style="color:red; font-size:14px;">No Record found</td>
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