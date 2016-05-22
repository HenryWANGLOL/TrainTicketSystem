<?php
// session_start();
include 'dbinfo.php';

mysql_connect($host,$db_username,$db_password) or die( "Unable to connect");
mysql_select_db($database) or die( "Unable to select database");

if (isset($_POST['usn']) && isset($_POST['pwd']) 
	&& isset($_POST['con_pwd']) && isset($_POST['email'])) {
	$usn = $_POST['usn'];
	$pwd = $_POST['pwd'];
	$con_pwd = $_POST['con_pwd'];
	$email = $_POST['email'];
	$is_student = $POST['is_student'];
	if (strlen($usn) == 0) {
		$err = 'Please input username';
	} else if (preg_match('/[^A-Za-z0-9]+/', $usn)) {
		$err = 'User name should only contain english letters and numbers';
	} else if (strlen($pwd) < 6) {
		$err = 'Password should be at least 6 characters';
	} else if ($pwd != $con_pwd ) {
		$err = 'Cofirmation password does not match';
	} else if (preg_match('/[a-zA-Z]+[^A-Za-z0-9]*@[^A-Za-z0-9]+.com/', $email)) {
		$err = 'Invalid email address';
	} else {
		$sql_query = "INSERT INTO CUSTOMER
				VALUES 	('".$usn."', '".$email."', '".$pwd."')";
		$result = mysql_query($sql_query) or die(mysql_error());
		redirect('index.php');
	}
	echo $err;
}
?>

<html>
<head>
	<title>User Registration</title>
	<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>
<center>
<br><br><br>
<br><b>New User Registration</p></b>
<table>
	<tr>
		<td>
			<form id="niubiform" action="" method="POST" />
			<p>Username:
			<input type="text" name="usn" />
			</p>
			<p>Password:
			<input type="text" name="pwd" />
			</p>
			<p>Confirm Password:
			<input type="text" name="con_pwd" />
			</p>
			<p>Email:
			<input type="text" name="email" />
			</p>

			<p>Are you a student:
  			<input type="radio" name="gender" value="male"> Male<br>
  			<input type="radio" name="gender" value="female"> Female<br>
  			<input type="radio" name="gender" value="other"> Other<br>  
			</p>
			
			<input type="submit" name="signup" value="Submit" />
			<script src="assets/js/main.js"></script>


			</form>
		</td>
	</tr>
</table>
</center>
</body>
</html>