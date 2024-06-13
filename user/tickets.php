<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid']) == 0) {
    header('location:logout.php');
    exit();
} 

if(isset($_POST['submit'])) {
    $uid = $_SESSION['uid'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $BMI = $_POST['BMI'];
    $Children = $_POST['Children'];
    $Smoker = $_POST['smoker']; // Corrected name
    $Region = $_POST['region']; // Corrected name
    $Charges = $_POST['charges']; // Corrected name
    $query = mysqli_query($con, "INSERT INTO tblticket (UserId, Age, Sex, BMI, Children, Smoker, Region, Charges) VALUES ('$uid', '$age', '$sex', '$BMI', '$Children', '$Smoker', '$Region', '$Charges')");
    if ($query) {
        echo "<script>alert('Ticket has been raised.');</script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        echo "<script>window.location.href='tickets.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

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
<?php include_once('includes/sidebar.php');?>
<div class="az-content az-content-dashboard-two">
    <?php include_once('includes/header.php');?>
    <div class="az-content-header d-block d-md-flex">
        <div>
            <h2 class="az-content-title mg-b-5 mg-b-lg-8"></h2>
        </div>
    </div>
    <div class="az-content-body">
        <div class="row row-sm mg-b-20 mg-lg-b-0">
            <div class="col-md-12 col-xl-7">
                <div class="card card-table-two">
                    <h6 class="card-title">Fill the Info</h6>
                    <form method="post">
                        <p style="font-size:16px; color:red" align="left">
                            <?php if($msg) { echo $msg; } ?>
                        </p>
                        <div class="d-flex flex-column wd-md-650 pd-30 pd-sm-40 bg-gray-200">
                            <div class="form-group">
                                <label class="form-label">Age <span class="tx-danger">*</span></label>
                                <input type="text" name="age" class="form-control wd-450" required="true">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sex: <span class="tx-danger">*</span></label>
                                <select name="sex" class="form-control wd-450" required="true">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">BMI <span class="tx-danger">*</span></label>
                                <input type="text" name="BMI" class="form-control wd-450" required="true">
                            </div>
                            <div class="form-group">
                                <label class="form-label">No. of Children <span class="tx-danger">*</span></label>
                                <input type="text" name="Children" class="form-control wd-450" required="true">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Smoker: <span class="tx-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="smoker" id="smoker_yes" value="yes" required>
                                    <label class="form-check-label" for="smoker_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="smoker" id="smoker_no" value="no" required>
                                    <label class="form-check-label" for="smoker_no">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Region <span class="tx-danger">*</span></label>
                                <select class="form-control wd-450" name="region" required>
                                    <option value="northeast">Northeast</option>
                                    <option value="northwest">Northwest</option>
                                    <option value="southeast">Southeast</option>
                                    <option value="southwest">Southwest</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Charges: <span class="tx-danger">*</span></label>
                                <input type="number" name="charges" class="form-control wd-450" required>
                            </div>

                            <div class="form-group" align="center">
                                <button type="submit" name="submit" class="btn btn-az-primary pd-x-20">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('includes/footer.php');?>
</div>

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
