<?php
$purchase="";
$err_purchase="";
if($_SERVER["REQUEST_METHOD"] == "POST")
	if(empty($_POST["purchase"])){
			$err_purchase="Purchase Required";
			
		}
		/*echo "purchase: ". $_POST["purchase"]."<br>";
		*/



?>
<html>
  <head>
     <title>Train Schedule</title>
     
  </head>
    <body style="background-color:BFD7B5">
 
    <form>
    <table width='1000' style="background-color:E7EFC5">
   <tr align:'center'  >
   
    <th>Train Name</th></br>
	<th>Train Number</th></br>
	<th>Total seat</th></br>
	<th>Available seat</th></br>
    <th>Departure</th>
    <th>Arrival</th>
    <th>Duration</th>
    <th>Fare</th>
    <th></th>
	
    </tr>

  <tr align='center'>
 <td>Agnibeena Express</td>
 <td>789</td>
 <td>1000</td>
 <td>679</td>
 <td>11 AM</br>(DHAKA)</td>
 <td>6:55 PM</br>(Khulna)</td>
 <td>7 hr 55 min</td>
 <td>BDT 640.00</td>
 <td><input type="submit" value="Purchase" name="purchase" value = <?php echo $purchase?>></td><td><?php echo $err_purchase?></td>


</tr>

<tr align='center'>
 <td>Jamuna Express</td>
 <td>780</td>
 <td>1000</td>
 <td>679</td>
 <td>4:45 PM</br>(DHAKA)</td>
 <td>9:00 PM</br>(Pabna)</td>
 <td>4 hr 15 min</td>
 <td>BDT 340.00</td>
 <td><input type="submit" value="Purchase" name="purchase" value = <?php echo $purchase?>></td><td><?php echo $err_purchase?></td>


</tr>

<tr align='center'>
 <td>Hawor Express</td>
 <td>889</td>
 <td>1000</td>
 <td>609</td>
 <td>10:00 PM</br>(DHAKA)</td>
 <td>1:00 AM</br>(MYMENSINGH)</td>
 <td>3 hr 00 min</td>
 <td>BDT 140.00</td>
 <td><input type="submit" value="Purchase" name="purchase" value = <?php echo $purchase?>></td><td><?php echo $err_purchase?></td>


</tr>

<tr align='center'>
 <td>Rangpur Express</td>
 <td>709</td>
 <td>1000</td>
 <td>789</td>
 <td>9:00 AM</br>(DHAKA)</td>
 <td>6:00 PM</br>(Biman_Bandor)</td>
 <td>9 hr 00 min</td>
 <td>BDT 450.00</td>
 <td><input type="submit" value="Purchase" name="purchase" value = <?php echo $purchase?>></td><td><?php echo $err_purchase?></td>


</tr>

<tr align='center'>
 <td>Tangail Express</td>
 <td>567</td>
 <td>1000</td>
 <td>349</td>
 <td>7:00 AM</br>(DHAKA)</td>
 <td>10:00 AM</br>(Biman_Bandor)</td>
 <td>3 hr 00 min</td>
 <td>BDT 115.00</td>
 <td><input type="submit" value="Purchase" name="purchase" value = <?php echo $purchase?>></td><td><?php echo $err_purchase?></td>


</tr>
<tr align='center'>
 <td>Citra Express</td>
 <td>654</td>
 <td>1000</td>
 <td>239</td>
 <td>10:00 PM</br>(DHAKA)</td>
 <td>7:00 AM</br>(Biman_Bandor)</td>
 <td>9hr 00 min</td>
 <td>BDT 505.00</td>
 <td><input type="submit" value="Purchase" name="purchase" value = <?php echo $purchase?>></td><td><?php echo $err_purchase?></td>


</tr>
<tr align='center'>
 <td>sonarbangla Express</td>
 <td>804</td>
 <td>2000</td>
 <td>839</td>
 <td>7:00 AM</br>(DHAKA)</td>
 <td>12:00 PM</br>(Chittangong)</td>
 <td>5hr 00 min</td>
 <td>BDT 1205.00</td>
 <td><input type="submit" value="Purchase" name="purchase" value = <?php echo $purchase?>></td><td><?php echo $err_purchase?></td>


</tr>
<tr align='center'>
 <td>Nohakhali Express</td>
 <td>354</td>
 <td>1000</td>
 <td>239</td>
 <td>10:00 PM</br>(DHAKA)</td>
 <td>7:00 AM</br>(Nohakhali)</td>
 <td>9hr 00 min</td>
 <td>BDT 505.00</td>
 <td><input type="submit" value="Purchase" name="purchase" value = <?php echo $purchase?>></td><td><?php echo $err_purchase?></td>


</tr>

	


<table>
</form>
</body>
</html>




