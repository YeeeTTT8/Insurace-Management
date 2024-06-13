<?php session_start();
error_reporting(0);
include('user/includes/dbconnection.php');

// User Registration
if(isset($_POST['submit']))
  {
    $fname=$_POST['fullname'];
    $contno=$_POST['contactnumber'];
    $email=$_POST['email'];
    $gen=$_POST['gender'];
    $Password=$_POST['password'];

    $ret=mysqli_query($con, "select Email from tbluser where Email='$email'");
    $result=mysqli_fetch_array($ret);
    if($result>0){
echo "<script>alert('This email already associated with another account');</script>";
echo "<script>window.location.href='index.php'</script>";
    }
    else{
    $query=mysqli_query($con, "insert into tbluser(FullName, ContactNo, Email, Gender,  Password) value('$fname', '$contno', '$email','$gen', '$Password' )");
    if ($query) {
echo "<script>alert('You have successfully registered');</script>";
echo "<script>window.location.href='index.php'</script>";
  }else{
echo "<script>alert('Something Went Wrong. Please try again');</script>";
echo "<script>window.location.href='index.php'</script>";
    }
}
}

// User Signin
if(isset($_POST['signin']))
  {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query=mysqli_query($con,"select ID from tbluser where  Email='$email' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['uid']=$ret['ID'];
     header('location:user/dashboard.php');
    }
    else{
  echo "<script>alert('Invalid details');</script>";
echo "<script>window.location.href='index.php'</script>";
    }
  }


  // Password Recovery
  if(isset($_POST['pwdreset']))
  {
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];
 $password=$_POST['newpassword'];
    $query=mysqli_query($con,"select ID from tbluser where  Email='$email' and ContactNo='$contactno' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
  $query=mysqli_query($con,"update tbluser set Password='$password'  where  Email='$email' && ContactNo='$contactno' ");
  echo "<script>alert('Password reset successfully.');</script>";
echo "<script>window.location.href='index.php'</script>";
    }else{
echo "<script>alert('Invalid details. Please Try again');</script>";
echo "<script>window.location.href='index.php'</script>";
    }
  }

 ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Insuracare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <!-- how it works -->
    <link href="css/timeline.css" type="text/css" rel="stylesheet" media="all">
    <!-- grid hover -->
    <link href="css/hover.css" type="text/css" rel="stylesheet" media="all">
    <!-- font-awesome icons -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- //online-fonts -->
    <script type="text/javascript">
function checkpass()
{
if(document.register.Password.value!=document.register.RepeatPassword.value)
{
alert('Password and Repeat Password field does not match');
document.register.RepeatPassword();
return false;
}
return true;
} 
</script>
</head>

<body>
    <!-- banner -->
    <div class="banner" id="home">
        <!-- header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary">
                <h1>
                    <a class="navbar-brand text-white" href="index.php">
                    Insuracare
                    </a>
                </h1>
                <button class="navbar-toggler ml-md-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-lg-auto text-center">
                        <li class="nav-item active  mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link scroll" href="#about">about</a>
                        </li>
                    
                        <li class="nav-item mr-lg-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="admin/index.php">Admin</a>
                        </li>
                        <li>
                            <button type="button" class="btn  ml-lg-2 w3ls-btn" data-toggle="modal" aria-pressed="false"
                                data-target="#exampleModal">
                                <i class="far fa-user-circle"></i>
                            </button>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- //header -->
        <div class="container">
            <div class="banner-text">
                <div class="slider-info">
                    <h3>HEALTHGUARD HUB:<br>
                    YOUR WELLNESS SHIELD</h3>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- //banner -->
    <!-- about -->
    <div class="about-w3sec py-sm-5" id="about">
        <div class="container py-5">
            <div class="title-section pb-4">
                <h3 class="main-title-agile">YOU ARE IN GOOD HANDS</h3>
            </div>
            <div class="ins-sec1">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="abt-block mb-lg-0 mb-5">
                            <div class="serv_abs serv_bottom">
                                <i class=""></i>
                            </div>
                            <h3> UP TO 365 DAYS/YEAR</h3>
                            <p>Elevate your health insurance experience with plans that cover you up to 365 days/year. Never worry about gaps in your protection-your health is our priority, every single day.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 my-lg-0 my-md-5">
                        <div class="abt-block">
                            <div class="serv_abs serv_bottom">
                                <i class=""></i>
                            </div>
                            <h3>SMART COVERAGE / SMART CARE</h3>
                            <p>Experience personalized insurance solutions with our cutting-edge MLmodel.We calculate your ideal coverage and present a curated list of policies</p>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-lg-0 mt-md-5">
                        <div class="abt-block mt-md-0 mt-5">
                            <div class="serv_abs serv_bottom">
                                <i class=""></i>
                            </div>
                            <h3>YOUR INSURANCE  YOUR WAY</h3>
                            <p>Navigate the insurance
