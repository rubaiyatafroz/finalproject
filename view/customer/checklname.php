<?php
	$lname = $_GET["lname"];
	$server="localhost";
	$user="root";
	$password="";
	$db="rubaiyat";
	$conn = mysqli_connect($server,$user,$password,$db);
	$query = "SELECT * FROM `customer` WHERE `lname`='$lname'";
	$result = mysqli_query($conn,$query);
	$data=array();
	if(mysqli_num_rows($result) > 0){
		while($row=mysqli_fetch_assoc($result)){
			$data[] = $row;
		}
	}
	if(count($data) > 0){
		$rs = false;
	}
	else {
		$rs = true;
	}
	if($rs){
		echo "true";
	}
	else echo "false";
?>