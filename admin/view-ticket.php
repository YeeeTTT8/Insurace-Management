<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
    if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    
     $cid=$_GET['aticid'];
     $admrmk=$_POST['description'];
    
     
   $query=mysqli_query($con, "update  tblticket set AdminRemark='$admrmk' where ID='$cid'");
    if ($query) {
    $msg="Ticket Remark has been updated.";
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

    <title>Ticket Form!!</title>

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
          <h2 class="az-content-title mg-b-5 mg-b-lg-8">Ticket Details !</h2>
        </div>
       <!-- az-dashboard-header-right -->
      </div><!-- az-content-header -->
      <div class="az-content-body">
     

        <div class="row row-sm mg-b-20 mg-lg-b-0">
          <div class="col-md-12 col-xl-7">
            <div class="card card-table-two">
              <h6 class="card-title"> Ticket Info</h6>
            <form method="post">
        <p style="font-size:16px; color:red" align="left"> <?php if($msg){
    echo $msg;
  }  ?> </p>
         <?php
$cid=$_GET['aticid'];
$ret=mysqli_query($con,"select * from tblticket
 join tbluser on tbluser.ID=tblticket.UserId 
 where tblticket.ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

<table border="1" class="table table-bordered mg-b-0">
  <tr>
    <th>Ticket ID :</th>
    <td><?php  echo $row['ID'];?></td>
  </tr>
   <tr>
    <th>Ticket Generation Date</th>
    <td><?php  echo $row['TicketGenerationDate'];?></td>
  </tr>
     <tr>
    <th>User name</th>
    <td><?php  echo $row['FullName'];?></td>
  </tr>

     <tr>
    <th>Username  Email/ Contact no</th>
    <td><?php  echo $row['Email'];?>/<?php  echo $row['ContactNo'];?></td>
  </tr>
<tr>
    <th>Subject</th>
    <td><?php  echo $row['Subject'];?></td>
  </tr>

<tr>
    <th>Nature Of Issue</th>
    <td><?php  echo $row['NatureofIssue'];?></td>
  </tr>

  <tr>
    <th>Description</th>
    <td><?php  echo $row['Description'];?></td>
  </tr>

<?php if($row['AdminRemark']==""){ ?>
<form method="post">
<tr>
    <th>Admin Remark :</th>
    <td>
    <textarea name="description" placeholder="Desribe  your Issue" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr>

  <tr align="center">
    <td colspan="2"><button type="submit" name="submit" class="btn btn-az-primary pd-x-20">Update</button></td>
  </tr>
  </form>
<?php } else { ?>

<tr>
    <th>Admin Remark</th>
    <td><?php echo $row['AdminRemark']; ?></td>
  </tr>


<tr>
<th>Admin Remark date</th>
<td>
<?php echo $row['AdminRemarkdate']; ?>
  </td>
  </tr>

  <?php } ?>

</table>

<?php } ?>
</body>



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
</html>

<?php } ?>