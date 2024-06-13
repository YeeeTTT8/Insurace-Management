  <div class="az-sidebar">
      <div class="az-sidebar-header">
        <a href="#" class="az-logo">I<span>M</span>S | User</a>
      </div><!-- az-sidebar-header -->
      <div class="az-sidebar-loggedin">
        <div class="az-img-user online"><img src="../images/user.png" alt=""></div>
        <div class="media-body">
              
             <?php
$uid=$_SESSION['uid'];
$ret=mysqli_query($con,"select FullName from tbluser where ID='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['FullName'];

?>
                  <span style="font-weight: bold"><?php echo $name; ?></span>
              
                 
          <span>User</span>
        </div><!-- media-body -->
      </div><!-- az-sidebar-loggedin -->
      <div class="az-sidebar-body">
         <ul class="nav">
          <li class="nav-label">Main Menu</li>
             <li class="nav-item show">
            <a href="dashboard.php" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i>Dashboard</a>
          </li>
          <li class="nav-item show">
            <a href="#" class="nav-link with-sub"><i class="typcn typcn-clipboard"></i>Insurance </a>
            <nav class="nav-sub">
              <a href="apply-forpolicy.php" class="nav-sub-link">Apply</a>
              <a href="policy-history.php" class="nav-sub-link">History</a>
         
            </nav>
          </li>
 <li class="nav-item show">
            <a href="#" class="nav-link with-sub"><i class="typcn typcn-messages"></i>Ticket </a>
            <nav class="nav-sub">
              <a href="tickets.php" class="nav-sub-link">Genrate</a>
              

            </nav>
          </li>


          <!-- nav-item -->
          </ul>
      </div><!-- az-sidebar-body -->
    </div>