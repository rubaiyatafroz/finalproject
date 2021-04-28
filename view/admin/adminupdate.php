<?php

    $pass="";
	$phone="";
	$updateadmin = "";
	 
	if (!isset($_GET['updateadmin']) || $_GET['updateadmin'] == null) {
		echo "<script>window.location = 'adminread.php';</script>";
	} else {
		$updateadmin = $_GET['updateadmin'];
	}
     if($_SERVER["REQUEST_METHOD"] == "POST"){
		$pass=$_POST["pass"];
	    $phone=$_POST["phone"];
		$email=$updateadmin;
		$server="localhost";
		$user="root";
		$password="";
		$db="rubaiyat";
		$conn = mysqli_connect($server,$user,$password,$db);
		$query = "UPDATE admin SET password='$pass',phone='$phone' WHERE email='$email'";
		echo $query;
		if(mysqli_query($conn,$query)){
			header("Location: ../adminread.php");
		}
		else{
			echo "problem not inserted";
		}
	 }
	
	$pass="";
	$err_pass="";
	$phone="";
    $err_phone="";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//if(isset($_POST["submit"])){
		
		function validatepass($p)
		{
			$hasupper = false;
			$haslower = false;
			$hasnumeric = false;
			$hassymbol = false;
			for($i=0;$i<strlen($p);$i++)
			{
				if(ctype_upper($p[$i]))
				{
					$hasupper=true;
				}
				if(ctype_lower($p[$i]))
				{
					$haslower=true;
				}
				if(is_numeric($p[$i]))
				{
					$hasnumeric=true;
				}
				if(strpos($p,'#'))
				{
					$hassymbol=true;
				}
			}
			if($hasupper = true && $haslower == true && $hasnumeric = true && $hassymbol == true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		if (strlen($_POST["pass"])<8)
		{
			$err_pass="Password Required of minimum 8 character.";
		}
		elseif(!validatepass($_POST["pass"]))
		{
			$err_pass="Password must have upper case, lower case, '#' symbol and number";
		}
		else
		$pass=htmlspecialchars($_POST["pass"]);		
        if (empty($_POST["phone"]))
        {
        $err_phone="Phone Number Required.";
        }
        else if((strlen($_POST["phone"])!=11)||(!is_numeric($_POST["phone"])))
        {
        $err_phone="Phone Number must be 11 digit number.";
        }
        else
        {
         $phone=htmlspecialchars($_POST["phone"]);
        }
		function validateEmail($email)
        {
        $pos_at = strpos($email,"@");
        $pos_dot = strpos($email,".",$pos_at+1);
        if ($pos_at < $pos_dot)
        {
         return true;
        }
        else
        return false;
        }
        echo "Password: ". $pass."<br>";
		echo "Phone: ".$phone."<br>";
		
	}
?>

<html>
<head>
<style>
body{
	background-color:rgb(255, 255, 255);
}
.login-div{
	border:2px solid ;
	margin:auto; rgb(255, 255, 255);
	width:70%;
	margin-top:12%;
	background-color:white;
	padding:20px;
}
.my-font{
	font-size:20px;
	font-family:consolas;
}
.my-text-field{
	width:200px;
}

</style>
</head>
<body>
<div class="login-div">
	<form action="" onSubmit="return validate()"  method="POST">
		<table align="center">
			<tr>		    
				<td><span style="font-family:verdana; font-size:40px;">Update</span></td>
			</tr>
			<tr>
				<td><span class="my-font">Password</span></td>
				<td>:<input class="my-font my-text-field"type="password" id="pass" name="pass" onfocusout="checkpass(this)"></td>
				<td><?php echo $err_pass; ?><span id="err_pass"></span></td>
			</tr>
			<tr>
				<td><span class="my-font">Phone</span></td>
				<td>:<input class="my-font my-text-field"type="text" id="phone" name="phone" onfocusout="checkphone(this)"></td>
				<td><?php echo $err_phone; ?><span id="err_phone"></span></td>
			</tr>
			
			<tr>
				<td colspan="2" align = "center"><input type="submit" value="Update"></td>
			</tr>
		</table>
	</form>
</div>
</body>
     <script>
		function get(id){
			return document.getElementById(id);
		}
		function validate(){
			refresh();
			if(get("pass").value == ""){
				get("err_pass").innerHTML = "*Password Required";
				get("err_pass").style.color = "red";
				hasError = true;
			}
			if(get("phone").value == ""){
				get("err_phone").innerHTML = "*phone Required";
				get("err_phone").style.color = "red";
				hasError = true;
			}
			return !hasError;
		}
		function refresh(){
			get("err_pass").innerHTML = "";
			get("err_phone").innerHTML = "";
			
		}
		function checkpass(pass){
		var pass = pass.value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var rs = this.responseText;
				if(rs == "true"){
					document.getElementById("err_pass").innerHTML = "";
				}
				else document.getElementById("err_pass").innerHTML = "Not a valid pass";
			}
		};
		xhttp.open("GET","checkpass.php?pass="+pass,true);
		xhttp.send();
	}
		function checkphone(phone){
		var phone = phone.value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var rs = this.responseText;
				if(rs == "true"){
					document.getElementById("err_phone").innerHTML = "";
				}
				else document.getElementById("err_phone").innerHTML = "Not a valid phone";
			}
		};
		xhttp.open("GET","checkphone.php?phone="+phone,true);
		xhttp.send();
	}
	</script>
</html>