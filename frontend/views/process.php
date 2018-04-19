<?php 
include 'config.php';

// add value
$add = $_POST['add'];
$delete = $_POST['delete'];
if ($add == ''){
	$sql_delete = "DELETE FROM `device` WHERE `device_value` = '$delete'";
	mysqli_query($con,$sql_delete);
	mysqli_close($con);
}

// delete value
if ($_POST['delete'] == ''){
	$sql_add = "INSERT INTO `device`(`device_value`) VALUES ('$add')";
	mysqli_query($con,$sql_add);
	mysqli_close($con);
	echo "Insert success";
}
?>