landscape effortlessly. Our Al
model tailors recommendations
for you, ensuring your coverage
aligns with your unique
requirements. Take it a step
further by exploring a network
of local hospitals supporting
your chosen policy. Your
insurance, your way,simplifed.</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-lg-5">
                    <div class="col-lg-8 mx-auto mt-5">
                        <div class="row">
                            <div class="col-lg-6 my-lg-0 my-md-5">
                                <div class="abt-block">
                                    <div class="serv_abs  serv_bottom">
                                        <i class=""></i>
                                    </div>
                                    <h3>24/7 Customer Support</h3>
                                    <p>Access to round-the-clock customer service ensures that clients can get assistance whenever they need it, day or night.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-lg-0 mt-5">
                                <div class="abt-block">
                                    <div class="serv_abs  serv_bottom">
                                        <i class=""></i>
                                    </div>
                                    <h3>Transparent Pricing and Policies</h3>
                                    <p>Provide transparent pricing and policy information to clients, including details on premiums, deductibles, co-pays, and coverage limitations, fostering trust and confidence in the insurance provider.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //about -->
    <!-- stats -->
    <section class="agile_stats py-sm-5" id="more">
        <div class="container">
            <div class="py-lg-5 w3-abbottom">
                <div class="row py-5">
                    <div class="counter col-lg-3 col-6">
                        <i class="far fa-smile"></i>
                        <div class="timer count-title count-number mt-2 text-white" data-to="5100" data-speed="1500"></div>
                        <p class="count-text text-capitalize text-white">happy clients</p>
                    </div>

                    <div class="counter col-lg-3 col-6">
                        <i class="fas fa-database"></i>
                        <div class="timer count-title count-number mt-2 text-white" data-to="971" data-speed="1500"></div>
                        <p class="count-text text-capitalize text-white">insurance projects</p>
                    </div>
                    <div class="counter col-lg-3 col-6 mt-lg-0 mt-4">
                        <i class="fas fa-users"></i>
                        <div class="timer count-title count-number mt-2 text-white" data-to="21" data-speed="1500"></div>
                        <p class="count-text text-capitalize text-white">professional agents</p>
                    </div>
                    <div class="counter col-lg-3 col-6 mt-lg-0 mt-4">
                        <i class="fas fa-award"></i>
                        <div class="timer count-title count-number mt-2 text-white" data-to="27" data-speed="1500"></div>
                        <p class="count-text text-capitalize text-white">years of experience</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //stats -->
    <!-- services -->
    <!-- //services -->
    <!-- //how it works -->
    <!-- testimonials -->

    <!-- //testimonials -->
    <!-- contact -->
    
    <!-- footer -->
    <div class="footerv4-w3ls" id="footer">
        <div class="footerv4-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 footv4-left">
                        <h1>About Us</h1>
                        <h3>
                            <a href="index.php">INSURACARE</a>
                        </h3>
                        <p class="text-white">INSURACARE is a web based application developed for providing insurance related solutions.</p>
                        
                        <!-- //footer social -->

                    </div>
                    <div class="col-lg-4 col-sm-6 footv4-content mt-sm-0 mt-4">
                        <h3>featured content</h3>
                        <ul class="v4-content">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="#about" class="scroll">About Us</a>
                            </li>
                            <li>
                                <a data-toggle="modal" aria-pressed="false"
                                data-target="#exampleModal" style="color:#fff">User Registration</a>
                            </li>
                             <li>
                                <a data-toggle="modal" aria-pressed="false"
                                data-target="#exampleModal" style="color:#fff">User Login</a>
                            </li>
                            <li>
                                <a href="admin/">Admin</a>
                            </li>
                        </ul>
                    </div>
                    
                    
              
                </div>
            </div>
            <!-- /footerv4-top -->
        </div>
    </div>
    <!-- //footer -->
    <div class="cpy-right">
        <p>© INSURACARE.
        </p>
    </div>


    <!-- login  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="post" class="p-3">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email Id</label>
                            <input type="text" class="form-control" placeholder=" " name="email" id="recipient-name"
                                required="">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" placeholder=" " name="password" id="password"
                                required="">
                        </div>
                        <div class="right-w3l">
                            <input type="submit" class="form-control" name="signin" value="Login">
                        </div>
                        <div class="row sub-w3l my-3">
                        <!--     <div class="col sub-agile">
                                <input type="checkbox" id="brand1" value="">
                                <label for="brand1" class="text-white">
                                    <span></span>Remember me?</label>
                            </div> -->
                            <div class="col forgot-w3l text-right">
                                <a href="#" data-toggle="modal" data-target="#exampleModal2" class="text-white">Forgot Password?</a>
                            </div>
                        </div>
                        <p class="text-center dont-do text-white">Don't have an account?
                            <a href="#" data-toggle="modal" data-target="#exampleModal1" class="text-white">
                                Register Now</a>

                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //login -->


    <!-- register -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" class="p-3" name="register" onsubmit="return checkpass();" >
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Full Name</label>
                            <input type="text" class="form-control" placeholder=" " name="fullname" id="recipient-rname"
                                required="" >
                        </div>
                        <div class="form-group">
                            <label for="recipient-contactno" class="col-form-label">Contact No.</label>
                            <input type="text" class="form-control" placeholder=" " name="contactnumber" id="recipient-contactno"
                                required="" pattern="[0-9]+" title="only numbers" maxlength="10">
                        </div>


                         <div class="form-group">
                            <label for="recipient-email" class="col-form-label">Email Id</label>
                            <input type="email" class="form-control" placeholder=" " name="email" id="recipient-email"
                                required="">
                        </div>


 <div class="form-group">
                            <label for="recipient-email" class="col-form-label">Gender</label>
                             <input type="radio" name="gender" value="Female" required>Female
     <input type="radio" name="gender" value="Male" checked="true" required>Male
     <input type="radio" name="gender" value="Transgender" checked="true" required>Transgender
                        </div>


                        <div class="form-group">
                            <label for="password1" class="col-form-label">Password</label>
                            <input type="password" class="form-control" placeholder=" " name="password" id="password"
                                required="">
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-form-label">Confirm Password</label>
                            <input type="password" class="form-control" placeholder=" " name="repeatpassword" id="repeatpassword"
                                required="">
                        </div>
                        <div class="sub-w3l">
                            <div class="sub-agile">
                                <input type="checkbox" id="brand2" value="">
                                <label for="brand2" class="mb-3 text-white">
                                    <span></span>I Accept to the Terms & Conditions</label>
                            </div>
                        </div>
                        <div class="right-w3l">
                            <input type="submit" name="submit" class="form-control" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- // register -->



    <!-- Forgot Password  -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="post" class="p-3">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Reg. Email Id</label>
                            <input type="email" class="form-control" placeholder=" " name="email" id="recipient-name"
                                required="">
                        </div>

                           <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Reg Contact No</label>
                            <input type="text" class="form-control" placeholder=" " name="contactno" id="recipient-name"
                                required="">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">New Password</label>
                            <input type="password" class="form-control" placeholder=" " name="newpassword" id="password"
                                required="">
                        </div>
                        <div class="right-w3l">
                            <input type="submit" class="form-control" name="pwdreset" value="Update">
                        </div>
                        <div class="row sub-w3l my-3">
                        <!--     <div class="col sub-agile">
                                <input type="checkbox" id="brand1" value="">
                                <label for="brand1" class="text-white">
                                    <span></span>Remember me?</label>
                            </div> -->
                         
                        </div>
                        <p class="text-center dont-do text-white">Already Registered
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
                                login  Now</a>

                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //Forgot Password -->


    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!-- script for password match -->
    <script>
        window.onload = function () {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
    </script>
    <!-- script for password match -->
    <!-- testimonials  Responsiveslides -->
    <script src="js/responsiveslides.min.js"></script>
    <script>
        // You can also use"$(window).load(function() {"
        $(function () {
            // Slideshow 4
            $("#slider3").responsiveSlides({
                auto: true,
                pager: true,
                nav: false,
                speed: 500,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
    </script>
    <!-- //testimonials  Responsiveslides -->
    <!-- start-smooth-scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function () {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */
            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <script src="js/counter.js"></script>
    <!-- //stats -->
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.js"></script>
</body>

</html>