<?php
include('conn.php');
$fetch_basic_profile="select * from store_data where id=4";	

$basic_profile_rs= mysqli_query($con,$fetch_basic_profile);

while($basic_profile_row = mysqli_fetch_array($basic_profile_rs)) 
	{
	$id=$basic_profile_row[0];
	echo $basic_profile_row[1];
	} 
?>