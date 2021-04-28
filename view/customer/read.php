<?php
    $server="localhost";
    $user="root";
    $password="";
    $db="rubaiyat";
    $conn = mysqli_connect($server,$user,$password,$db);
    $query = "SELECT * FROM `customer`";
    $result = mysqli_query($conn,$query);

    if (isset($_GET['delcustomer'])) {
        $email = $_GET['delcustomer'];
        echo $email;
        $delQuery = "DELETE FROM `customer` WHERE `email`='$email'";
        mysqli_query($conn, $delQuery);
        header('location: update.php');
    }
?>

<html>
<head>
<style>
body{
	background-color:rgb(114, 218, 114));
}
.login-div{
	border:2px solid ;
	margin:auto; rgb(221,221,221);
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
		<h1 align="center"><font color="black">Customer Detalis</font></h1>
		<table style="border: 1px solid black; width: 100%; text-align: center;">
            <tr>
                <td>fname</td>
                <td>lname</td>
                <td>password</td>
                <td>email</td>
                <td>phone</td>
                <td>gender</td>
            </tr>
            <?php if (!$result) {
                    printf("Error: %s\n", mysqli_error($conn));
                } 
                else { 
                    while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
					<td>
                        <a href="update.php/?updatecustomer=<?php echo $row['email']; ?>">Update</a>
                    </td>
                    <td>
                        <a onclick="return confirm('Are you sure to delete this?')" href="?delcustomer=<?php echo $row['email']; ?>">Delete</a>
                    </td>
                </tr>
            <?php }
                } ?>
        </table>
	</div>
</body>
</html>