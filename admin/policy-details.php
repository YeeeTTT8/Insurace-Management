<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_GET['tphid']))
{

$pid=$_GET['tphid'];
$status=$_GET['apid'];


$query=mysqli_query($con,"update  tblpolicyholder set PolicyStatus='$status' where ID='$pid'");
    echo "<script>alert('Policy Status has been Updated.');</script>";
echo "<script>window.location.href='all-policies.php'</script>";

}

?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->
 <meta name="description" content="Insuracare in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Insuracare |   Approved Policy </title>

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
          <h2 class="az-content-title mg-b-5 mg-b-lg-8"> Policy Details</h2>
        </div>
       <!-- az-dashboard-header-right -->
      </div><!-- az-content-header -->
      <div class="az-content-body">
      

     <div class="az-content">
      <div class="container">
        <div class="az-content-body">
          <div class="az-content-breadcrumb">
            <span>Insurance </span>
            <span> Policy Details</span>
          </div>
  

          <div class="az-content-label mg-b-5"> Policy Details</div>
<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
          <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
    
              <?php
           $pid=intval($_GET['pid']);
       
$ret=mysqli_query($con,"select tblpolicyholder.UpdationDate,tbluser.FullName,tbluser.ContactNo,tbluser.Gender, category.CategoryName as catname,tblsubcategory.SubcategoryName as subcat, tblpolicy.PolicyName,tblpolicyholder.PolicyApplyDate as applydate,tblpolicy.ID,tblpolicy.Sumassured,tblpolicy.Premium,tblpolicy.Tenure,tblpolicyholder.PolicyStatus,tblpolicyholder.PolicyNumber,tblpolicyholder.ID as tphid,policyDetails  from tblpolicy 
  left join category on category.ID=tblpolicy.CategoryId 
  left join tblsubcategory on  tblsubcategory.id=tblpolicy.SubcategoryId  
  join tblpolicyholder on tblpolicyholder.PolicyId=tblpolicy.ID 
  join tbluser on tbluser.ID=tblpolicyholder.UserId where  tblpolicyholder.ID ='$pid'");
$cnt=1;
$count=mysqli_num_rows($ret);


?>
              <tbody></tbody><?php if($count>0){ 
                while ($row=mysqli_fetch_array($ret)) { ?>
                <tr>
<th>Policy Holder Name</th>
 <td><?php  echo $row['FullName'];?></td>
   <th>Policy Holder Contact No.</th>
   <td><?php  echo $row['ContactNo'];?></td>

</tr>

     <tr>          <th>Policy Holder Gender</th>
                  <td><?php  echo $row['Gender'];?></td>   
                      <th>Policy Name</th>  
                       <td><?php  echo $row['PolicyName'];?></td>
                     </tr>

<tr><th>Category Name</th>
                  <td><?php  echo $row['catname'];?></td>
                  <th>SubCategory Name</th>
                  <td><?php  echo $row['subcat'];?></td>
         </tr>
         <tr> <th>Sum Assured</th>
                  <td><?php  echo $row['Sumassured'];?></td>
                   <th>Premium</th>
                  <td><?php  echo $row['Premium'];?></td>
                </tr>
                <tr>  <th>Tenure</th>
                  <td><?php  echo $row['Tenure'];?></td>

                  <th>Apply Date</th>
                   <td><?php  echo $row['applydate'];?></td>
                 </tr>
                 <tr>
                  <th>Status</th>
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
                    <th>Action Date</th>
                        <td><?php  echo $row['UpdationDate'];?></td>
                  </tr>
                  <tr>
                       <th>Policy Details</th>
                        <td colspan="3"><?php  echo $row['policyDetails'];?></td>
                  </tr>
                  <tr>
                 <td colspan="4">
                  <?php if($row['PolicyStatus']=='0'):?>
                   <a href="policy-details.php?tphid=<?php  echo $row['tphid'];?>&&apid=1" class="btn btn-success"> Approve </a> |   <a href="policy-details.php?tphid=<?php  echo $row['tphid'];?>&&apid=2" class="btn btn-danger"> Disapprove </a>
                 <?php elseif($row['PolicyStatus']=="1"):?>
                  <a href="policy-details.php?tphid=<?php  echo $row['tphid'];?>&&apid=2" class="btn btn-danger"> Disapprove </a>
                     <?php elseif($row['PolicyStatus']=="2"):?>
                          <a href="policy-details.php?tphid=<?php  echo $row['tphid'];?>&&apid=1" class="btn btn-success"> Approve </a>
                        <?php endif;?>

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