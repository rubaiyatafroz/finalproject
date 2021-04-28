<?php
	$fname="";
	$err_fname="";
	$lname="";
	$err_lname="";
	$gender="";
	$err_gender="";
	$phone="";
	$err_phone="";
	$email="";
	$err_email="";
	$pass="";
	$err_pass="";
	$cpass="";
	$err_cpass="";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$fname=$_POST["fname"];
		$lname=$_POST["lname"];
		$pass=$_POST["pass"];
		$phone=$_POST["phone"];
		$email=$_POST["email"];
		$gender=$_POST["gender"];
		$server="localhost";
		$user="root";
		$password="";
		$db="rubaiyat";
		if(!empty($fname) && !empty($lname) && !empty($pass) && !empty($phone) && !empty($email) && !empty($gender)) {
			$conn = mysqli_connect($server,$user,$password,$db);
			$query = "INSERT INTO `customer`(`fname`, `lname`, `password`, `email`, `phone`, `gender`) VALUES ('$fname','$lname','$pass','$email','$phone','$gender')";
			//echo $query;
			if(mysqli_query($conn,$query)){ 
				echo "value inserted";
				header("Location: login.php");
			}
			else{
				echo "problem not inserted";
			}
		}
		else{
			echo "problem not inserted";
		}
	 }

	if ($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if (empty($_POST["phone"]))
		{
			$err_phone="**Phone Number Required.";
		}
		else if((strlen($_POST["phone"])!=11)||(!is_numeric($_POST["phone"])))
		{
			$err_phone="**Phone Number must be 11 digit number.";
		}
		else
		{
			$phone=htmlspecialchars($_POST["phone"]);
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
			if (empty($_POST["email"]))
			{
				$err_email="**Email Required.";
			}
			elseif(!validateEmail($_POST["email"]))
			{
				$err_email="**Email should contain '@' and a '.' after '@'";
			}
			else
			{
				$email=htmlspecialchars($_POST["email"]);
			}
		
		if (empty($_POST["pass"]))
			{
				$err_pass="**Password Required.";
			}
		elseif(!validatepass($_POST["pass"]))
		{
			$err_pass="Password must have upper case, lower case, '#' symbol and number";
		}
		else
		$pass=htmlspecialchars($_POST["pass"]);
		
		if($_POST["cpass"]!=$pass)
		{
			$err_cpass="**Password Didn't matched";
		}
		else
		{
			$cpass=htmlspecialchars($_POST["cpass"]);
		}
		
		if(empty($_POST["fname"]))
		{
			$err_fname="First name can not be blank";
		}
		elseif(strlen($_POST["fname"])<4)
		{
			$err_fname="First name should minimum length of 4";
		}
		else
		{
			$fname=htmlspecialchars($_POST["fname"]);
		}
		
		if(empty($_POST["lname"]))
		{
			$err_lname="Last name can not be blank";
		}
		elseif(strlen($_POST["lname"])<4)
		{
			$err_lname="Last name should minimum length of 4";
		}
		else
		{
			$lname=htmlspecialchars($_POST["lname"]);
		}
		if(!isset($_POST["gender"]))
		{
			$err_gender = "Gender must be selected";
		}
		else
		{
			$gender=$_POST["gender"];
		}
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
			<h1 align="center"><font color="black">Train Ticket Booking</font></h1>
			<form action="" onsubmit="return validate()" method="post">
				<table align="center">
					<tr>
						<td><span class="my-font">FirstName</span></td>
						<td>:<input class="my-font my-text-field"type="text" id="fname" name="fname" onfocusout="checkFname(this)" value = "<?php echo $fname;?>"></td>
						<td> <?php echo $err_fname; ?><span id="err_fname"></span></td>
					</tr>
					<tr>
						<td><span class="my-font">LastName</span></td>
						<td>:<input class="my-font my-text-field"type="text" id="lname" name="lname" onfocusout="checkLname(this)" value = "<?php echo $lname;?>"></td>
						<td> <?php echo $err_lname; ?><span id="err_lname"></span></td>    
					</tr>
					<tr>
						<td><span class="my-font">Password</span></td>
						<td>:<input class="my-font my-text-field "type="password" id="pass" name="pass" value = "<?php echo $pass;?>"></td>
						<td><?php echo $err_pass; ?><span id="err_pass"></span></td>
					</tr>
					<tr>
						<td><span class="my-font">Confirm Password</span></td>
						<td>:<input class="my-font my-text-field "type="password" id="cpass" name="cpass"  value = "<?php echo $cpass;?>"></td>
						<td><?php echo $err_cpass; ?><span id="err_cpass"></span></td>
					</tr>
					<tr>
						<td><span class="my-font">Email</span></td>
						<td>:<input class="my-font my-text-field" type="text" id="email" name="email" onfocusout="checkEmail(this)" value = "<?php echo $email;?>"></td>
						<td><?php echo $err_email; ?><span id="err_email"></span></td>
					</tr>
					<tr>
						<td><span class="my-font">Phone Number</span></td>
						<td>:<input class="my-font my-text-field " type="text"  id="phone" name="phone"value = "<?php echo $phone;?>"> </td>
						<td><?php echo $err_phone; ?><span id="err_phone"></span></td>
					</tr>
					<tr>
						<td><span class="my-font my-text-field">Gender</span></td>
						<td>:
							<select id="gender" name="gender">
							<option value="<?php echo $gender;?>" disabled selected>Select a gender</option>
							<option>Male</option>
							<option>Female</option>
							</select>
						</td>
						<td><?php echo $err_gender; ?><span id="err_gender"></span></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Signup"></td>
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
			var fname= get("fname");
			console.log(fname);
			if(fname.value == ""){
				get("err_fname").innerHTML = "*firstname Required";
				get("err_fname").style.color = "red";
				hasError = true;
			}
			var lname= get("lname");
			if(lname.value == ""){
				get("err_lname").innerHTML = "*Lastname Required";
				get("err_lname").style.color = "red";
				hasError = true;
			}
			
			if(get("pass").value == ""){
				get("err_pass").innerHTML = "*Password Required";
				get("err_pass").style.color = "red";
				hasError = true;
			}
			if(get("cpass").value == ""){
				get("err_cpass").innerHTML = "*CPassword Required";
				get("err_cpass").style.color = "red";
				hasError = true;
			}
			if(get("email").value == ""){
				get("err_email").innerHTML = "*Email Required";
				get("err_email").style.color = "red";
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
			get("err_fname").innerHTML = "";
			get("err_lname").innerHTML = "";
			get("err_pass").innerHTML = "";
			get("err_cpass").innerHTML = "";
			get("err_email").innerHTML = "";
			get("err_phone").innerHTML = "";
			get("err_gender").innerHTML = "";
		}
		function checkFname(fname){
		var name = fname.value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var rs = this.responseText;
				if(rs == "true"){
					document.getElementById("err_fname").innerHTML = "";
				}
				else document.getElementById("err_fname").innerHTML = "Not a valid firstname";
			}
		};
		xhttp.open("GET","checkfirstname.php?fname="+name,true);
		xhttp.send();
	}
	function checkLname(lname){
		var name = lname.value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var rs = this.responseText;
				if(rs == "true"){
					document.getElementById("err_lname").innerHTML = "";
				}
				else document.getElementById("err_lname").innerHTML = "Not a valid lastname";
			}
		};
		xhttp.open("GET","checklname.php?lname="+name,true);
		xhttp.send();
	}
	
	
	
	function checkEmail(email){
		var email = email.value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var rs = this.responseText;
				if(rs == "true"){
					document.getElementById("err_email").innerHTML = "";
				}
				else document.getElementById("err_email").innerHTML = "Not a valid email";
			}
		};
		xhttp.open("GET","checkemail.php?email="+email,true);
		xhttp.send();
	}
		
	</script>
</html>



