<?php
namespace Dompdf;
require_once 'dompdf/autoload.inc.php';
ob_start();
include('includes/dbconnection.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Policy</title>

</head>
<body>
<h2 align="center">Policy  Details</h2>
<hr />

	<?php 

$pid=intval($_GET['pid']);
	$ret=mysqli_query($con,"select policyDetails,tbluser.FullName,tbluser.Email,tbluser.ContactNo,tbluser.Gender,category.CategoryName as catname,tblsubcategory.SubcategoryName as subcat, tblpolicy.PolicyName,tblpolicyholder.PolicyApplyDate as applydate,tblpolicyholder.PolicyNumber, tblpolicy.ID,tblpolicy.Sumassured,tblpolicy.Premium,tblpolicy.Tenure,tblpolicyholder.PolicyStatus  from tblpolicy inner join category on category.ID=tblpolicy.CategoryId inner join tblsubcategory on  tblsubcategory.id=tblpolicy.SubcategoryId  join tblpolicyholder on tblpolicyholder.PolicyId=tblpolicy.ID join tbluser on tbluser.ID=tblpolicyholder.UserId where  tblpolicyholder.ID='$pid'");

while ($row=mysqli_fetch_array($ret)) { ?>

<table  align="center" border="1" width="100%">
	<tr align="center">
		<th>Policy Holder</th>
		<td><?php  echo $row['FullName'];?></td>
	</tr>

<tr align="center">
		<th>Policy Holder Email</th>
		<td><?php  echo $row['Email'];?></td>
	</tr>

	<tr align="center">
		<th>Policy Holder Contact Number </th>
		<td><?php  echo $row['ContactNo'];?></td>
	</tr>

<tr align="center">
		<th>Policy Holder Gender</th>
		<td><?php  echo $row['Gender'];?></td>
	</tr>

<tr align="center">
		<th>Policy Name </th>
		<td><?php  echo $row['PolicyName'];?></td>
	</tr>


	<tr align="center">
		<th>Policy Number</th>
		<td><?php  echo $row['PolicyNumber'];?></td>
	</tr>


	<tr align="center">
		<th>Category </th>
		<td><?php  echo $row['catname'];?></td>
	</tr>

	<tr align="center">
		<th>Sub Category</th>
		<td><?php  echo $row['subcat'];?></td>
	</tr>


	<tr align="center">
		<th>Sum Assured</th>
		<td><?php  echo $row['Sumassured'];?></td>
	</tr>



	<tr align="center">
		<th>Premium</th>
		<td><?php  echo $row['Premium'];?></td>
	</tr>



	<tr align="center">
		<th>Tenure</th>
		<td><?php  echo $row['Tenure'];?></td>
	</tr>
		<tr align="center">
		<th>Policy Details</th>
		<td><?php  echo $row['policyDetails'];?></td>
	</tr>
	<tr align="center">
		<th>Policy Creation Date </th>
		<td><?php  echo $row['applydate'];?></td>
	</tr>

</table>
<?php } ?>

</body>
</html>
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->setPaper('A4', 'landscape');
$dompdf->load_html($html);
$dompdf->render();
//For view
//$dompdf->stream("",array("Attachment" => false));
// for download
$dompdf->stream("Policy.pdf");
?>