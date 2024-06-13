<?php session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{


  ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->
 <meta name="description" content="Insuracare in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Insuracare |  B/w Dates Policy Report</title>

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
          <h2 class="az-content-title mg-b-5 mg-b-lg-8">Search Policy</h2>
        </div>
       <!-- az-dashboard-header-right -->
      </div><!-- az-content-header -->
      <div class="az-content-body">
      

        <div class="row row-sm mg-b-20 mg-lg-b-0">
          <div class="col-md-12 col-xl-7">
            <div class="card card-table-two">
              <h6 class="card-title"> Search Policy by Policy No/ Policy Folder Name / Number</h6>
              <hr />

 <form method="post" action="">
            <div class="wd-sm-600">
              <div class="d-md-flex mg-b-20">
                <div class="form-group mg-b-0">
                  <label class="form-label">Enter Policy No/ Policy Folder Name / Number <span class="tx-danger">*</span></label>
                  <input type="text" name="searchdata" class="form-control wd-550"  required= "true">
                </div><!-- form-group -->
 </div>


              <button type="submit" name="submit" class="btn btn-az-primary pd-x-20">Submit</button>
            </div>
          </form>

            </div><!-- card-dashboard-five -->
          </div>
    
        </div><!-- row -->

<hr />
<?php if(isset($_POST['submit'])){
$sdata=$_POST['searchdata'];


 ?>
         <div class="az-content-label mg-b-20" align="center"> Policy  Results against keyword "<?php echo $sdata;?></div>
<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
          <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                   <th>Policy Holder Name</th>
                      <th>Policy Holder Contact No.</th>
                       <th>Policy Holder Gender</th>
                  <th>Policy Name</th>
                  <th>Policy Number</th>
                  <th>Category Name</th>
     
                  <th>Apply Date</th>
                  <th>Status</th>
                  <th>Action</th>
                   
                </tr>
              </thead>
              <?php

$ret=mysqli_query($con,"select tbluser.FullName,tbluser.ContactNo,tbluser.Gender, category.CategoryName as catname, tblpolicy.PolicyName,tblpolicyholder.PolicyApplyDate as applydate,tblpolicy.ID as pid,tblpolicy.Sumassured,tblpolicy.Premium,tblpolicy.Tenure,tblpolicyholder.PolicyStatus,tblpolicyholder.PolicyNumber,tblpolicyholder.ID as tphid  from tblpolicy
 left join category on category.ID=tblpolicy.CategoryId 
 join tblpolicyholder on tblpolicyholder.PolicyId=tblpolicy.ID 
 join tbluser on tbluser.ID=tblpolicyholder.UserId
where tblpolicyholder.PolicyNumber like '%$sdata%' || tbluser.FullName like '%$sdata%'  || tbluser.ContactNo like '%$sdata%' ");
$cnt=1;
$count=mysqli_num_rows($ret);


?>
              <tbody></tbody><?php if($count>0){ 
                while ($row=mysqli_fetch_array($ret)) { ?>
                <tr>
                  <td><?php echo $cnt;?></td>
 <td><?php  echo $row['FullName'];?></td>
                       <td><?php  echo $row['ContactNo'];?></td>
                  <td><?php  echo $row['Gender'];?></td>
                  
                       <td><?php  echo $row['PolicyName'];?></td>
                       <td><?php  echo $row['PolicyNumber'];?></td>
                  <td><?php  echo $row['catname'];?></td>
    
                   <td><?php  echo $row['applydate'];?></td>
                          <td><?php 
                  if($row['PolicyStatus']=="0"){ ?>
 <span class="badge badge-warning">waiting for approval</span>
<?php } if($row['PolicyStatus']=="1"){ ?>
<span class="badge badge-success">Approved</span>
<?php } if($row['PolicyStatus']=="2"){ ?>
 <span class="badge badge-danger">Disapproved</span>
<?php }              ?>
                      
<?php if($row['PolicyStatus']=="1"){ ?>
<a href="download-policy.php?pid=<?php  echo $row['pid'];?>" title="Download Policy"> Download </a>
<?php } ?>

                    </td>
                 <td>
                  <a href="policy-details.php?pid=<?php  echo $row['tphid'];?>" class="btn btn-info">View</a>
                   <!-- <a href="pending-policy.php?tphid=<?php  echo $row['tphid'];?>&&apid=1"> Approve </a> |   <a href="pending-policy.php?tphid=<?php  echo $row['tphid'];?>&&apid=2"> Disapprove </a> -->

                 </td>   
                       
                </tr>
                <?php 
$cnt=$cnt+1;
} } else { ?>
 <tr>
    <td colspan="14" style="color:red; font-size:14px;">No Record found</td>
  </tr>
<?php } ?>  
               
              </tbody>
            </table>
          </div>
<?php } ?>

      </div><!-- az-content-body -->
    <!-- footer -->
    <?php include_once('includes/footer.php');?>
    </div><!-- az-content -->


    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="../lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="../lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="../lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../js/azia.js"></script>
    <script src="../js/dashboard.sampledata.js"></script>
    <script>
      $(function(){
        'use strict'

        $('.az-sidebar .with-sub').on('click', function(e){
          e.preventDefault();
          $(this).parent().toggleClass('show');
          $(this).parent().siblings().removeClass('show');
        })

        $(document).on('click touchstart', function(e){
          e.stopPropagation();

          // closing of sidebar menu when clicking outside of it
          if(!$(e.target).closest('.az-header-menu-icon').length) {
            var sidebarTarg = $(e.target).closest('.az-sidebar').length;
            if(!sidebarTarg) {
              $('body').removeClass('az-sidebar-show');
            }
          }
        });


        $('#azSidebarToggle').on('click', function(e){
          e.preventDefault();

          if(window.matchMedia('(min-width: 992px)').matches) {
            $('body').toggleClass('az-sidebar-hide');
          } else {
            $('body').toggleClass('az-sidebar-show');
          }
        });

        new PerfectScrollbar('.az-sidebar-body', {
          suppressScrollX: true
        });

        /* ----------------------------------- */
        /* Dashboard content */


        $.plot('#flotChart1', [{
            data: dashData1,
            color: '#6f42c1'
          }], {
          series: {
            shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0 }, { opacity: 1 } ] }
            }
          },
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
          yaxis: {
            show: false,
            min: 0,
            max: 100
          },
          xaxis: { show: false }
        });

        $.plot('#flotChart2', [{
            data: dashData2,
            color: '#007bff'
          }], {
          series: {
            shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0 }, { opacity: 1 } ] }
            }
          },
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
          yaxis: {
            show: false,
            min: 0,
            max: 100
          },
          xaxis: { show: false }
        });

        $.plot('#flotChart3', [{
            data: dashData3,
            color: '#f10075'
          }], {
          series: {
            shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0 }, { opacity: 1 } ] }
            }
          },
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
          yaxis: {
            show: false,
            min: 0,
            max: 100
          },
          xaxis: { show: false }
        });

        $.plot('#flotChart4', [{
            data: dashData4,
            color: '#00cccc'
          }], {
          series: {
            shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0 }, { opacity: 1 } ] }
            }
          },
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
          yaxis: {
            show: false,
            min: 0,
            max: 100
          },
          xaxis: { show: false }
        });

        $.plot('#flotChart5', [{
            data: dashData2,
            color: '#00cccc'
          },{
            data: dashData3,
            color: '#007bff'
          },{
            data: dashData4,
            color: '#f10075'
          }], {
          series: {
            shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: false,
              fillColor: { colors: [ { opacity: 0 }, { opacity: 1 } ] }
            }
          },
          grid: {
            borderWidth: 0,
            labelMargin: 20
          },
          yaxis: {
            show: false,
            min: 0,
            max: 100
          },
          xaxis: {
            show: true,
            color: 'rgba(0,0,0,.16)',
            ticks: [
              [0, ''],
              [10, '<span>Nov</span><span>05</span>'],
              [20, '<span>Nov</span><span>10</span>'],
              [30, '<span>Nov</span><span>15</span>'],
              [40, '<span>Nov</span><span>18</span>'],
              [50, '<span>Nov</span><span>22</span>'],
              [60, '<span>Nov</span><span>26</span>'],
              [70, '<span>Nov</span><span>30</span>'],
            ]
          }
        });

        $.plot('#flotChart6', [{
            data: dashData2,
            color: '#6f42c1'
          },{
            data: dashData3,
            color: '#007bff'
          },{
            data: dashData4,
            color: '#00cccc'
          }], {
          series: {
            shadowSize: 0,
            stack: true,
            bars: {
              show: true,
              lineWidth: 0,
              fill: 0.85
              //fillColor: { colors: [ { opacity: 0 }, { opacity: 1 } ] }
            }
          },
          grid: {
            borderWidth: 0,
            labelMargin: 20
          },
          yaxis: {
            show: false,
            min: 0,
            max: 100
          },
          xaxis: {
            show: true,
            color: 'rgba(0,0,0,.16)',
            ticks: [
              [0, ''],
              [10, '<span>Nov</span><span>05</span>'],
              [20, '<span>Nov</span><span>10</span>'],
              [30, '<span>Nov</span><span>15</span>'],
              [40, '<span>Nov</span><span>18</span>'],
              [50, '<span>Nov</span><span>22</span>'],
              [60, '<span>Nov</span><span>26</span>'],
              [70, '<span>Nov</span><span>30</span>'],
            ]
          }
        });

        $('#vmap').vectorMap({
          map: 'world_en',
          showTooltip: true,
          backgroundColor: '#f8f9fa',
          color: '#ced4da',
          colors: {
            us: '#6610f2',
            gb: '#8b4bf3',
            ru: '#aa7df3',
            cn: '#c8aef4',
            au: '#dfd3f2'
          },
          hoverColor: '#222',
          enableZoom: false,
          borderOpacity: .3,
          borderWidth: 3,
          borderColor: '#fff',
          hoverOpacity: .85
        });

      });
    </script>
  </body>
</html>
<?php }  ?>