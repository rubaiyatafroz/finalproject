
<?php
	
	$fname="";
	$err_fname="";
	$pass="";
	$err_pass="";
	$cpass="";
    $err_cpass="";
	$phone="";
    $err_phone="";
    $email="";
    $err_email="";
	$gender="";
    $err_gender="";
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		if(empty($_POST["fname"]))
		{
			$err_fname="Full name can not be blank";
		}
		elseif(strlen($_POST["fname"])<6)
		{
			$err_fname="Fullname should minimum length of 6";
		}
		else
		{
			$fname=htmlspecialchars($_POST["fname"]);
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
			if(!isset($_POST["gender"]))
		{
			$err_gender = "Gender must be selected";
		}
		else
		{
			$gender=$_POST["gender"];
		}
	}
		
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$fname=$_POST["fname"];
		$pass=$_POST["pass"];
		$phone=$_POST["phone"];
		$email=$_POST["email"];
		$gender=$_POST["gender"];
		$server="localhost";
		$user="root";
		$password="";
		$db="rubaiyat";
		if(!empty($fname) && !empty($pass) && !empty($phone) && !empty($email) && !empty($gender)) {
			$conn = mysqli_connect($server,$user,$password,$db);
			$query = "insert into admin(fname, password, phone,email, gender) values ('$fname','$pass','$phone','$email','$gender')";
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
		
?>

<html>
    <head>
		<style>
		  body{
			  background-color:rgb(239,239,239);
		  }
		 .login-div{
			 border:1px solid rgb(221,221,221);
			 margin:auto;
			 width:70%;
			 margin-top:14%;
			 background-color:white;
			 padding:20px,0px,20px,0px;
		 }
		 .my-font{
			 font-size:25px;
			 font-family:consolas;
			 color:black;
		 }
		 .my-text-field{
		  width:200px;
		  color:black;
		  }
		  .btn-mine{
			 background-color:tomato;
			 border:none;
			 color:white;
			 width:100%;
			 border-radius:5px;
			 padding:7px;
			 margin=top:10px;
			 
		  }
		  .btn-mine:hover{
			background-color:red;  
		  }
		  .btn-mine:active{
			 background-color:green; 
		  }
		  .header{
			 height:10px;
			 background-color:black;
			 position:fixed;
			 top:0;
			 left:0;
			 width:100%;
			 color:white;
			
		  }
		  .footer{
			 height:10px;
			 background-color:black;
			 position:fixed;
			 bottom:0;
			 left:0;
			 width:100%; 
			 color:white;
		  }
		</style>
	</head>	    
	<body>
	    <div class="header"></div>
	    <div class="login-div">
		    <table align="center">
			    <tr>
				    <td><span style="font-family:verdana; font-size:40px;">Create</span></td>
				</tr>
			</table>
		   
			<form action="" onsubmit="return validate()" method="POST">
				<table align="center">
					<tr>
						<td><span class="my-font">Fullname</span></td>
						<td>:<input class="my-font my-text-field" type ="text" id="fname" name="fname" onfocusout="checkUsername(this)" value="<?php echo $fname; ?>" /><span id="err_fname"></span></td>
						<td><?php echo $err_fname; ?><span id="err_fname"></span></td>
					</tr>
					<tr>
						<td><span class="my-font">Password</span></td>
						<td>:<input class="my-font my-text-field" type ="password"  id="pass" name="pass"><span id="err_pass"></span></td>
						<td><?php echo $err_pass; ?><span id="err_pass"></span></td>
					</tr>
					<tr>
						<td><span class="my-font">Confirm Password</span></td>
						<td>:<input class="my-font my-text-field "type="password" id="cpass" name="cpass"><span id="err_cpass"></span></td>
						<td><?php echo $err_cpass; ?><span id="err_cpass"></span></td>
					</tr>
					<tr>
						<td><span class="my-font">Email</span></td>
						<td>:<input class="my-font my-text-field" type="text"  id="email" name="email" onfocusout="checkEmail(this)" value="<?php echo $email; ?>"><span id="err_email"></span></td>
						<td><?php echo $err_email; ?><span id="err_email"></span></td>
					</tr>
					<tr>
						<td><span class="my-font">Phone Number</span></td>
						<td>:<input class="my-font my-text-field " type="text" id="phone" name="phone"><span id="err_phone"></span></td>
						<td><?php echo $err_phone; ?><span id="err_phone"></span></td>
					</tr>
					<tr>
						<td><span class="my-font my-text-field">Gender</span></td>
						<td>:
							<select  id="gender" name="gender"><span id="err_phone"></span>
							<option value="<?php echo $gender;?>" disabled selected>Select a gender</option>
							<option>Male</option>
							<option>Female</option>
							</select>
						</td>
						<td><?php echo $err_gender; ?><span id="err_gender"></span></td>
					</tr>
					<tr>
						<td colspan="2"><input class="my-font btn-mine"type="submit" value="create"></td>
					</tr>
				</table>
			</form>
	    </div>
		<div class="footer"></div>
	</body>
	     <script>
		function get(id){
			return document.getElementById(id);
		}
		function validate(){
			refresh();
			var hasError=false;
			var fname= get("fname");
			if(fname.value == ""){
				get("err_fname").innerHTML = "*Fullname Required";
				get("err_fname").style.color = "red";
				hasError = true;
			}
			if(get("pass").value == ""){
				get("err_pass").innerHTML = "*Password Required";
				get("err_pass").style.color = "red";
				hasError = true;
			}
			if(get("cpass").value == ""){
				get("err_cpass").innerHTML = "*confirm Password Required";
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
			get("err_gender").innerHTML = "*gender Required";
			get("err_gender").style.color = "red";
			hasError = true;
			}
			
			return !hasError;
		}
		function refresh(){
			get("err_fname").innerHTML = "";
			get("err_pass").innerHTML = "";
			get("err_cpass").innerHTML = "";
			get("err_email").innerHTML = "";
			get("err_phone").innerHTML = "";
			get("err_gender").innerHTML = "";
			
			
		}
		
	function checkUsername(fname){
		var name = fname.value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var rs = this.responseText;
				if(rs == "true"){
					document.getElementById("err_fname").innerHTML = "";
				}
				else document.getElementById("err_fname").innerHTML = "Not a valid username";
			}
		};
		xhttp.open("GET","checkfname.php?fname="+name,true);
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