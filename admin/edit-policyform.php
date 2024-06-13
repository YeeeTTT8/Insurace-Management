<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
     $sid=$_GET['polid'];
    $catid=$_POST['category'];
    $subcat=$_POST['subcategory'];
        $polname=$_POST['policyname'];
    $sumass=$_POST['sumassured'];
    $pri=$_POST['premium'];
    $tenure=$_POST['tenure'];
     $pdetails=$_POST['policydetails'];
    $query=mysqli_query($con, "update  tblpolicy set CategoryId='$catid', SubcategoryId='$subcat', PolicyName='$polname', Sumassured='$sumass', Premium='$pri',Tenure='$tenure',policyDetails='$pdetails' where ID='$sid'");
    if ($query) {
    $msg="Policy form has been updated.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

  
}
  ?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->
 <meta name="description" content="Insuracare in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Policy Form!!</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="../lib/morris.js/morris.css" rel="stylesheet">
    <link href="../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="../lib/jqvmap/jqvmap.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">
 <script>
function getSubCat(val) {
  $.ajax({
type:"POST",
url:"get-subcat.php",
data:'catid='+val,
success:function(data){
$("#subcategory").html(data);
}

  });


}
  
  
  </script>
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
          <h2 class="az-content-title mg-b-5 mg-b-lg-8">Policy Form !</h2>
        </div>
       <!-- az-dashboard-header-right -->
      </div><!-- az-content-header -->
      <div class="az-content-body">
     

        <div class="row row-sm mg-b-20 mg-lg-b-0">
          <div class="col-md-12 col-xl-7">
            <div class="card card-table-two">
              <h6 class="card-title"> Fill the Info</h6>
            <form method="post">
        <p style="font-size:16px; color:red" align="left"> <?php if($msg){
    echo $msg;
  }  ?>
    
  </p>
  <?php 
  $sid=$_GET['polid'];
$ret=mysqli_query($con,"select policyDetails,category.CategoryName as catname,category.ID as catid,tblsubcategory.SubcategoryName as subcat,tblsubcategory.id as scatid, tblpolicy.PolicyName,tblpolicy.CreationDate as cdate,tblpolicy.ID,tblpolicy.Sumassured,tblpolicy.Premium,tblpolicy.Tenure  from tblpolicy left join category on category.ID=tblpolicy.CategoryId 
  left join tblsubcategory on  tblsubcategory.id=tblpolicy.SubcategoryId 
  where tblpolicy.id='$sid'" );
while ($row=mysqli_fetch_array($ret)) {
 
  ?> </p>



         <div class="d-flex flex-column wd-md-650 pd-30 pd-sm-40 bg-gray-200">
               <div class="form-group">
                  <label class="form-label">Category <span class="tx-danger">*</span></label>
                  <select name="category" id="category" required="true" class="form-control wd-450" onChange="getSubCat(this.value)" >
                    <option value="<?php echo $row['catid'];?>"><?php echo $row['catname'];?></option>
                    <?php $query=mysqli_query($con,"select * from category");
              while($rw=mysqli_fetch_array($query))
              {
              ?>      
                  <option value="<?php echo $rw['ID'];?>"><?php echo $rw['CategoryName'];?></option>
                  <?php } ?>
                                </select>
                </div>
                <!-- form-group -->
              
               <div class="form-group">
                  <label class="form-label">Sub Category Name: <span class="tx-danger">*</span></label>
                  <select name="subcategory"  id="subcategory" class="form-control wd-450" required="true">
                    <option value="<?php echo $row['scatid'];?>"><?php echo $row['subcat'];?></option>
                
              
                  </select>
                  </div>
<div class="form-group">
                  <label class="form-label">Policy Name: <span class="tx-danger">*</span></label>
                  <input type="text" name="policyname" class="form-control wd-450" required="true" value="<?php echo $row['PolicyName'];?>">
                </div>
                
<div class="form-group">
                  <label class="form-label">Sum Assured: <span class="tx-danger">*</span></label>
                  <input type="text" name="sumassured" class="form-control wd-450" required="true" value="<?php echo $row['Sumassured'];?>">
                </div>

                <div class="form-group">
                  <label class="form-label">Premium: <span class="tx-danger">*</span></label>
                  <input type="text" name="premium" class="form-control wd-450" required="true" value="<?php echo $row['Premium'];?>">
                </div>
<div class="form-group">
                  <label class="form-label">Tenure: <span class="tx-danger">*</span></label>
                  <input type="text" name="tenure" class="form-control wd-450" required="true" value="<?php echo $row['Tenure'];?>">
                </div>
      <div class="form-group">
                  <label class="form-label">Policy Details <span class="tx-danger">*</span></label>
                  <textarea class="form-control wd-450" rows="8" required="true" name="policydetails"><?php echo $row['policyDetails'];?></textarea>
                </div> 


                <?php } ?>
            

            <div class="form-group" align="center">
              <button type="submit" name="submit" class="btn btn-az-primary pd-x-20">Update</button>
            </div>
            </div></div>
              </div><!-- d-flex -->
            
          </form>

            </div><!-- card-dashboard-five -->
          </div>
    
       <!-- az-content-body -->
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
<?php  } ?>
