<?php
	session_start();
	if(!isset($_COOKIE["user"])){
		header("Location: login.php");
	}
    $fstation="";
	$err_fstation="";
	$tstation="";
	$err_tstation="";
	$day="";
	$month="";
	$year="";
	$err_date="";
	$via="";
	$date="";
	$date_new="";
	$err_via="";
	$seat="";
	$err_seat="";
	$email="";
	$passenger="";
	$Apassenger="";
	$err_Apassenger="";
	$Cpassenger="";
	$err_Cpassenger="";
	
     if($_SERVER["REQUEST_METHOD"] == "POST"){ 
		$fstation=$_POST["fstation"];
		$tstation=$_POST["tstation"];
	    $via=isset($_POST["via"]);
		$date=isset($_POST["year"]) . "-" . isset($_POST["month"]) . "-" . isset($_POST["day"]);
		$date_new = date ('Y-m-d', strtotime($date));
		$passenger= "Adult-" . isset($_POST["Apassenger"]) . ", Child" . isset($_POST["Cpassenger"]);
	    $seat=isset($_POST["seat"]);
		$email='rubaiyat12@gmail.com';
		$server="localhost";
		$user="root";
		$password="";
		$db="rubaiyat";
		if(!empty($fstation) && !empty($tstation) && !empty($via) && !empty($date_new) && !empty($seat) && !empty($passenger) && !empty($email)) {	
			$conn = mysqli_connect($server,$user,$password,$db);
			$query = "INSERT INTO `booking` (`from`, `to`, `via`, `date`, `class`, `passenger`, `email`) VALUES ('$fstation', '$tstation', '$via', '$date_new', '$seat', '$passenger','$email')";
			echo $query;
			if(mysqli_query($conn,$query)){
				header("Location: read.php");
				echo "value inserted";
			}
			else{
				echo "problem not inserted";
			}
		}
		else {
			echo "problem not inserted<br>";
		}
		
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//if(isset($_POST["submit"])){
		if(empty($_POST["fstation"])){
			$err_fstation="Station Required";
		}
		elseif(strlen($_POST["fstation"]) < 5){
			$err_fstation="Station Must be 5 Characters Long";
		}
		elseif(strpos($_POST["fstation"]," ")){
			$err_fstation = "Station should not contain white space";
		}
		else{
			$fstation=htmlspecialchars($_POST["fstation"]);
		}
		
		if(empty($_POST["tstation"])){
			$err_tstation="Station Required";
		}
		elseif(strlen($_POST["tstation"]) < 5){
			$err_tstation="Station Must be 5 Characters Long";
		}
		elseif(strpos($_POST["tstation"]," ")){
			$err_tstation="Station should not contain white space";
		}
		else{
			$tstation=htmlspecialchars($_POST["tstation"]);
		}
		
			if (empty($_POST["day"]))
			{
				$err_date="JourneyDate must be selected";
			}
			else
			{
				$day=$_POST["day"];
			}
			if (empty($_POST["month"]))
			{
				$err_date="Journey Date must be selected";
			}
			else
			{
				$month=$_POST["month"];
			}
			if (empty($_POST["year"]))
			{
				$err_date="JourneyDate must be selected";
			}
			else
			{
				$year=$_POST["year"];
			}
			
			if(empty($_POST["via"]))
			{
				$err_via="Please select way";
			}
			else
			{
				$via=htmlspecialchars($_POST["via"]);
			}
			
			if (empty($_POST["Apassenger"]))
			{
				$err_Apassenger="Select Number of adult seat";
			}
			else
			{
				$Apassenger=$_POST["Apassenger"];
			}
			if (empty($_POST["Cpassenger"]))
			{
				$err_Cpassenger="Select Number of Child seat";
			}
			else
			{
				$Cpassenger=$_POST["Cpassenger"];
			}
			if (empty($_POST["seat"]))
			{
				$err_seat="Select seat Class";
			}
			else
			{
				$seat=$_POST["seat"];
			}
		echo "From: ". $fstation."<br>";
		echo "To: ". $tstation."<br>";
		echo "Date: ". $day."/". $month."/". $year."<br>";
		echo "Way: ". $via."<br>";
		echo "Class: ". $seat."<br>";
		echo "Passenger(s): Adult- ".$Apassenger.", Child- ".$Cpassenger."<br>";
	}
		
?>
    
<html>
<head>
	<link rel="stylesheet" href="../../css/style.css">
