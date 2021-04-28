<?php
	$uname="";
	$err_uname="";
	$pass="";
	$err_pass="";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$uname=$_POST["uname"];
		$pass=$_POST["pass"];
		$server="localhost";
		$user="root";
		$password="";
		$db="rubaiyat";
		$conn = mysqli_connect($server,$user,$password,$db);
		$query = "SELECT `email` FROM `admin` WHERE `email`='$uname' and `password`='$pass'";
		$result = mysqli_query($conn,$query);
		$data=array();
		if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_assoc($result)){
				$data[] = $row;
			}
		}
		else {
			$error = "Your Login Name or Password is invalid";
		}
		if(count($data) > 0) {
			setcookie("user",$uname,time()+600,"/");
			header("Location: adminread.php");
		}else {
			$error = "Your Login Name or Password is invalid";
		}
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	//if(isset($_POST["submit"])){
		if(empty($_POST["uname"])){
			$err_uname="Username Required";
		}
		elseif(strlen($_POST["uname"]) < 6){
			$err_uname="Username Must be 6 Characters Long";
		}
		elseif(strpos($_POST["uname"]," ")){
			$err_uname="Username should not contain white space";
		}
		else{
			$uname=$_POST["uname"];
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
		
		/*echo "Name: ".$uname."<br>";
		echo "Password: ".$pass."<br>";
		*/
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
				 width:60%;
				 margin-top:15%;
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
				 background-color:blue;
				 border:none;
				 color:white;
				 width:100%;
				 border-radius:3px;
				 padding:5px;
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
				    <td><img src="../../image/User.png" width="60" height="60">
					<span style="padding-right:80px"> </span>
				    <span style="font-family:verdana; font-size:40px;">Admin Login</span></td>
				 </tr>
			 </table>
		   
	      <form action="" onsubmit="return validate()" method="POST">
	          <table align="center">
			       <tr>
				       <td><span class="my-font">Username</span></td>
					   <td>:<input class="my-font my-text-field" type ="text" id="uname" name="uname"</td>
					   <td><?php echo $err_uname; ?><span id="err_uname"></span></td>
				  
				   </tr>
				   <tr>
				        <td><span class="my-font">Password</span></td>
					   <td>:<input class="my-font my-text-field" type ="password" id="pass" name="pass"></td>
					   <td><?php echo $err_pass; ?><span id="err_pass"></span></td>
				   </tr>
				   <tr>
				       <td colspan="2"><input class="my-font btn-mine"type="submit" value="Login"></td>
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
			var uname= get("uname");
			if(uname.value == ""){
				get("err_uname").innerHTML = "*username Required ";
				get("err_uname").style.color = "red";
				hasError = true;
			}
			var pass= get("pass");
			if(pass.value == ""){
				get("err_pass").innerHTML = "*password Required";
				get("err_pass").style.color = "red";
				hasError = true;
			}
			return !hasError;
				
		}
		function refresh(){
			get("err_uname").innerHTML = "";
			get("err_pass").innerHTML = "";
		}
	</script>
		
</html>