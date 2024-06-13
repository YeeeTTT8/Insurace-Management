 <div class="az-header">
        <div class="container-fluid">
          <div class="az-header-left">
            <a href="" id="azSidebarToggle" class="az-header-menu-icon"><span></span></a>
          </div><!-- az-header-left -->
          
          <div class="az-header-right">
       <!-- az-header-notification -->
            <div class="dropdown az-profile-menu">
              <a href="" class="az-img-user"><img src="../images/user.png" alt=""></a>
              <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                  <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="az-header-profile">
                  <div class="az-img-user">
                    <img src="../images/user.png" alt="">
                  </div><!-- az-img-user -->
                <?php
$uid=$_SESSION['uid'];
$ret=mysqli_query($con,"select FullName from tbluser where ID='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['FullName'];

?>
                  <span style="font-weight: bold"><?php echo $name; ?></span>
              
                 
          <span>User</span>
                      
                   
                </div><!-- az-header-profile -->

                <a href="user-profile.php" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                <a href="changepassword.php" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Change Password</a>
                <a href="logout.php" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
              </div><!-- dropdown-menu -->
            </div>
          </div><!-- az-header-right -->
        </div><!-- container -->
      </div><!-- az-header -->