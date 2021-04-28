<?php
	
    $pname="";
    $pass="";
	$gender="";
	$phone="";
	 if (!isset($_GET['updatecustomer']) || $_GET['updatecustomer'] == null) {
		echo "<script>window.location = 'read.php';</script>";
	} else {
		$updatecustomer = $_GET['updatecustomer'];
	}
     if($_SERVER["REQUEST_METHOD"] == "POST"){ 
		$pname=$_POST["pname"];
		$pass=$_POST["pass"];
	    $phone=$_POST["phone"];
		$gender=$_POST["gender"];
		$email=$updatecustomer;
		$server="localhost";
		$user="root";
		$password="";
		$db="rubaiyat";
		$conn = mysqli_connect($server,$user,$password,$db);
		$query = "UPDATE customer SET  fname='$pname', password='$pass', phone='$phone', gender='$gender' WHERE email='$email'";
		echo $query;
		if(mysqli_query($conn,$query)){
			echo "value inserted";
			header("Location: ../read.php");
		}
		else{
			echo "problem not inserted";
		}
	 }



	$pname="";
	$err_pname="";
	$pass="";
	$err_pass="";
	$gender="";
    $err_gender="";
	$phone="";
    $err_phone="";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//if(isset($_POST["submit"])){
		if(empty($_POST["pname"])){
			$err_pname="Passengername Required";
		}
		elseif(strlen($_POST["pname"]) < 6){
			$err_pname="Passengername Must be 6 Characters Long";
		}
		elseif(strpos($_POST["pname"]," ")){
			$err_pname="passengername should not contain white space";
		}
		else{
			$pname=htmlspecialchars($_POST["pname"]);
		}
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
	
		if(!isset($_POST["gender"]))
	    {
		$err_gender = "Gender must be selected";
		}
		else
		{
		$gender=$_POST["gender"];
		}
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
        echo "pname: ".$pname."<br>";
		echo "Password: ". $pass."<br>";
		echo "Gender: ".$gender."<br>";
		echo "Phone: ".$phone."<br>";
		
	}
?>

<html>
<head>
	<link rel="stylesheet" href="../../css/style.css">

<style>
		body{
			background-color:rgb(242, 242, 242);
		}
		</style>
		</head>
<body>

	<div class="login-div">
		<h1 align="center"><font color="black">Update User Profile</font></h1>
		<form action="" onsubmit="return validate()" method="POST">
			<table align="center">
				<tr>
					<td><span class="my-font">Passenger name</span></td>
					<td>:<input class="my-font my-text-field"type="text" id="pname" name="pname" onfocusout="checkpname(this)"></td>
					<td><?php echo $err_pname; ?><span id="err_pname"></span></td>
				</tr>
				<tr>
					<td><span class="my-font">Password</span></td>
					<td>:<input class="my-font my-text-field"type="password" id="pass" name="pass"></td>
					<td><?php echo $err_pass; ?><span id="err_pass"></span></td>
				</tr>
				<tr>
					<td><span class="my-font">Phone</span></td>
					<td>:<input class="my-font my-text-field"type="text" id="phone" name="phone" onfocusout="checkphone(this)"></td>
					<td><?php echo $err_phone; ?><span id="err_phone"></span></td>
				</tr>
				<tr>
					<td><span class="my-font my-text-field">Gender</span></td>
					<td>:
						<select  id="gender" name="gender">
							<option value="<?php echo $gender; ?>" disabled selected>Select a gender</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</td>
					<td><?php echo $err_gender; ?><span id="err_gender"></span></td>
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
			var hasError=false;
			var pname= get("pname");
			console.log(pname);
			if(pname.value == ""){
				get("err_pname").innerHTML = "*passengername Required";
				get("err_pname").style.color = "red";
				hasError = true;
			}
			var pass= get("pass");
			if(pass.value == ""){
				get("err_pass").innerHTML = "*password Required";
				get("err_pass").style.color = "red";
				hasError = true;
			}
			if(get("phone").value == ""){
				get("err_phone").innerHTML = "*Phone Required";
				get("err_phone").style.color = "red";
				hasError = true;
			}
		    
			if(get("gender").value == ""){
				get("err_gender").innerHTML = "*Gender Required";
				get("err_gender").style.color = "red";
				hasError = true;
			}
			
			return !hasError;
				
		}
		function refresh(){
			get("err_pname").innerHTML = "";
			get("err_pass").innerHTML = "";
			get("err_phone").innerHTML = "";
			get("err_gender").innerHTML = "";
		}
		function checkpname(pname){
		var name = pname.value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var rs = this.responseText;
				if(rs == "true"){
					document.getElementById("err_pname").innerHTML = "";
				}
				else document.getElementById("err_pname").innerHTML = "Not a valid pname";
			}
		};
		xhttp.open("GET","checkpname.php?pname="+name,true);
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