</head>
	<h1> Ticket Booking <?php echo $_COOKIE["user"];?></h1>
      <body>
	   <div class="header"></div>
        <div>
        
        <form action="" onSubmit="return validate()" method="POST">
        
           <table>
        
              <tr>
                <td><span><b>From</b></span></td>
				<td>:</td>
                <td>
					<input type="text" id="from" name="fstation" placeholder="Enter Origin Station">
					<?php echo $err_fstation; ?><span id="err_from"></span>
				</td> 
              </tr>
              
              <tr>
                <td><span><b>To</b></span></td>
				<td>:</td>
                <td><input type="text" id="to" name="tstation" placeholder="Enter Destination Station">
				<?php echo $err_tstation; ?><span id="err_to"></span></td>
              </tr>
              
              <tr>
                <td><b>Via/Avoid</b></td>
				<td>:</td>
                <td><input  type="radio" name="via" value="One-Way" />One Way
                <input type="radio" name="via" value="Return" />Return
				<?php echo $err_via; ?><span id="err_via"></span></td>
            
              </tr>
              <tr>
              <td><b>Journey Date</b></td>
				<td>:</td>
				<td>
					<select id="day" name="day">
						<option disabled selected>Day</option>
						<?php
							for($i=1;$i<=31;$i++)
							{
								echo "<option>$i</option>";
							}
						?>
					</select><span id="err_day"></span>
					<select id="month" name="month">
						<option disabled selected>Month</option>
						<?php
							$mon= array("1","2","3","4","5","6","7","8","9","10","11","12");
							for($j=0;$j<count($mon);$j++)
							{
								echo "<option>$mon[$j]</option>";
							}
						?>
					</select><span id="err_month"></span>
					<select id="year" name="year">
						<option disabled selected>Year</option>
						<?php
							for($k=1971;$k<=2040;$k++)
							{
								echo "<option>$k</option>";
							}
						?>
					</select><?php echo "$err_date"; ?><span id="err_year"></span>
				</td>
              </tr>
              <tr>
				  <td><b>Class</b></td>
				  <td>:</td>
				  <td><select  id="class" name="seat">
					 <option selected disabled>Chose One</option>
					 <option>SHOVON</option>
					 <option>AC_S</option>
					 <option>SNIGDHA</option>
					 <option>S_CHAIR</option>
					 <option>F_SEAT</option>
					 </select><?php echo "$err_seat"; ?><span id="err_class"></span>
				  </td>
              </tr>
              
              <tr>
                 <td><span><b>Passengers</b></span></td>
				 <td>:</td>
                 <td>
					<select id="apassenger" name="Apassenger">
						<option selected disabled>Adult</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select><?php echo "$err_Apassenger"; ?><span id="err_apassenger"></span>
					<select id ="cpassenger" name="Cpassenger">
						<option selected disabled>Child</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select><?php echo "$err_Cpassenger"; ?><span id="err_cpassenger"></span>
				 </td>
              </tr>
			  <tr>
				<td></td>
			  </tr>
              <tr>
                <td colspan=3 align = "Center"><input type="Submit" value="Find"></td>
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
			var from = get("from");
			if(from.value == ""){
				get("err_from").innerHTML = "*from Required";
				get("err_from").style.color = "red";
				hasError = true;
			}
			if(get("to").value == ""){
				get("err_to").innerHTML = "*to Required";
				get("err_to").style.color = "red";
				hasError = true;
			}
			var viacheck = document.getElementsByName("via");
			if(viacheck[0].checked == false){
				if(viacheck[1].checked == false){
					get("err_via").innerHTML = "*via Required";
					get("err_via").style.color = "red";
					hasError = true;
				}
			}
			if(get("day").value == "Day"){
				get("err_day").innerHTML = "*day Required";
				get("err_day").style.color = "red";
				hasError = true;
			}
			if(get("month").value == "Month"){
				get("err_month").innerHTML = "*month Required";
				get("err_month").style.color = "red";
				hasError = true;
			}
			if(get("year").value == "Year"){
				get("err_year").innerHTML = "*year Required";
				get("err_year").style.color = "red";
				hasError = true;
			}
			if(get("class").value == "Chose One"){
				get("err_class").innerHTML = "*class Required";
				get("err_class").style.color = "red";
				hasError = true;
			}
			if(get("apassenger").value == "Adult"){
				get("err_apassenger").innerHTML = "*apassenger  Required";
				get("err_apassenger").style.color = "red";
				hasError = true;
			}
			if(get("cpassenger").value == "Child"){
				get("err_cpassenger").innerHTML = "*cpassenger Required";
				get("err_cpassenger").style.color = "red";
				hasError = true;
			}
			return !hasError;
		}
		function refresh(){
			get("err_from").innerHTML = "";
			get("err_to").innerHTML = "";
			get("err_via").innerHTML = "";
			get("err_day").innerHTML = "";
			get("err_month").innerHTML = "";
			get("err_year").innerHTML = "";
			get("err_class").innerHTML = "";
			get("err_apassenger").innerHTML = "";
			get("err_cpassenger").innerHTML = "";
			
		}
	</script>
</html>